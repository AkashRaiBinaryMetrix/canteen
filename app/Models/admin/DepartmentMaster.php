<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentMaster extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'dept_master';
    protected $primaryKey = 'deptCode';

    protected $fillable=['deptCode','canteenCode','deptName','flag','created_at'
        ];
}
