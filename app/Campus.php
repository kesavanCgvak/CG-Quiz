<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Campus extends Authenticatable
{

	protected $table = 'campus_details';

	protected $primaryKey = 'campus_id';

	protected $fillable = [
		'campus_name', 'campus_info', 'campus_date', 'college_id','pass_percentage','total_questions','questions','group_id'
	];

	protected $hidden = [];

	public $timestamps = false;

	public function group(){
        return $this->belongsTo('App\Groups','group_id','id');
    }
	public function college()
    {
        return $this->belongsTo('App\College','college_id','id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','id','campus_id');
    }


}
