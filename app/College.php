<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class College extends Authenticatable
{

	protected $table = 'college_details';

	protected $fillable = [
		'college_name','college_address','placement_officer_name','contact_email','phone_number', 'is_active'
	];

	protected $hidden = [];

	public $timestamps = false;

	// public function campus()
 //    {
 //        return $this->hasMany('App\Campus');
 //    }

}
