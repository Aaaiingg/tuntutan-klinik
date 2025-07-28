<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff'; // jika anda mahu jelaskan nama jadual

    protected $fillable = [
        'staff_no',
        'staff_nama',
        'staff_jawatan',
        'staff_kelayakan',
        'dept_id',
        'status',
    ];

    // app/Models/Staff.php
public function claims()
{
    return $this->hasMany(Claim::class, 'staff_no', 'staff_no');
}

public function departments()
{
    return $this->belongsTo(Department::class, 'dept_id'); // jika dept_id digunakan
}

}
