<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionMaster extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'div_master';
    protected $primaryKey = 'divCode';

    protected $fillable=['divCode','canteenCode','divName','flag','created_at'
        ];
}
