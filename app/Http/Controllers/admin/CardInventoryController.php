<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CanteenMaster;
use App\Models\admin\ItemMaster;
use App\Models\admin\EmpCategoryMaster;
use App\Models\admin\CardInventory;
use App\Models\admin\DivisionMaster;
use App\Models\admin\DepartmentMaster;
use Carbon\Carbon;
use Session;

class CardInventoryController extends Controller
{
    public function cardcreate(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                 'canteenCode' => 'required',
                 'empCategory' => 'required',
                 'department' => 'required',
                 'empId' => 'required',
                 'empName' => 'required',
                 'division' => 'required',
                 'password' => 'required',
                 'cardType' => 'required',
                 //'remarks' => 'required',
                 //'flag2' => 'required'
            ]);

            $result=Session::get('admin');

            if(!empty($request->cardId))
            {
                
                $checkempId=CardInventory::where('department',$request->department)->where('canteenCode',$request->canteenCode)->where('empCategory',$request->empCategory)->where('empId',$request->empId)->where('cardId','!=',$request->cardId)->first();
                $checkemail=CardInventory::where('email',$request->email)->where('cardId','!=',$request->cardId)->first();
                $checkmobile=CardInventory::where('mobile',$request->mobile)->where('cardId','!=',$request->cardId)->first();
               
                        if(empty($checkempId))
                        {
                            if(empty($checkemail))
                            {
                                if(empty($checkmobile))
                                {
                                    $newid=$request->cardId;
                                    $card= CardInventory::where('cardId',$newid)->first();
                                    $card->canteenCode=$request->canteenCode ?? '';
                                    $card->department=$request->department ?? '';
                                    $card->empId=$request->empId ?? '';
                                    $card->empCategory=$request->empCategory ?? '';
                                    $card->empName=$request->empName ?? '';
                                    $card->mobile=$request->mobile ?? '';
                                    $card->email=$request->email ?? '';
                                    $card->create_by=$result->id ?? '';
                                    $card->division=$request->division ?? '';
                                    $card->password=$request->password ?? '';
                                    $card->cardType=$request->cardType ?? '';
                                    $card->registrationDate=Carbon::now();
                                    $card->save();
                                    return redirect()->route('admin.manage.card')->with('success','Card details edited successfully');
                                
                        }else
                        {
                            return redirect()->back()->withInput($request->all())->with('error','This mobile number already exist');
                        }
                    }else
                    {
                        return redirect()->back()->withInput($request->all())->with('error','This email id already exist');
                    }
                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','This employee id already exist');
                }
                
            }else
            {
               
                $checkempId=CardInventory::where('department',$request->department)->where('canteenCode',$request->canteenCode)->where('empCategory',$request->empCategory)->where('empId',$request->empId)->first();
                $checkemail=CardInventory::where('email',$request->email)->first();
                $checkmobile=CardInventory::where('mobile',$request->mobile)->first();
                
                        if(empty($checkempId))
                        {
                            if(empty($checkemail))
                            {
                                if(empty($checkmobile))
                                {
                        $card= new CardInventory;
                        $card->canteenCode=$request->canteenCode ?? '';
                        $card->department=$request->department ?? '';
                        $card->empId=$request->empId ?? '';
                        $card->empCategory=$request->empCategory ?? '';
                        $card->empName=$request->empName ?? '';
                        $card->mobile=$request->mobile ?? '';
                        $card->email=$request->email ?? '';
                        $card->create_by=$result->id ?? '';
                        $card->division=$request->division ?? '';
                        $card->password=$request->password ?? '';
                        $card->cardType=$request->cardType ?? '';
                        $card->registrationDate=Carbon::now();
                        $card->save();
                        return redirect()->route('admin.manage.card')->with('success','Card details created successfully');    
                                               }else
                        {
                            return redirect()->back()->withInput($request->all())->with('error','This mobile number already exist');
                        }
                    }else
                    {
                        return redirect()->back()->withInput($request->all())->with('error','This email id already exist');
                    }
                }else
                {
                    return redirect()->back()->withInput($request->all())->with('error','This employee id already exist');
                }
            }
             
        }else
        {
            $canteendata=CanteenMaster::all();
            $empcategory=EmpCategoryMaster::all();
            $department=DepartmentMaster::all();
            $division=DivisionMaster::all();
            return view('admin.card.create_card',['canteendata'=>$canteendata,'empcategory'=>$empcategory,'department'=>$department,'division'=>$division]);
        }
    }

    public function managecard(Request $request)
    {
        $carddata=CardInventory::leftjoin('canteen_master as cm','card_inventory_master.canteenCode','cm.canteenCode')->orderBy('card_inventory_master.cardId','DESC')->get();
        return view('admin.card.manage_card',['carddata'=>$carddata]);
    }
    public function editcard(Request $request,$id)
    {
        $newid=decrypt($id);
        $carditem=CardInventory::where('cardId',$newid)->first();
        $canteendata=CanteenMaster::all();
        $empcategory=EmpCategoryMaster::all();
        $department=DepartmentMaster::all();
        $division=DivisionMaster::all();
        return view('admin.card.create_card',['carditem'=>$carditem,'canteendata'=>$canteendata,'empcategory'=>$empcategory,'department'=>$department,'division'=>$division]);
       
    }
    public function deletecard(Request $request,$id)
    {
        $newid=decrypt($id);
        $item= CardInventory::where('cardId',$newid)->delete();
        if($item)
        {
            return redirect()->back()->with('success','Card details deleted successfully');
        }else
        {
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
