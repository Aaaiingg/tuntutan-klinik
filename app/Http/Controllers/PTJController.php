<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class PTJController extends Controller
{

    public function index()
    {
        $claim = Claim::all();
        return view('dashboard.ptj', compact('claim'));
    }
    // Papar borang tambah tuntutan
    public function create()
    {
        $user = Auth::user();
    // Dapatkan dept_id user yang login
    $deptId = $user->dept_id;

    // Dapatkan senarai staff berdasarkan dept_id user
    $staffs = Staff::where('dept_id', $deptId)->get();

    // Hantar ke view
    return view('ptj.create', compact('staffs'));
    }

    // Simpan tuntutan ke database
    public function store(Request $request)
    {
        
 
        $request->validate([
            'staff_no' => 'required|exists:staff,staff_no',
            'nama_klinik' => 'required|string|max:255',
            'no_resit' => 'required|string|max:100',
            'jumlah_resit' => 'required|numeric',
            'resit_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'tarikh_resit' => [
        'required',
        'date',
        function ($attribute, $value, $fail) {
            $date = \Carbon\Carbon::parse($value);
            $previousMonthStart = now()->subMonthNoOverflow()->startOfMonth();
            $previousMonthEnd = now()->subMonthNoOverflow()->endOfMonth();

            if (!$date->between($previousMonthStart, $previousMonthEnd)) {
                $fail('Tarikh resit hanya dibenarkan untuk bulan lepas sahaja.');
            }
        }
    ],
]);



        $staff = Staff::where('staff_no', $request->staff_no)->first();

        $resitPaths = [];
        if ($request->hasFile('resit_path')) {
            foreach ($request->file('resit_path') as $file) {
                $path = $file->store('resit', 'public');
                $resitPaths[] = $path;

           
        }}

        Claim::create([
            'user_id' => Auth::id(),
            'staff_no' => $request->staff_no,
            'nama_klinik' => $request->nama_klinik,
            'no_resit' => $request->no_resit,
            'jumlah_resit' => $request->jumlah_resit,
            'tarikh_resit' => $request->tarikh_resit,
            'bulan' => Carbon::now()->toDateString(), // Simpan dalam format 'YYYY-MM-DD'
            'resit_path' => implode(',', $resitPaths),
            'status' => 'Baharu'
        ]);

        return redirect()->route('dashboard.ptj')->with('success', 'Tuntutan berjaya dihantar.');
}
public function edit($id)
{
    $claim = Claim::findOrFail($id);
    $staffs = Staff::all(); // atau ikut jabatan pengguna jika perlu
    return view('ptj.edit', compact('claim', 'staffs'));
}

public function update(Request $request,$id)
{
    $claim = Claim::findOrFail($id);
    // Validasi input
    $validated = $request->validate([
        'staff_no' => 'required|string|max:255',
        'nama_klinik' => 'required|string|max:255',
        'no_resit' => 'required|string|max:255',
        'jumlah_resit' => 'required|numeric',
        'bulan' => 'required|string',
        'resit_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Simpan fail jika ada upload baru
    if ($request->hasFile('resit_path')) {
        $validated['resit_path'] = $request->file('resit_path')->store('resit', 'public');
    }

    $claim->update($validated);

    return redirect()->route('dashboard.ptj')->with('success', 'Tuntutan berjaya dikemaskini.');
}
public function destroy($id)
{
    $claim = Claim::findOrFail($id);

    // Hanya benarkan user yang cipta tuntutan padam
    if ($claim->user_id !== Auth::id()) {
        return redirect()->route('dashboard.ptj')->with('error', 'Anda tidak dibenarkan untuk padam tuntutan ini.');
    }

    $claim->delete();

    return redirect()->route('dashboard.ptj')->with('success', 'Tuntutan berjaya dipadam.');
}
public function show()
{
    $deptId = auth::user()->dept_id; // guna dept_id

    $claims = Claim::with('staff')
        ->whereHas('staff', function ($query) use ($deptId) {
            $query->where('dept_id', $deptId); // guna dept_id
        })
        ->get();

    return view('ptj.show', compact('claims'));
}









}
