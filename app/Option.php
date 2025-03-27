<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Option extends Authenticatable
{
    protected $table = 'question_options';

    protected $primarykey = 'option_id';

    protected $fillable = [
        'question_id','option_value'
    ];
    protected $hidden = [];
    public $timestamps = false;

    // public function campus()
    // {
    //     return $this->hasMany('App\Campus');
    // }
}