<?php

namespace App\Model;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
protected $guarded=[];
    public function like()
    {

        return $this->belongsTo(Like::class);
    }

    public function user()
    {

      return $this->belongsTo(User::class);

    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
