<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class CardInventory extends Model
{
    use HasFactory;
    use HasApiTokens;
    
    public $timestamps = false;

    protected $table = 'card_inventory_master';
    protected $primaryKey = 'cardId';

    protected $fillable=['cardId','cardUid','cardNo','empId','empName','mobile','email','division','department','cardStatus','canteenCode','registrationDate','password','cardType','remarks','flag2','empCategory','create_by'
        ];
}
