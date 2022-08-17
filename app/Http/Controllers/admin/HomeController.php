<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin\CanteenMaster;
use App\Models\admin\DepartmentMaster;
use App\Models\admin\DivisionMaster;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result=Session::get('admin');
        // dd($result);
        if($result->role_name!='Admin')
        {
            $totalusers=User::where('create_by',$result->id)->get()->count();
            $totalcanteen=CanteenMaster::where('create_by',$result->id)->get()->count();
            $totaldepartment=DepartmentMaster::where('create_by',$result->id)->get()->count();
            $totaldivision=DivisionMaster::where('create_by',$result->id)->get()->count();
        }else
        {
            $totalusers=User::get()->count();
            $totalcanteen=CanteenMaster::get()->count();
            $totaldepartment=DepartmentMaster::get()->count();
            $totaldivision=DivisionMaster::get()->count();
        }
        
        return view('admin.dashboard',['user'=>$totalusers,'canteen'=>$totalcanteen,'department'=>$totaldepartment,'division'=>$totaldivision]);
    }
}

