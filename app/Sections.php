<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sections extends Authenticatable
{
    protected $table = 'sections';

    protected $fillable = [
        'section_name', 'sort_order', 'is_active'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
