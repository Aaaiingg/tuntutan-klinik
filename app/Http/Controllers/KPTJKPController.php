<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KPTJKPController extends Controller
{
    // Fungsi untuk memaparkan dashboard kptjkp
    public function index(Request $request)
{
    $search = $request->input('search');

    //tuntutan yang diluluskan
    $claimsApproved = Claim::with('user.department')
    ->whereNotNull('semak_ptjkp')
        ->when($search, function ($query) use ($search) {
           $query->where(function ($subquery) use ($search) {
                $subquery->orWhereHas('staff', function ($q) use ($search) {
                    $q->where('staff_nama', 'ilike', "%{$search}%");
                })->orWhere('bulan', 'ilike', "%{$search}%")
                  ->orWhereHas('user.department', function ($q) use ($search) {
                      $q->where('name', 'ilike', "%{$search}%");
                  });
            });
        })
        ->latest()
        ->get();

        //tuntutan yang perlu diluluskan
        $claimsToProcess = Claim::with('user.department')
        ->whereNotNull('sahkan_ketua_jabatan')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($subquery) use ($search) {
                $subquery->orWhereHas('staff', function ($q) use ($search) {
                    $q->where('staff_nama', 'ilike', "%{$search}%");
                })->orWhere('bulan', 'ilike', "%{$search}%")
                  ->orWhereHas('user.department', function ($q) use ($search) {
                      $q->where('name', 'ilike', "%{$search}%");
                  });
            });
        })
        ->latest()
        ->get();

    $jumlahTuntutan = Claim::sum('jumlah_resit');
    $tuntutanBaharu = Claim::count();
    $tuntutanDisemak = Claim::where('status', 'DISEMAK')->count();
    $tuntutanTLengkap = Claim::where('status', 'TIDAK LENGKAP')->count();
    $tuntutanDiluluskan = Claim::where('status', 'DILULUSKAN')->count();
    $BilTuntutan = Claim::count();


    return view('dashboard.kptjkp', compact('claimsToProcess','claimsApproved', 'jumlahTuntutan','tuntutanBaharu','tuntutanDisemak','tuntutanTLengkap','BilTuntutan','tuntutanDiluluskan'));
}
    public function show($id)
{
    $claim = Claim::findOrFail($id);
    return view('kptjkp.show', compact('claim'));
}
public function sahkan($id)
{
    $claim = Claim::findOrFail($id);
     // Kemas kini sahkan kptjkp
    $claim->sahkan_kptjkp = Auth::user()->name;
    $claim->status = 'DISAHKAN KETUA PTJKP';
    $claim->save();


    return redirect()->back()->with('success', 'Tuntutan telah disahkan.');
}

public function tidakLengkap($id)
{
    $claim = Claim::findOrFail($id);
    $claim->status = 'TIDAK LENGKAP';
    $claim->save();

    return redirect()->back()->with('error', 'Tuntutan ditandakan sebagai tidak lengkap.');
}


}
