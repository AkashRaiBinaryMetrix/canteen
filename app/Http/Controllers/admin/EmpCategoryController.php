<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CanteenMaster;
use App\Models\admin\EmpCategoryMaster;
use App\Models\admin\CardInventory;
use App\Models\admin\Employee;
use App\Models\admin\ItemMaster;
use Carbon\Carbon;
use Session;

class EmpCategoryController extends Controller
{
     public function empcategorycreate(Request $request)
    {
        if($request->isMethod('post'))
        {
           $this->validate($request, [
                 'canteenCode' => 'required',
                 'empCat_Name' => 'required',
                 'flag' => 'required'
            ]);
            $result=Session::get('admin');
            if(!empty($request->empCat_Code))
            {
                $newid=$request->empCat_Code;
                $checkempcategory=EmpCategoryMaster::where('canteenCode',$request->canteenCode)->where('empCat_Name',$request->empCat_Name)->where('empCat_Code','!=',$newid)->first();
                if(empty($checkempcategory))
                {
                $empcategory= EmpCategoryMaster::where('empCat_Code',$newid)->first();
                $empcategory->canteenCode=$request->canteenCode;
                $empcategory->empCat_Name=$request->empCat_Name;
                $empcategory->flag=$request->flag;
                $empcategory->create_by=$result->id ?? '';
                $empcategory->created_at=Carbon::now();
                $empcategory->save();
                return redirect()->route('admin.manage.empcategory')->with('success','Employee Category details edited successfully');
                }else
                {
                    return redirect()->back()->with('error','Employee Category name already exist');
                }
            }else
            {
                $checkempcategory=EmpCategoryMaster::where('canteenCode',$request->canteenCode)->where('empCat_Name',$request->empCat_Name)->first();
                if(empty($checkempcategory))
                {
                    $empcategory= new EmpCategoryMaster;
                    $empcategory->canteenCode=$request->canteenCode;
                    $empcategory->empCat_Name=$request->empCat_Name;
                    $empcategory->flag=$request->flag;
                    $empcategory->create_by=$result->id ?? '';
                    $empcategory->created_at=Carbon::now();
                    $empcategory->save();
                    return redirect()->route('admin.manage.empcategory')->with('success','Employee Category created successfully');

                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','Employee Category name already exist');
                }
                
            }
            
            
        }else
        {
            $canteendata=CanteenMaster::all();
            return view('admin.empcategory.create_category',['canteendata'=>$canteendata]);
        }
    }

    public function manageempcategory(Request $request)
    {
        $result=Session::get('admin');
        if($result->role_name!='Admin')
        {
            $empcategorydata=EmpCategoryMaster::leftjoin('canteen_master','emp_category_master.canteenCode','canteen_master.canteenCode')->where('emp_category_master.create_by',$result->id)->select('canteen_master.canteenName','emp_category_master.*')->orderBy('empCat_Code','DESC')->get();
        }else
        {
           $empcategorydata=EmpCategoryMaster::leftjoin('canteen_master','emp_category_master.canteenCode','canteen_master.canteenCode')->select('canteen_master.canteenName','emp_category_master.*')->orderBy('empCat_Code','DESC')->get();
        }
        return view('admin.empcategory.manage_category',['empcategorydata'=>$empcategorydata]);
    }
    public function editempcategory(Request $request,$id)
    {
        $newid=decrypt($id);
        $empcategorydata=EmpCategoryMaster::where('empCat_Code',$newid)->first();
        $canteendata=CanteenMaster::all();
        return view('admin.empcategory.create_category',['empcategory'=>$empcategorydata,'canteendata'=>$canteendata]);
       
    }
    public function deleteempcategory(Request $request,$id)
    {
        $newid=decrypt($id);
        $empcatname=EmpCategoryMaster::where('empCat_Code',$newid)->first();
        $userids=CardInventory::where('canteenCode',$empcatname->canteenCode)->where('empCategory',$empcatname->empCat_Name)->pluck('empId')->toArray();
        $item=ItemMaster::where('canteenCode',$empcatname->canteenCode)->where('empCategory',$empcatname->empCat_Name)->first();
        $cardin=CardInventory::where('canteenCode',$empcatname->canteenCode)->where('empCategory',$empcatname->empCat_Name)->first();
        if(empty($userids) && empty($cardin) && empty($item))
        {
            $empcategory= EmpCategoryMaster::where('canteenCode',$empcatname->canteenCode)->where('empCat_Code',$newid)->delete();
            return redirect()->back()->with('success','Employee Category details deleted successfully');
        }else
        {
            return redirect()->back()->with('error','Sorry,You can not delete this Employee category');
        }
    }
}
