<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KPTKWController extends Controller
{
    // Fungsi untuk memaparkan dashboard PTK
    public function index(Request $request)
{
    $search = $request->input('search');

    //tuntutan yang diluluskan
    $claimsApproved = Claim::with('user.department')
    ->where('status', 'DISEMAK')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($subquery) use ($search) { 
           $subquery->where('nama_staff', 'ilike', "%{$search}%")
                  ->orWhere('bulan', 'ilike', "%{$search}%")
                  ->orWhereHas('user.department', function ($q) use ($search) {
                $q->where ('name','ilike', "%{$search}%");

                  });
                });
        })
        ->latest()
        ->get();

        //tuntutan yang perlu diluluskan
        $claimsToProcess = Claim::with('user.department')
        ->where('status', 'DISEMAK')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($subquery) use ($search) { 
                $subquery->where('nama_staff', 'ilike', "%{$search}%")
                    ->orWhere('bulan', 'ilike', "%{$search}%")
                    ->orWhereHas('user.department', function ($q) use ($search) {
                        $q->where('name','ilike', "%{$search}%");
                    });
            });
        })
        ->latest()
        ->get();

    $jumlahTuntutan = Claim::sum('jumlah_resit');
    $tuntutanBaharu = Claim::count();
    $tuntutanDisemak = Claim::where('status', 'DISEMAK')->count();
    $tuntutanDilulus = Claim::where('status', 'DILULUSKAN')->count();


    return view('dashboard.kjbt', compact('claimsApproved','claimsToProcess', 'jumlahTuntutan','tuntutanBaharu','tuntutanDisemak','tuntutanDilulus'));
}
    public function show($id)
{
    $claim = Claim::findOrFail($id);
    return view('kjbt.show', compact('claim'));
}
public function lulus($id)
{
    $claim = Claim::findOrFail($id);
    $claim->status = 'DILULUSKAN';
    $claim->save();

    return redirect()->back()->with('success', 'Tuntutan telah diluluskan.');
}

public function tidakLengkap($id)
{
    $claim = Claim::findOrFail($id);
    $claim->status = 'TIDAK LENGKAP';
    $claim->save();

    return redirect()->back()->with('error', 'Tuntutan ditandakan sebagai tidak lengkap.');
}


}
