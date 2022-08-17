<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CanteenMaster;
use App\Models\admin\DepartmentMaster;
use App\Models\admin\CardInventory;
use App\Models\admin\Employee;
use Carbon\Carbon;
use Session;

class DepartmentController extends Controller
{
    public function departmentcreate(Request $request)
    {
        if($request->isMethod('post'))
        {
           $this->validate($request, [
                 'canteenCode' => 'required',
                 'deptName' => 'required',
                 'flag' => 'required'
            ]);
            $result=Session::get('admin');
            if(!empty($request->deptCode))
            {
                $newid=$request->deptCode;
                $checkcanteen=DepartmentMaster::where('canteenCode',$request->canteenCode)->where('deptName',$request->deptName)->where('deptCode','!=',$newid)->first();
                if(empty($checkcanteen))
                {
                $department= DepartmentMaster::where('deptCode',$newid)->first();
                $department->canteenCode=$request->canteenCode;
                $department->deptName=$request->deptName;
                $department->flag=$request->flag;
                $department->create_by=$result->id ?? '';
                $department->created_at=Carbon::now();
                $department->save();
                return redirect()->route('admin.manage.department')->with('success','Department details edited successfully');
                }else
                {
                    return redirect()->back()->with('error','Department name already exist');
                }
            }else
            {
                $checkcanteen=DepartmentMaster::where('canteenCode',$request->canteenCode)->where('deptName',$request->deptName)->first();
                if(empty($checkcanteen))
                {
                    $department= new DepartmentMaster;
                    $department->canteenCode=$request->canteenCode;
                    $department->deptName=$request->deptName;
                    $department->flag=$request->flag;
                    $department->create_by=$result->id ?? '';
                    $department->created_at=Carbon::now();
                    $department->save();
                    return redirect()->route('admin.manage.department')->with('success','Department created successfully');

                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','Department name already exist');
                }
                
            }
            
            
        }else
        {
            $canteendata=CanteenMaster::all();
            return view('admin.department.create_department',['canteendata'=>$canteendata]);
        }
    }

    public function managedepartment(Request $request)
    {
        $result=Session::get('admin');
        if($result->role_name!='Admin')
        {
            $departmentdata=DepartmentMaster::leftjoin('canteen_master','dept_master.canteenCode','canteen_master.canteenCode')->where('dept_master.create_by',$result->id)->select('canteen_master.canteenName','dept_master.*')->orderBy('deptCode','DESC')->get();
        }else
        {
            $departmentdata=DepartmentMaster::leftjoin('canteen_master','dept_master.canteenCode','canteen_master.canteenCode')->select('canteen_master.canteenName','dept_master.*')->orderBy('deptCode','DESC')->get();
        }
        
        return view('admin.department.manage_department',['departmentdata'=>$departmentdata]);
    }
    public function editdepartment(Request $request,$id)
    {
        $newid=decrypt($id);
        $departmentdata=DepartmentMaster::where('deptCode',$newid)->first();
        $canteendata=CanteenMaster::all();
        return view('admin.department.create_department',['department'=>$departmentdata,'canteendata'=>$canteendata]);
       
    }
    public function deletedepartment(Request $request,$id)
    {
        $newid=decrypt($id);
        $deptname=DepartmentMaster::where('deptCode',$newid)->first();
        $userids=CardInventory::where('department',$deptname->deptName)->pluck('empId')->toArray();
        if(!empty($userids))
        {
            Employee::where('empid',$userids)->first();
        }
        $cardin=CardInventory::where('department',$deptname->deptName)->first();
        if(empty($userids) && empty($cardin))
        {
            $department= DepartmentMaster::where('deptCode',$newid)->delete();
            return redirect()->back()->with('success','Department deleted successfully');
        }else
        {
            return redirect()->back()->with('error','Sorry,You can not delete this department');
        }
    }
}
