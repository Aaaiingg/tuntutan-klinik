<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class KJBTController extends Controller
{
    // Fungsi untuk memaparkan dashboard PTK
    public function index(Request $request)
{
    $search = $request->input('search');

    

        //tuntutan yang perlu diluluskan
        $claimsToProcess = Claim::with('user.department')
        ->where('status', 'Baharu')
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
    $tuntutanDisahkan = Claim::where('status', 'DISAHKAN KETUA JABATAN')->count();


    return view('dashboard.kjbt', compact('claimsToProcess', 'jumlahTuntutan','tuntutanBaharu','tuntutanDisahkan'));
}
    public function show()
{
    $deptId = auth::user()->dept_id; // guna dept_id

    $claims = Claim::with('staff')
        ->whereHas('staff', function ($query) use ($deptId) {
            $query->where('dept_id', $deptId); // guna dept_id
        })
        ->get();

    return view('kjbt.show', compact('claims'));

}
public function sahkan($id)
{
    $claim = Claim::findOrFail($id);

    // Kemas kini pengesahan Ketua Jabatan
    $claim->sahkan_ketua_jabatan = Auth::user()->name;
    $claim->status = 'DISAHKAN KETUA JABATAN';
    $claim->save();

    return redirect()->back()->with('success', 'Tuntutan telah disahkan oleh Ketua Jabatan.');
}

public function tidakLengkap($id)
{
    $claim = Claim::findOrFail($id);
    $claim->status = 'TIDAK LENGKAP';
    $claim->save();

    return redirect()->back()->with('error', 'Tuntutan ditandakan sebagai tidak lengkap.');
}
public function exportPDF()
{
    $claims = Claim::with('staff')->get();
    $pdf = PDF::loadView('exports.claims', compact('claims'));
    return $pdf->download('senarai_tuntutan.pdf');
}


}
