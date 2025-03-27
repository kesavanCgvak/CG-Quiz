<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Question Model
 */
class Questions extends Authenticatable
{
	protected $primaryKey = 'question_id';

	protected $table = 'questions';

	protected $fillable = [
		'section_id','level_id', 'question_number', 'question_name', 'question_info', 'is_first_sub_question', 'marks', 'right_option_id', 'sort_order', 'is_active'
	];

	protected $hidden = [];

	public $timestamps = false;

	public function section()
    {
        return $this->belongsTo('App\Sections','section_id','id');
    }

    public function questionlevel(){
    	return $this->belongsTo('App\QuestionLevel','level_id','id');
    }
    public function option(){
    	return $this->belongsTo('App\Option','right_option_id','option_id');
    }
}
