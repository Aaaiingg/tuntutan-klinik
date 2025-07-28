<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;

class AdminStaffController extends Controller
{
    // Papar borang tambah staff
    public function create()
    {
        $departments = Department::all(); // Untuk dropdown jabatan
        return view('admin.staff.create', compact('departments'));
    }

    public function store(Request $request)
{
    $request->validate([
        'staff_no' => 'required|unique:staff,staff_no',
        'staff_nama' => 'required|string|max:255',
        'staff_jawatan' => 'required|string|max:255',
        'staff_kelayakan' => 'nullable|string|max:255',
        'dept_id' => 'required|exists:departments,id',
        'status' => 'required|in:aktif,tidak_aktif',
    ]);

    Staff::create([
        'staff_no' => $request->staff_no,
        'staff_nama' => $request->staff_nama,
        'staff_jawatan' => $request->staff_jawatan,
        'staff_kelayakan' => $request->staff_kelayakan,
        'dept_id' => $request->dept_id,
        'status' => $request->status,
    ]);

    return redirect()->route('dashboard.admin')->with('success', 'Staff berjaya ditambah.');
}
}
