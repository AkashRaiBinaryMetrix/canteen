<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CanteenMaster;
use App\Models\admin\DepartmentMaster;
use App\Models\admin\DivisionMaster;
use App\Models\admin\EmpCategoryMaster;
use App\Models\admin\CardInventory;
use App\Models\admin\ItemMaster;
use App\Models\admin\Employee;
use App\Models\User;
use Carbon\Carbon;
use Session;

class CanteenController extends Controller
{
    public function canteencreate(Request $request)
    {
        if($request->isMethod('post'))
        {
           $this->validate($request, [
                 'title' => 'required',
                 'status' => 'required'
            ]);
            $result=Session::get('admin');
            if(!empty($request->canteen_code))
            {
                $newid=$request->canteen_code;
                $checkcanteen=CanteenMaster::where('canteenName',$request->title)->where('canteenCode','!=',$newid)->first();
                if(empty($checkcanteen))
                {
                    $canteendata['canteenName']=$request->title ?? '';
                    $canteendata['location']=$request->location ?? '';
                    $canteendata['address']=$request->address ?? '';
                    $canteendata['status']=$request->status ?? '';
                    $canteendata['create_by']=$result->id ?? '';
                    $canteendata['created_at']=Carbon::now();
                    CanteenMaster::where('canteenCode',$newid)->update($canteendata);
                    
                    return redirect()->route('admin.manage.canteen')->with('success','Canteen details edited successfully');
                }else
                {
                    return redirect()->back()->with('error','Canteen name already exist');
                }
            }else
            {
                $checkcanteen=CanteenMaster::where('canteenName',$request->title)->first();
                if(empty($checkcanteen))
                {
                $canteen= new CanteenMaster;
                $canteen->canteenName=$request->title;
                $canteen->location=$request->location;
                $canteen->address=$request->address;
                $canteen->status=$request->status;
                $canteen['create_by']=$result->id;
                $canteen['created_at']=Carbon::now();
                $canteen->save();
                return redirect()->route('admin.manage.canteen')->with('success','Canteen created successfully');
                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','Canteen name already exist');
                }
            }
            
            
        }else
        {
            return view('admin.canteen.create_canteen');
        }
    }

    public function managecanteen(Request $request)
    {
        $result=Session::get('admin');
        if($result->role_name!='Admin')
        {
            $canteendata=CanteenMaster::where('create_by',$result->id)->get();
        }else
        {
            $canteendata=CanteenMaster::get();
        }
        
        return view('admin.canteen.manage_canteen',['canteendata'=>$canteendata]);
    }
    public function editcanteen(Request $request,$id)
    {
        $newid=decrypt($id);
        $canteendata=CanteenMaster::where('canteenCode',$newid)->first();
        return view('admin.canteen.create_canteen',['canteen'=>$canteendata]);
       
    }
    public function deletecanteen(Request $request,$id)
    {
        $newid=decrypt($id);
        $userids=CardInventory::where('canteenCode',$newid)->pluck('empId')->toArray();
        $cardin=CardInventory::where('canteenCode',$newid)->first();
        $dept=DepartmentMaster::where('canteenCode',$newid)->first();
        $div=DivisionMaster::where('canteenCode',$newid)->first();
        $empcat=EmpCategoryMaster::where('canteenCode',$newid)->first();
        $item=ItemMaster::where('canteenCode',$newid)->first();
        if(!empty($userids))
        {
            Employee::where('empid',$userids)->first();
        }
        $user=User::where('canteen_code',$newid)->first();
        if(empty($userids) && empty($cardin) && empty($dept) && empty($div) && empty($empcat) && empty($item) && empty($user))
        {
          $canteen= CanteenMaster::where('canteenCode',$newid)->delete();  
          return redirect()->back()->with('success','Canteen details deleted successfully');
        }else
        {
            return redirect()->back()->with('error','Sorry,You can not delete this canteen');
        }
    }
}
