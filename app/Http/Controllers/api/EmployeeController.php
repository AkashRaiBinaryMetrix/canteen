<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\admin\CardInventory;
use App\Models\admin\Employee;
use App\Models\admin\ItemMaster;
use Illuminate\Http\Request;
use Hash;
use Helper;

class EmployeeController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $json=array();
            $input=$request->all();
           if(!empty($input['passcode']))
           {
           if(!empty($input['employee_id']))
           {
                $checklogin=CardInventory::where('empId',$input['employee_id'])->first();
                if(empty($checklogin))
                {
                    $Json['status']=false;
                    $Json['msg']='Employee id not exist!';
                    return response()->json($Json);
                    die;
                }else
                {
                    if(Hash::check($input['passcode'], $checklogin->passcode))
                    {
                        $token = Hash::make($input['employee_id']);
                        CardInventory::where('empId',$input['employee_id'])->update(['access_token'=>$token]);
                        $employee['employee_id']=$checklogin->empId;
                        $employee['employee_name']=$checklogin->empName;
                        $employee['employee_type']=$checklogin->empCategory;
                        $foodinfo=ItemMaster::where('canteenCode',$checklogin->canteenCode)->where('empCategory',$checklogin->empCategory)->get();
                        $minutes=9;
                        $currentdatetime=\Carbon\Carbon::now()->addMinutes($minutes);
                        $time=date('H:i',strtotime($currentdatetime));
                        $foodinfotime=ItemMaster::where('canteenCode',$checklogin->canteenCode)->where('empCategory',$checklogin->empCategory)->where('Start_Time', '<=',$time)->where('End_Time','>=',$time)->first();
                        $employee['FoodType']='';
                     
                        if(!empty($foodinfotime))
                        {
                            if(!empty($foodinfotime))
                            {
                                $foodtype['id']=$foodinfotime->item_id;
                                $foodtype['type']=$foodinfotime->item_desc ?? '';
                                $employee['FoodType']=$foodtype;
                            }
                            $Json['status']=true;
                            $Json['access_token']='Bearer '.$token;
                            $Json['msg']='You have logged in successfully.';
                            $Json['EmployeeInfo']=$employee;
                        }else
                        {
                            $Json['status']=false;
                            $Json['msg']='Sorry,Currently food service is not available!';
                        }
                        return response()->json($Json);
                        die;
                      
                    }else
                    {
                        $Json['status']=false;
                        $Json['msg']='Invalid passcode';
                        return response()->json($Json);
                        die;
                    }
                }
            }else
            {
                $Json['status']=false;
                $Json['msg']='Employee id is required';
                return response()->json($Json);
            }
           }else{
            $Json['status']=false;
            $Json['msg'] = 'Passcode is required'; 
            return response()->json($Json);
            die;
          }
        }else
        {
            $Json['status']=false;
            $Json['msg']='Method not allowed for this request';
            return response()->json($Json);
            die;
        }
    }

     public function addmeal(Request $request)
    {
        if($request->isMethod('post'))
        {
            date_default_timezone_set("Asia/Kolkata");
            $user = Helper::isAuthorize($request);
            if(!empty($user))
            {
             $input=$request->all();
               if(!empty($input['food_type']))
               {
               if(!empty($input['quantity']))
               {
                $checklogin=CardInventory::where('empId',$user->empId)->first();
                $minutes=9;
                $currentdatetime=\Carbon\Carbon::now()->addMinutes($minutes);
                $time=date('H:i',strtotime($currentdatetime));
                $foodinfotime=ItemMaster::where('canteenCode',$checklogin->canteenCode)->where('empCategory',$checklogin->empCategory)->where('Start_Time', '<=',$time)->where('End_Time','>=',$time)->first();
                
                $checkfoodtime=Employee::where('empCategory',$checklogin->empCategory)->where('meal_time', 'like', '%' . date('d-m-Y') . '%')->where('empId',$user->empId)->where('food_type',$input['food_type'])->first();
                $foodinfoname=ItemMaster::where('item_id',$input['food_type'])->first();
                if(!empty($foodinfotime))
                {
                    if(!empty($foodinfotime))
                    {
                        $foodtype['id']=$foodinfotime->item_id;
                        $foodtype['type']=$foodinfotime->item_desc ?? '';
                        $FoodType=$foodtype;
                    }
                    if($foodinfoname->item_desc==$foodinfotime->item_desc)
                    {
                        $json=array();
                        $employee=new Employee;
                        $employee->empId=$user->empId;
                        $employee->empcategory=$user->empCategory;
                        $employee->food_type=$input['food_type'];
                        $employee->quantity=$input['quantity'];
                        $employee->canteen_code=$foodinfoname->canteenCode;
                        $employee->meal_date=date('d-m-Y');
                        $employee->meal_time=date('d-m-Y h:m:i A');
                        $employee->created_at=\Carbon\Carbon::now();
                        $employee->save();

                        $Json['status']=true;
                        $Json['msg']='Thank you';
                        return response()->json($Json);
                    }else
                    {
                        $Json['status']=false;
                        $Json['msg']='Something went wrong,Please add your meal again';
                        $Json['FoodType']=$FoodType;
                        return response()->json($Json);
                    }
                }else
                {
                    $Json['status']=false;
                    $Json['msg']='Sorry,Currently food service is not available!';
                    return response()->json($Json);
                }
                
            }else
            {
                $Json['status']=false;
                $Json['msg']='Food quantity is required';
                return response()->json($Json);
            }
           }else{
            $Json['status']=false;
            $Json['msg'] = 'Food type is required'; 
            return response()->json($Json);
            die;
          }
           
        }else
        {
            $Json['status']=false;
            $Json['msg']='Unauthorized Request';
            return response()->json($Json);
            die;
        }
        }else
        {
            $Json['status']=false;
            $Json['msg']='Method not allowed for this request';
            return response()->json($Json);
            die;
        }
    }

    public function logout(Request $request)
    {
        $user = Helper::isAuthorize($request);
        if(!empty($user))
        {
            CardInventory::where('access_token',$user->access_token)->update(['access_token'=>'']);
            $Json['status']=true;
            $Json['msg']='You have logout successfully';
            return response()->json($Json);
        }else
        {
            $Json['status']=false;
            $Json['msg']='Unauthorized Request';
            return response()->json($Json);
            die;
        }
    }
}
