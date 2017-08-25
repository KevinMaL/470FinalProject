<?php
namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\User;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function hasNew()
  {
      $our_uid = Auth::user()->id;
      $messages = Message::where('owner_id',$our_uid)->get();

      $rtn = false;
      foreach($messages as $message){
        if(!$message->has_read){
          $rtn = true;
        }
      }
      return $rtn;
  }

  public function myMessages(Request $request)
  {
      //pagination
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection($this->getAllThreads());
      $perPage = 5;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $threads = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
      $threads->setPath($request->url());
      $threads->appends($request->except(['page']));

      return view('message.message', compact('threads','self'));
  }

  private static function _timeCompare($message1,$message2)
  {
    $message1time = \Carbon\Carbon::parse($message1['created_at']);
    $message2time = \Carbon\Carbon::parse($message2['created_at']);
    return ($message1time->lte($message2time)) ? -1 : 1;
  }

  public function unread(Request $request)
  {
    $uid = Auth::user()->id;
    $messages = Message::where('owner_id',$uid)->where('receiver_id',$uid)->where('has_read',0)->orderBy('created_at', 'desc')->paginate(10);
    $senders = array();
    foreach($messages as $key => $message){
      $senders[$key]['name'] = User::find($message['sender_id'])->name;
      $senders[$key]['avatar'] = User::find($message['sender_id'])->getProfile()->avatar;
    }

    return view('message.unread', compact('messages','senders'));
  }

  public function thread($their_uid, Request $request)
  {
    $threads = $this->getAllThreads();
    $thread = $threads[$their_uid];
    $sender = array();
    $sender['name'] = User::find($their_uid)->name;
    $sender['avatar'] = User::find($their_uid)->getProfile()->avatar;
    foreach($thread as $message){
      Message::find($message["id"])->setRead();
    }
    return view('message.thread', compact('thread','sender'));
  }

  private function getAllThreads()
  {
    $uid = Auth::user()->id;
    $self = User::find($uid);

    $messages = Message::where('owner_id',$uid)->where('receiver_id',$uid)->orderBy('created_at', 'desc')->get()->toArray();
    $threads = array();
    foreach($messages as $message){
      $message['receive'] = TRUE;
      $threads[$message['sender_id']][] = $message;
    }
    $messages_sent = Message::where('owner_id',$uid)->where('sender_id',$uid)->orderBy('created_at', 'desc')->get()->toArray();
    foreach($messages_sent as $message){
      $message['receive'] = FALSE;
      $threads[$message['receiver_id']][] = $message;
    }
    foreach($threads as $key => $thread){
      usort($thread, array( $this ,"_timeCompare"));
      $threads[$key] = $thread;
      foreach($thread as $messageKey => $message){
        if($message['receive']){
          $threads[$key][$messageKey]['avatar'] = User::find($key)->getProfile()->avatar;
          $threads[$key][$messageKey]['name'] = User::find($key)->name;
          $threads[$key][$messageKey]['other_name'] = $self->name;
        }else{
          $threads[$key][$messageKey]['avatar'] = $self->getProfile()->avatar;
          $threads[$key][$messageKey]['name'] = $self->name;
          $threads[$key][$messageKey]['other_name'] = User::find($key)->name;
        }
      }
    }
    return $threads;
  }

  public function send($their_uid, Request $request)
  {
      $our_uid = Auth::user()->id;
      $validator = Validator::make($request->all(), [
          'message_body' => 'required|max:500',
      ]);

      if ($validator->fails()) {
          return redirect('/user/message/thread/' . $their_uid)
              ->withInput()
          ->withErrors($validator);
      }
      $this->sendMessageTo($our_uid, $their_uid, $request->message_body);

      return redirect('/user/message/thread/' . $their_uid);
  }

  public function sendMessageTo($from_uid, $to_uid,$message_body){
      $message = new Message();
      $message->message_body = $message_body;
      $message->sender_id = $from_uid;
      $message->receiver_id = $to_uid;
      $message->has_read = 1;
      $message->owner_id = $from_uid;
      $message->save();
      $message = new Message();
      $message->message_body = $message_body;
      $message->sender_id = $from_uid;
      $message->receiver_id = $to_uid;
      $message->has_read = 0;
      $message->owner_id = $to_uid;
      $message->save();
  }

  public function readAll(){
    $our_uid = Auth::user()->id;
    $messages = Message::where('owner_id',$our_uid)->get();
    foreach($messages as $message){
      $message->setRead();
    }
    return redirect('/user/message/unread');
  }

  public function new(){
    return view('message.new');
  }

  public function newSubmit(Request $request){
      $our_uid = Auth::user()->id;
      $to_user = User::where('name',$request->target_name)->first();

      if(!$to_user){
        return redirect('/user/message/new/')->withErrors('No user found.');
      }
      $their_uid = $to_user->id;
      if($their_uid == $our_uid){
        return redirect('/user/message/new/')->withErrors('Cannot send to self.');
      }
      $validator = Validator::make($request->all(), [
          'message_body' => 'required|max:500',
      ]);

      if ($validator->fails()) {
          return redirect('/user/message/thread/' . $their_uid)
              ->withInput()
          ->withErrors($validator);
      }
      $this->sendMessageTo($our_uid, $their_uid, $request->message_body);

      return redirect('/user/message/thread/' . $their_uid);
  }

  public function removeThread($their_uid){
    $our_uid = Auth::user()->id;
    $messages = Message::where('owner_id',$our_uid)->where('sender_id',$their_uid)->get();
    foreach($messages as $message){
      $message->delete();
    }
    return redirect('/user/message/');
  }
}
