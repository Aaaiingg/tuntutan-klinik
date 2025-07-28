<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class AdminDashboardController extends Controller
{
    public function index()
    {
         $staffs = Staff::with('departments')->get(); // Pastikan relationship jabatan() wujud
    return view('dashboard.admin', compact('staffs')); 
    }
}
