<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboardPtj(Request $request)
{

    $user = Auth::user();     
    

    //hanya yg login je bleh tgk dia punya
    $claims = Claim::with('staff')
    ->where('user_id', $user->id)
        ->latest()
        ->get();


    $jumlahTuntutan = $claims->sum('jumlah_resit');
    $tuntutanBaharu = $claims->where('status', 'Baharu')->count();
    $BilTuntutan = $claims->count();
    $tuntutanKJ = $claims->where('status', 'DISAHKAN KETUA JABATAN')->count();
    $tuntutanTL = $claims->where('status', 'TIDAK LENGKAP')->count();

    return view('dashboard.ptj', compact(
        'claims', 'jumlahTuntutan', 'tuntutanBaharu', 'BilTuntutan','tuntutanKJ','tuntutanTL'));
}

public function dashboardPtjkp(Request $request)
{

    $user = Auth::user();     
    
     // PTJKP hanya boleh semak tuntutan yang telah disahkan oleh ketua jabatan
    $claimsToProcess = Claim::with('user.department')
        ->whereNotNull('sahkan_ketua_jabatan') // Pastikan telah disahkan (bukan null)
        ->get();

    $claimsApproved = Claim::with('user.department')
        ->whereNotNull('semak_ptjkp') // yang sudah disemak
        ->get();

    $jumlahTuntutan = $claimsApproved->sum('jumlah_resit');
    $tuntutanBaharu = $claimsToProcess->where('status', 'Baharu')->count();
    $tuntutanDisemak = Claim::where('status', 'DISEMAK')->count();
    $tuntutanTLengkap = Claim::where('status', 'TIDAK LENGKAP')->count();
    $tuntutanDiluluskan = Claim::where('status', 'DILULUSKAN')->count();

    return view('dashboard.ptjkp', compact(
        'claimsToProcess','claimsApproved', 'jumlahTuntutan', 'tuntutanBaharu','tuntutanDisemak','tuntutanTLengkap','tuntutanDiluluskan'));
}
public function dashboardPtk(Request $request)
{

    $user = Auth::user();     
    
    //ptjkw bleh tgk semua claim yang status disemak
    //yang belum diluluskan
    $claimsToProcess = Claim::with('user.department')
    ->where('status', 'DISEMAK')
    ->get();

    //yang telah diluluskan
    $claimsApproved = Claim::with('user.department')
    ->where('status', 'DILULUSKAN')
    ->get();


    $jumlahTuntutan = $claimsApproved->sum('jumlah_resit');
    $tuntutanBaharu = $claimsToProcess->where('status', 'DISEMAK')->count();
    $tuntutanDisemak = Claim::where('status', 'DISEMAK')->count();
    $tuntutanDilulus = Claim::where('status', 'DILULUSKAN')->count();
    

    return view('dashboard.ptk', compact(
        'claimsToProcess','claimsApproved', 'jumlahTuntutan', 'tuntutanBaharu','tuntutanDisemak','tuntutanDilulus'));
}
public function dashboardKjbt(Request $request)
{

    $user = Auth::user();
    $deptId =$user->dept_id; //baca ketua jabatan dept mana     
    
    //kjbt bleh tgk semua claim yang status baharu
    //jbtn sendiri sahaja
    $claimsToProcess = Claim::with('user.department')
    ->whereNull('sahkan_ketua_jabatan')
        ->whereHas('user', function ($query) use ($deptId) {
            $query->where('dept_id', $deptId);
        })
        ->get();

    //yang telah diluluskan
    $claimsApproved = Claim::with('user.department')
    ->whereNotNull('sahkan_ketua_jabatan')
        ->whereHas('user', function ($query) use ($deptId) {
            $query->where('dept_id', $deptId);
        })
        ->get();


    $jumlahTuntutan = $claimsApproved->sum('jumlah_resit');
    $tuntutanBaharu = $claimsToProcess->where('status', 'DISEMAK')->count();
    $tuntutanDisahkan = Claim::where('status', 'DISAHKAN KETUA JABATAN')->count();
    $tuntutanDilulus = Claim::where('status', 'DILULUSKAN')->count();
    

    return view('dashboard.kjbt', compact(
        'claimsToProcess','claimsApproved', 'jumlahTuntutan', 'tuntutanBaharu','tuntutanDisahkan'));
}

public function dashboardKptkw(Request $request)
{

    $user = Auth::user();
    $deptId =$user->dept_id; //baca ketua pt dept mana     
    
    //kpt bleh tgk semua claim yang status menunggu pengesahan
    //jbtn sendiri sahaja
    $claimsToProcess = Claim::with('user.department')
    ->where('status', 'Baharu')
    ->whereHas('user', function ($query) use ($deptId) {
        $query->where('dept_id', $deptId);
    })
    ->get();

    //yang telah diluluskan
    $claimsApproved = Claim::with('user.department')
    ->where('status', 'DILULUSKAN')
    ->whereHas('user', function ($query) use ($deptId) {
        $query->where('dept_id', $deptId);
    })
    ->get();


    $jumlahTuntutan = $claimsApproved->sum('jumlah_resit');
    $tuntutanBaharu = $claimsToProcess->where('status', 'DISEMAK')->count();
    $tuntutanDisemak = Claim::where('status', 'DISEMAK')->count();
    $tuntutanDilulus = Claim::where('status', 'DILULUSKAN')->count();
    

    return view('dashboard.kptkw', compact(
        'claimsToProcess','claimsApproved', 'jumlahTuntutan', 'tuntutanBaharu','tuntutanDisemak','tuntutanDilulus'));
}

public function dashboardKptjkp(Request $request)
{

    $user = Auth::user();     
    
     // kPTJKP hanya boleh sahkan tuntutan yang telah disemak oleh ptjkp
    //$claims = Claim::with('user.department')
       // ->whereNotNull('semak_ptjkp') // Pastikan telah disahkan (bukan null)
        //->get();

         // PTJKP hanya boleh semak tuntutan yang telah disahkan oleh ketua jabatan
    $claimsToProcess = Claim::with('user.department')
        ->whereNotNull('semak_ptjkp') // Pastikan telah disahkan (bukan null)
        ->get();

    $claimsApproved = Claim::with('user.department')
        ->whereNotNull('sahkan_kptjkp') // yang sudah disemak
        ->get();

    $jumlahTuntutan = $claimsApproved->sum('jumlah_resit');
    $tuntutanBaharu = $claimsToProcess->where('status', 'Baharu')->count();
    $tuntutanDisemak = Claim::where('status', 'DISEMAK')->count();
    $tuntutanTLengkap = Claim::where('status', 'TIDAK LENGKAP')->count();
    $tuntutanDiluluskan = Claim::where('status', 'DILULUSKAN')->count();

    return view('dashboard.kptjkp', compact(
        'claimsToProcess','claimsApproved', 'jumlahTuntutan', 'tuntutanBaharu','tuntutanDisemak','tuntutanTLengkap','tuntutanDiluluskan'));
}
}
