<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpCategoryMaster extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'emp_category_master';
    protected $primaryKey = 'empCat_Code';

    protected $fillable=['empCat_Code','canteenCode','empCat_Name','flag','created_at'
        ];
}
