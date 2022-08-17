<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'item_master';
    protected $primaryKey = 'item_id';

    protected $fillable=['item_desc','canteenCode','emp_contribution','status','created_at','cmp_contribution','rate','flag','Start_Time','End_Time','empCategory'
        ];
}
