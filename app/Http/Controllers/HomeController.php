<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminDashboardView(){
        return view('adminPanel.dashboard');
    }
}
