<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Blog extends Model
{
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAuthor()
    {
        return User::find($this->user_id);
    }
}
