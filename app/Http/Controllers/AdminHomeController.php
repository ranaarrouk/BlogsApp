<?php

namespace App\Http\Controllers;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.home');
    }
}
