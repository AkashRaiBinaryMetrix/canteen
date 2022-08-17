<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CanteenMaster;
use App\Models\admin\DivisionMaster;
use App\Models\admin\CardInventory;
use App\Models\admin\Employee;
use Carbon\Carbon;
use Session;

class DivisionController extends Controller
{
    public function divisioncreate(Request $request)
    {
        if($request->isMethod('post'))
        {
           $this->validate($request, [
                 'canteenCode' => 'required',
                 'divName' => 'required',
                 'flag' => 'required'
            ]);
            $result=Session::get('admin');
            if(!empty($request->divCode))
            {
                $newid=$request->divCode;
                $checkdivision=DivisionMaster::where('canteenCode',$request->canteenCode)->where('divName',$request->divName)->where('divCode','!=',$newid)->first();
                if(empty($checkdivision))
                {
                $division= DivisionMaster::where('divCode',$newid)->first();
                $division->canteenCode=$request->canteenCode;
                $division->divName=$request->divName;
                $division->flag=$request->flag;
                $division->create_by=$result->id ?? '';
                $division->created_at=Carbon::now();
                $division->save();
                return redirect()->route('admin.manage.division')->with('success','Division details edited successfully');
                }else
                {
                    return redirect()->back()->with('error','Division name already exist');
                }
            }else
            {
                $checkdivision=DivisionMaster::where('canteenCode',$request->canteenCode)->where('divName',$request->divName)->first();
                if(empty($checkdivision))
                {
                    $division= new DivisionMaster;
                    $division->canteenCode=$request->canteenCode;
                    $division->divName=$request->divName;
                    $division->flag=$request->flag;
                    $division->create_by=$result->id ?? '';
                    $division->created_at=Carbon::now();
                    $division->save();
                    return redirect()->route('admin.manage.division')->with('success','Division created successfully');

                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','Division name already exist');
                }
                
            }
            
            
        }else
        {
            $canteendata=CanteenMaster::all();
            return view('admin.division.create_division',['canteendata'=>$canteendata]);
        }
    }

    public function managedivision(Request $request)
    {
        $result=Session::get('admin');
        if($result->role_name!='Admin')
        {
            $divisiondata=DivisionMaster::leftjoin('canteen_master','div_master.canteenCode','canteen_master.canteenCode')->where('div_master.create_by',$result->id)->select('canteen_master.canteenName','div_master.*')->orderBy('divCode','DESC')->get();
        }else
        {
           $divisiondata=DivisionMaster::leftjoin('canteen_master','div_master.canteenCode','canteen_master.canteenCode')->select('canteen_master.canteenName','div_master.*')->orderBy('divCode','DESC')->get();
        }
        
        return view('admin.division.manage_division',['divisiondata'=>$divisiondata]);
    }
    public function editdivision(Request $request,$id)
    {
        $newid=decrypt($id);
        $divisiondata=DivisionMaster::where('divCode',$newid)->first();
        $canteendata=CanteenMaster::all();
        return view('admin.division.create_division',['division'=>$divisiondata,'canteendata'=>$canteendata]);
       
    }
    public function deletedivision(Request $request,$id)
    {
        $newid=decrypt($id);
        $divname=DivisionMaster::where('divCode',$newid)->first();
        $userids=CardInventory::where('division',$divname->divName)->pluck('empId')->toArray();
        if(!empty($userids))
        {
            Employee::where('empid',$userids)->first();
        }
        $cardin=CardInventory::where('division',$divname->divName)->first();
        if(empty($userids) && empty($cardin))
        {
            $division= DivisionMaster::where('divCode',$newid)->delete();
            return redirect()->back()->with('success','Division details deleted successfully');
        }
        else
        {
            return redirect()->back()->with('error','Sorry,You can not delete this division');
        }
    }
}
