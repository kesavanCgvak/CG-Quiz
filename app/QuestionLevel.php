<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class QuestionLevel extends Authenticatable
{
    protected $table = 'questions_level';

    protected $fillable = [
        'level'
    ];
    protected $hidden = [];
    public $timestamps = false;

    // public function campus()
    // {
    //     return $this->hasMany('App\Campus');
    // }
}