<?php

namespace App\Http\Controllers;

class StaffController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'staff') {
            abort(403);
        }

        return view('staff.dashboard');
    }
}