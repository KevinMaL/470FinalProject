<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function newPost($group_id,$post_body,$user_id){
      $time = \Carbon\Carbon::now();
      $post = new Post();
      $post->user_id = $user_id;
      $post->parent_id = 0;
      $post->group_id = $group_id;
      $post->post_body = $post_body;
      $post->node_depth = 0;
      $post->created_at = $time;
      $post->updated_at = $time;
      $post->save();
      $post->root_id = $post->id;
      $post->save();
      return $post;
    }
    public static function newReply($target_id,$post_body,$user_id){
      $target = Post::find($target_id);
      $time = \Carbon\Carbon::now();
      $post = new Post();
      $post->user_id = $user_id;
      $post->parent_id = $target_id;

      $post->group_id = $target->group_id;
      $post->post_body = $post_body;
      $post->node_depth = $target->node_depth + 1;
      $post->root_id = $target->root_id;
      $post->created_at = $time;
      $post->updated_at = $time;
      $post->save();


      $target->reply_count++;
      $target->save();

      while($target->parent_id != 0){
        $target = Post::find($target->parent_id);
        $target->reply_count++;
        $target->save();
      }



      return $post;
    }
    public function getLink(){
      return "/group/".$this->group_id."/post/".$this->id;
    }
    public function getAuthor(){
      return User::where('id',$this->user_id)->first();
    }

}
