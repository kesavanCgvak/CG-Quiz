<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Answers extends Authenticatable
{
	
	protected $table = 'user_answers';

	protected $fillable = [
		'user_id', 'question_id'
	];

	protected $hidden = [];

	public $timestamps = false;

	// public function campus()
 //    {
 //        return $this->hasMany('App\Campus');
 //    }

}