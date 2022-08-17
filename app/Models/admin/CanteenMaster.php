<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanteenMaster extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'canteen_master';

    protected $fillable=['canteenCode','canteenName','location','address','status','created_at','create_by'
        ];
}
