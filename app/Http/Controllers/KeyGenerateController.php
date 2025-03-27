<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class KeyGenerateController extends Controller
{
    public function showForm()
    {
        return view('key_generate');
    }

    public function generateKey()
    {
        Artisan::call('key:generate');
        return back()->with('success', 'Application key has been generated successfully!');
    }
}
