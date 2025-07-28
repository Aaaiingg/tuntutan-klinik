<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_no',
        'nama_klinik',
        'no_resit',
        'jumlah_resit',
        'bulan',
        'resit_path',
        'tarikh_resit',
        'status',
        'sahkan_ketua_jabatan',
        'semak_ptjkp',
        'sahkan_kptjkp',
        'lulus_pkjkp',
        'semak_ptkw',
        'sahkan_kptkw',
        'lulus_pkkw',
    ];

    // Jika nak guna hubungan dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // app/Models/Claim.php
public function staff()
{
    return $this->belongsTo(Staff::class, 'staff_no', 'staff_no');
}

}