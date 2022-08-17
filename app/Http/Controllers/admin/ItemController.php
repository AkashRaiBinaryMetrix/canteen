<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CanteenMaster;
use App\Models\admin\ItemMaster;
use App\Models\admin\EmpCategoryMaster;
use App\Models\admin\Employee;
use Carbon\Carbon;
use Session;

class ItemController extends Controller
{
    public function itemcreate(Request $request)
    {
        if($request->isMethod('post'))
        {

            $this->validate($request, [
                 'canteenCode' => 'required',
                 'item_name' => 'required',
                 'emp_contribution' => 'required',
                 'cmp_contribution' => 'required',
                 'Start_Time' => 'required',
                 'End_Time' => 'required',
                 'empCategory' => 'required',
                 // 'status' => 'required'
            ]);
            
            $start = Carbon::parse($request->Start_Time);
            $end = Carbon::parse($request->End_Time);
            $minutes = $end->diffInMinutes($start);
            if($minutes<30)
            {
                return redirect()->back()->withInput($request->all())->with('error','Time gap between start time and end time should be at least 30 minutes');
            }

            $result=Session::get('admin');
            if(!empty($request->item_id))
            {
               $checkitem=ItemMaster::where('item_desc',$request->item_name)->where('canteenCode',$request->canteenCode)->where('empCategory',$request->empCategory)->where('item_id','!=',$request->item_id)->first();
               if(empty($checkitem))
               {
                    $newid=$request->item_id;
                    $rate=$request->emp_contribution+$request->cmp_contribution;
                    $item= ItemMaster::where('item_id',$newid)->first();
                    $item->canteenCode=$request->canteenCode ?? '';
                    $item->item_desc=$request->item_name ?? '';
                    $item->emp_contribution=$request->emp_contribution ?? '';
                    $item->cmp_contribution=$request->cmp_contribution ?? '';
                    $item->Start_Time=$request->Start_Time ?? '';
                    $item->End_Time=$request->End_Time ?? '';
                    $item->empCategory=$request->empCategory ?? '';
                    $item->rate=$request->item_rate ?? '';
                    // $item->status=$request->status;
                    $item->create_by=$result->id ?? '';
                    $item->created_at=Carbon::now();

                    $item->save();
                    return redirect()->route('admin.manage.item')->with('success','Item details edited successfully');
                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','Item name already exist');
                }
               
                
                
            }else
            {
                $checkitem=ItemMaster::where('item_desc',$request->item_name)->where('canteenCode',$request->canteenCode)->where('empCategory',$request->empCategory)->first();
                if(empty($checkitem))
                {
                    $rate=$request->emp_contribution+$request->cmp_contribution;
                    $item= new ItemMaster;
                    $item->canteenCode=$request->canteenCode ?? '';
                    $item->item_desc=$request->item_name ?? '';
                    $item->emp_contribution=$request->emp_contribution ?? '';
                    $item->cmp_contribution=$request->cmp_contribution ?? '';
                    $item->Start_Time=$request->Start_Time ?? '';
                    $item->End_Time=$request->End_Time ?? '';
                    $item->empCategory=$request->empCategory ?? '';
                    $item->rate=$request->item_rate ?? '';
                    // $item->status=$request->status;
                    $item->create_by=$result->id ?? '';
                    $item->created_at=Carbon::now() ?? '';
                    $item->save();
                    return redirect()->route('admin.manage.item')->with('success','Item created successfully');
                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','Item name already exist');
                }
                
                
            }
            
            
        }else
        {
            $canteendata=CanteenMaster::all();
            $empcategory=EmpCategoryMaster::all();
            return view('admin.item.create_item',['canteendata'=>$canteendata,'empcategory'=>$empcategory]);
        }
    }

    public function manageitem(Request $request)
    {
        $result=Session::get('admin');
        if($result->role_name!='Admin')
        {
            $itemdata=ItemMaster::leftjoin('canteen_master','item_master.canteenCode','canteen_master.canteenCode')->where('item_master.create_by',$result->id)->select('canteen_master.canteenName','item_master.*')->orderBy('item_id','DESC')->get();
        }else
        {
           $itemdata=ItemMaster::leftjoin('canteen_master','item_master.canteenCode','canteen_master.canteenCode')->select('canteen_master.canteenName','item_master.*')->orderBy('item_id','DESC')->get();
        }
        return view('admin.item.manage_item',['itemdata'=>$itemdata]);
    }
    public function edititem(Request $request,$id)
    {
        $newid=decrypt($id);
        $itemdata=ItemMaster::where('item_id',$newid)->first();
        $canteendata=CanteenMaster::all();
        $empcategory=EmpCategoryMaster::all();
        return view('admin.item.create_item',['item'=>$itemdata,'canteendata'=>$canteendata,'empcategory'=>$empcategory]);
       
    }
    public function deleteitem(Request $request,$id)
    {
        $newid=decrypt($id);
        Employee::where('food_type',$newid)->delete();
        $item= ItemMaster::where('item_id',$newid)->delete();
        if($item)
        {
            return redirect()->back()->with('success','Item details deleted successfully');
        }else
        {
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
