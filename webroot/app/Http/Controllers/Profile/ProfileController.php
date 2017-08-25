<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Event;
use App\UserEvent;
use Auth;

class ProfileController extends Controller
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
    public function showMe(Request $request)
    {
        return $this->show(Auth::user()->id, $request);
    }
    public function show($id, Request $request)
    {
        $user = User::find($id);
        $user_groups = $user->getGroups()->paginate(3,['*'],'group');
        $event_list = $user->getEvents()->paginate(3,['*'],'event');
        //dealing with user event
        $events = [];
        foreach($user->getEvents()->get() as $event){
            $events[] = \Calendar::event(
                $event->title, //event title
                $event->is_fullday, //full day event?
                $event->event_start, //start time (you can also use Carbon instead of DateTime)
                $event->event_end, //end time (you can also use Carbon instead of DateTime)
                $event->event_id, //optionally, you can specify an event ID
                [
                    'url' => $event->getLink(),
                    //any other full-calendar supported parameters
                ]
            );
        }

        $calendar = \Calendar::addEvents($events,['color' => '#98FB98']);
        //dealing with user profile
        $viewName = "profile.show";

        if($request->is('user/*/edit')){
            $viewName = "profile.form";
        }
        return view($viewName)->with(compact('user','calendar','event_list','user_groups'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'bio' => 'required|max:500',
            'avatar' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/user/' . $id . '/edit')
                ->withInput()
            ->withErrors($validator);
        }
        $profile = $user->profile;
        $profile->avatar = $request->avatar;
        $profile->bio = $request->bio;
        $profile->save();

        return redirect('/user/' . $id);
    }

    public function getEvent($event_id){
        $event = Event::find($event_id);
        $users = $event->getUsers()->paginate(9,['*'],'user');
        return view('event.event')->with(compact('event','users'));
    }
    public function removeMeFromEvent($event_id,Request $request){
        $me = Auth::user();
        $relations = UserEvent::where('user_id',$me->id)->get();
        foreach($relations as $item){
            if($item->event_id == $event_id){
                $item->delete();
            }
        }
        return redirect()->back();
    }
    public function addMeToEvent($event_id,Request $request){
        $me = Auth::user();

        $userEvent = new UserEvent();
        $userEvent->event_id = $event_id;
        $userEvent->user_id = $me->id;
        $userEvent->save();
        return redirect()->back();
    }
}
