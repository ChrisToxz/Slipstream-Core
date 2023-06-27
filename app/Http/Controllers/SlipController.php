<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlipController extends Controller
{
    public function index(){
        return inertia('Dashboard');
    }
}
