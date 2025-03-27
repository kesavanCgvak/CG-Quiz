<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Groups extends Authenticatable
{

    protected $table = 'predefined_questions';

    protected $fillable = [
        'group_name','pre_questions'
    ];

    protected $hidden = [];

    public $timestamps = false;

    // public function campus()
    //    {
    //        return $this->hasMany('App\Campus');
    //    }

}
