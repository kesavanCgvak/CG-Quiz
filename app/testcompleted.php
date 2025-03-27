<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class testcompleted extends Authenticatable
{
  protected $table = 'test_completion_details';

  protected $fillable = [
      'user_id', 'is_test_completed', 'test_completed_date', 'common_ques_data', 'total_per','result'
  ];
  protected $hidden = [];
  public $timestamps = false;
}
