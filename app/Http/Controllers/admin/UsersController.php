<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Models\Role;
use App\Models\admin\CanteenMaster;
use App\Models\admin\EmpCategoryMaster;
use App\Models\admin\Employee;
use App\Models\admin\CardInventory;
use App\Models\admin\ItemMaster;
use App\Models\admin\DepartmentMaster;
use App\Models\admin\DivisionMaster;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;


class UsersController extends Controller
{
    public function index()
    {
        $result=Session::get('admin');
        if($result->role_name!='Admin')
        {
            $users=User::where('create_by',$result->id)->get(); 
        }else
        {
            $users=User::all();
        }
        return view('admin.users.manage_users')->with(['users'=>$users]);
    }

    public function add(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator= Validator::make($request->all(), [
            'canteenCode' => 'required',
            'name' => 'required',
            'type' => 'required|',
            'password' => 'required',
            'confirm_password' => 'required',
            'role_id' => 'required',
            ]);
            $result=Session::get('admin');
            if ($validator->fails()) {
                        return redirect()
                        ->back()
                        ->withInput($request->all())
                        ->withErrors($validator);
            }
            $checkuser=User::where('opr_id',$request->name)->first();
            if(empty($checkuser))
            {
                if($request->password!=$request->confirm_password)
                {
                    return redirect()->back()->with('error','Password and Confirm password not matched!');
                }else
                {
                    $newuser= new User;
                    $newuser->opr_id=$request->name ?? '';
                    $newuser->name=$request->username ?? '';
                    $newuser->canteen_code=$request->canteenCode ?? '';
                    $newuser->userType=$request->type ?? '';
                    $newuser->role_id=$request->role_id ?? '';
                    $newuser->password=$request->password ?? '';
                    $newuser->templateName=$request->template ?? '';
                    $newuser->create_by=$result->id ?? '';
                    $newuser->created_at=\Carbon\Carbon::now();
                    $newuser->save();
                    return redirect()->route('admin.manage.users')->with('success','User created successfully!');
                }
            }else
            {
                return redirect()->back()->withInput($request->all())->with('error','User email already exist!');
            }
           
        }else
        {
           
            $canteendata=CanteenMaster::all();
            $empcategory=EmpCategoryMaster::all();
            $roles=Role::all();
            return view('admin.users.add_users')->with(['canteendata'=>$canteendata,'empcategory'=>$empcategory,'roles'=>$roles]);
        }
    }

    public function edit(Request $request,$id)
    {
        $id=decrypt($id);
        if($request->isMethod('post'))
        {
            $result=Session::get('admin');
            $checkuser=User::where('id','!=',$id)->where('opr_id',$request->name)->first();
            if(empty($checkuser))
            {
                $useredit['opr_id']=$request->name ?? '';
                $useredit['name']=$request->username ?? '';
                $useredit['canteen_code']=$request->canteenCode ?? '';
                $useredit['userType']=$request->type ?? '';
                $useredit['role_id']=$request->role_id ?? '';
                $useredit['password']=$request->password ?? '';
                $useredit['templateName']=$request->template ?? '';
                $useredit['create_by']=$result->id ?? '';
                User::where('id',$id)->update($useredit);
                return redirect()->route('admin.manage.users')->with('success','User details edited successfully!');
            }else
            {
                return redirect()->back()->withInput($request->all())->with('error','User email already exist!');
            }   
        }else
        {
            $user=User::where('id',$id)->first();
            $canteendata=CanteenMaster::all();
            $empcategory=EmpCategoryMaster::all();
            $roles=Role::all();
            return view('admin.users.edit_user_details')->with(['user'=>$user,'canteendata'=>$canteendata,'empcategory'=>$empcategory,'roles'=>$roles]);
        }
    }

    public function delete($id)
    {
        $check=User::where('opr_id',$id)->delete();
        CanteenMaster::where('create_by',$id)->delete();
        DepartmentMaster::where('create_by',$id)->delete();
        DivisionMaster::where('create_by',$id)->delete();
        EmpCategoryMaster::where('create_by',$id)->delete();
        ItemMaster::where('create_by',$id)->delete();
        User::where('create_by',$id)->delete();
        Role::where('create_by',$id)->delete();
        return redirect()->back()->with('success','User details deleted successfully!');
    }

    public function user_status(Request $request)
    {
        
        $newid=$request->id;
        $statusnew=$request->status;

        if($statusnew=='reject')
        {  
           $check=User::where('id',$newid)->update(['reject_status'=>0]);
           User::where('id',$newid)->update(['user_status'=>0]);
           return 1;
        }
        if($statusnew=='approve')
        {  
           $check=User::where('id',$newid)->update(['reject_status'=>1]);
           return 1;
        }
        if($statusnew=='active')
        {  
           $check=User::where('id',$newid)->update(['user_status'=>1]);
           return 1;
        }
        if($statusnew=='deactive')
        {  
           $check=User::where('id',$newid)->update(['user_status'=>0]);
           return 1;
        }


    }

    public function addrole(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validated = $request->validate([
            'role_name' => 'required|unique:roles',
            ]);
            $result=Session::get('admin');
            $role=new Role;
            $role->role_name=$request->role_name;
            $role->create_by=$result->id ?? '';
            $role->created_at=\Carbon\Carbon::now();
            $role->updated_at=\Carbon\Carbon::now();
            $role->save();
            return redirect()->route('admin.users.role.manage')->with('success','User role created successfully!');
        }else
        {
            return view('admin.users.add_role');
        }
    }

    public function manage_roles()
    {
        $roles=Role::all();
        return view('admin.users.manage_user_roles')->with(['roles'=>$roles]);
    }

    public function deleterole($id)
    {
        $newid=decrypt($id);
        Role::where('id',$newid)->delete();
        \DB::table('roles_permissions')->where('role_id',$newid)->delete();
        return redirect()->back()->with('success','User role deleted successfully!');
    }

    public function editrole(Request $request,$id)
    {
        $newid=decrypt($id);
        if($request->isMethod('post'))
        {
            $validated = $request->validate([
            'role_name' => 'required',
            ]);
            $result=Session::get('admin');
            $role=Role::where('id',$newid)->first();
            $role->role_name=$request->role_name ?? '';
            $role->create_by=$result->id ?? '';
            $role->updated_at=\Carbon\Carbon::now();
            $role->save();
            return redirect()->route('admin.users.role.manage')->with('success','User role edited successfully!');
        }else
        {
            $role=Role::where('id',$newid)->first();
            return view('admin.users.edit_user_role')->with(['role'=>$role]);
        }
    }

    public function user_permission(Request $request)
    {
        $userrole=Role::all();

        return view('admin.users.manage_user_permission')->with(['userrole'=>$userrole]);
    }

    public function manage_user_permission(Request $request,$name)
    {

        if($request->isMethod('post'))
        {
            $data=$request->all();

            if(!empty($request->Home))
            {
                    $permission['role_id']=$request->role_id;
                    $permission['title']=$data['Home']['name'];
                    if(!empty($data['Home']['view_permission']))
                    {
                        $permission['view_permission']=$data['Home']['view_permission'];
                    }
                    

                $check=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Home']['name'])->first();

                if(empty($check))
                {
                    \DB::table('roles_permissions')->insert($permission);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Home']['name'])->update($permission);
                }   
            }
            
            if(!empty($request->Canteen))
            {
                    $Canteen['role_id']=$request->role_id;
                    $Canteen['title']=$data['Canteen']['name'];
                    if(!empty($data['Canteen']['view_permission']))
                    {
                        $Canteen['view_permission']=$data['Canteen']['view_permission'];
                    }else
                    {
                        $Canteen['view_permission']=NULL;
                    }
                    if(!empty($data['Canteen']['add_permission']))
                    {
                    $Canteen['add_permission']=$data['Canteen']['add_permission'];
                    }else
                    {
                        $Canteen['add_permission']=NULL;
                    }
                    if(!empty($data['Canteen']['manage_permission']))
                    {
                    $Canteen['manage_permission']=$data['Canteen']['manage_permission'];
                    }else
                    {
                        $Canteen['manage_permission']=NULL;
                    }
                    if(!empty($data['Canteen']['edit_permission']))
                    {
                    $Canteen['edit_permission']=$data['Canteen']['edit_permission'];
                    }else
                    {
                        $Canteen['edit_permission']=NULL;
                    }
                    if(!empty($data['Canteen']['delete_permission']))
                    {
                    $Canteen['delete_permission']=$data['Canteen']['delete_permission'];
                    }else
                    {
                        $Canteen['delete_permission']=NULL;
                    }
                    
                $checkcom=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Canteen']['name'])->first();
                if(empty($checkcom))
                {
                    \DB::table('roles_permissions')->insert($Canteen);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Canteen']['name'])->update($Canteen);
                }     
                   
            }
            if(!empty($request->Department))
            {
                    $Department['role_id']=$request->role_id;
                    $Department['title']=$data['Department']['name'];
                    if(!empty($data['Department']['view_permission']))
                    {
                        $Department['view_permission']=$data['Department']['view_permission'];
                    }else
                    {
                        $Department['view_permission']=NULL;
                    }
                    if(!empty($data['Department']['add_permission']))
                    {
                    $Department['add_permission']=$data['Department']['add_permission'];
                    }else
                    {
                        $Department['add_permission']=NULL;
                    }
                    if(!empty($data['Department']['manage_permission']))
                    {
                    $Department['manage_permission']=$data['Department']['manage_permission'];
                    }else
                    {
                        $Department['manage_permission']=NULL;
                    }
                    if(!empty($data['Department']['edit_permission']))
                    {
                    $Department['edit_permission']=$data['Department']['edit_permission'];
                    }else
                    {
                        $Department['edit_permission']=NULL;
                    }
                    if(!empty($data['Department']['delete_permission']))
                    {
                    $Department['delete_permission']=$data['Department']['delete_permission'];
                    }else
                    {
                        $Department['delete_permission']=NULL;
                    }
                $checkDepartment=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Department']['name'])->first();
                if(empty($checkDepartment))
                {
                    \DB::table('roles_permissions')->insert($Department);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Department']['name'])->update($Department);
                }     
            }
            if(!empty($request->Division))
            {
                    $Division['role_id']=$request->role_id;
                    $Division['title']=$data['Division']['name'];
                    if(!empty($data['Division']['view_permission']))
                    {
                        $Division['view_permission']=$data['Division']['view_permission'];
                    }else
                    {
                        $Division['view_permission']=NULL;
                    }
                    if(!empty($data['Division']['add_permission']))
                    {
                    $Division['add_permission']=$data['Division']['add_permission'];
                    }else
                    {
                        $Division['add_permission']=NULL;
                    }
                    if(!empty($data['Division']['manage_permission']))
                    {
                    $Division['manage_permission']=$data['Division']['manage_permission'];
                    }else
                    {
                        $Division['manage_permission']=NULL;
                    }
                    if(!empty($data['Division']['edit_permission']))
                    {
                    $Division['edit_permission']=$data['Division']['edit_permission'];
                    }else
                    {
                        $Division['edit_permission']=NULL;
                    }
                    if(!empty($data['Division']['delete_permission']))
                    {
                    $Division['delete_permission']=$data['Division']['delete_permission'];
                    }else
                    {
                        $Division['delete_permission']=NULL;
                    }
                $checkcat=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Division']['name'])->first();
                if(empty($checkcat))
                {
                    \DB::table('roles_permissions')->insert($Division);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Division']['name'])->update($Division);
                }     
            }
            if(!empty($request->EmployeeCategory))
            {
                    $EmployeeCategory['role_id']=$request->role_id;
                    $EmployeeCategory['title']=$data['EmployeeCategory']['name'];
                    if(!empty($data['EmployeeCategory']['view_permission']))
                    {
                        $EmployeeCategory['view_permission']=$data['EmployeeCategory']['view_permission'];
                    }else
                    {
                        $EmployeeCategory['view_permission']=NULL;
                    }
                    if(!empty($data['EmployeeCategory']['add_permission']))
                    {
                    $EmployeeCategory['add_permission']=$data['EmployeeCategory']['add_permission'];
                    }else
                    {
                        $EmployeeCategory['add_permission']=NULL;
                    }
                    if(!empty($data['EmployeeCategory']['manage_permission']))
                    {
                    $EmployeeCategory['manage_permission']=$data['EmployeeCategory']['manage_permission'];
                    }else
                    {
                        $EmployeeCategory['manage_permission']=NULL;
                    }
                    if(!empty($data['EmployeeCategory']['edit_permission']))
                    {
                    $EmployeeCategory['edit_permission']=$data['EmployeeCategory']['edit_permission'];
                    }else
                    {
                        $EmployeeCategory['edit_permission']=NULL;
                    }
                    if(!empty($data['EmployeeCategory']['delete_permission']))
                    {
                    $EmployeeCategory['delete_permission']=$data['EmployeeCategory']['delete_permission'];
                    }else
                    {
                        $EmployeeCategory['delete_permission']=NULL;
                    }
                $checksub=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['EmployeeCategory']['name'])->first();
                if(empty($checksub))
                {
                    \DB::table('roles_permissions')->insert($EmployeeCategory);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['EmployeeCategory']['name'])->update($EmployeeCategory);
                }     
            }
            if(!empty($request->Item))
            {
                    $Item['role_id']=$request->role_id;
                   $Item['title']=$data['Item']['name'];
                    if(!empty($data['Item']['view_permission']))
                    {
                        $Item['view_permission']=$data['Item']['view_permission'];
                    }else
                    {
                        $Item['view_permission']=NULL;
                    }
                    if(!empty($data['Item']['add_permission']))
                    {
                    $Item['add_permission']=$data['Item']['add_permission'];
                    }else
                    {
                        $Item['add_permission']=NULL;
                    }
                    if(!empty($data['Item']['manage_permission']))
                    {
                    $Item['manage_permission']=$data['Item']['manage_permission'];
                    }else
                    {
                        $Item['manage_permission']=NULL;
                    }
                    if(!empty($data['Item']['edit_permission']))
                    {
                    $Item['edit_permission']=$data['Item']['edit_permission'];
                    }else
                    {
                        $Item['edit_permission']=NULL;
                    }
                    if(!empty($data['Item']['delete_permission']))
                    {
                    $Item['delete_permission']=$data['Item']['delete_permission'];
                    }else
                    {
                        $Item['delete_permission']=NULL;
                    }
                $checkv=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Item']['name'])->first();
                if(empty($checkv))
                {
                    \DB::table('roles_permissions')->insert($Item);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['Item']['name'])->update($Item);
                }    
            }
            if(!empty($request->CardInventory))
            {
                    $CardInventory['role_id']=$request->role_id;
                    $CardInventory['title']=$data['CardInventory']['name'];
                    if(!empty($data['CardInventory']['view_permission']))
                    {
                        $CardInventory['view_permission']=$data['CardInventory']['view_permission'];
                    }else
                    {
                        $CardInventory['view_permission']=NULL;
                    }
                    if(!empty($data['CardInventory']['add_permission']))
                    {
                    $CardInventory['add_permission']=$data['CardInventory']['add_permission'];
                    }else
                    {
                        $CardInventory['add_permission']=NULL;
                    }
                    if(!empty($data['CardInventory']['manage_permission']))
                    {
                    $CardInventory['manage_permission']=$data['CardInventory']['manage_permission'];
                    }else
                    {
                        $CardInventory['manage_permission']=NULL;
                    }
                    if(!empty($data['CardInventory']['edit_permission']))
                    {
                    $CardInventory['edit_permission']=$data['CardInventory']['edit_permission'];
                    }else
                    {
                        $CardInventory['edit_permission']=NULL;
                    }
                    if(!empty($data['CardInventory']['delete_permission']))
                    {
                    $CardInventory['delete_permission']=$data['CardInventory']['delete_permission'];
                    }else
                    {
                        $CardInventory['delete_permission']=NULL;
                    }
                $checkCardInventory=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['CardInventory']['name'])->first();
                if(empty($checkCardInventory))
                {
                    \DB::table('roles_permissions')->insert($CardInventory);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['CardInventory']['name'])->update($CardInventory);
                }    
            }

            if(!empty($request->ManageUsers))
            {
                    $ManageUsers['role_id']=$request->role_id;
                    $ManageUsers['title']=$data['ManageUsers']['name'];
                    if(!empty($data['ManageUsers']['view_permission']))
                    {
                        $ManageUsers['view_permission']=$data['ManageUsers']['view_permission'];
                    }else
                    {
                        $ManageUsers['view_permission']=NULL;
                    }
                    if(!empty($data['ManageUsers']['add_permission']))
                    {
                    $ManageUsers['add_permission']=$data['ManageUsers']['add_permission'];
                    }else
                    {
                        $ManageUsers['add_permission']=NULL;
                    }
                    if(!empty($data['ManageUsers']['manage_permission']))
                    {
                    $ManageUsers['manage_permission']=$data['ManageUsers']['manage_permission'];
                    }else
                    {
                        $ManageUsers['manage_permission']=NULL;
                    }
                    if(!empty($data['ManageUsers']['edit_permission']))
                    {
                    $ManageUsers['edit_permission']=$data['ManageUsers']['edit_permission'];
                    }else
                    {
                        $ManageUsers['edit_permission']=NULL;
                    }
                    if(!empty($data['ManageUsers']['delete_permission']))
                    {
                    $ManageUsers['delete_permission']=$data['ManageUsers']['delete_permission'];
                    }else
                    {
                        $ManageUsers['delete_permission']=NULL;
                    }
                    
                $checkcom=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['ManageUsers']['name'])->first();
                if(empty($checkcom))
                {
                    \DB::table('roles_permissions')->insert($ManageUsers);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['ManageUsers']['name'])->update($ManageUsers);
                }     
                   
            }

            if(!empty($request->EmployeeMeal))
            {
                    $EmployeeMeal['role_id']=$request->role_id;
                    $EmployeeMeal['title']=$data['EmployeeMeal']['name'];
                    if(!empty($data['EmployeeMeal']['view_permission']))
                    {
                        $EmployeeMeal['view_permission']=$data['EmployeeMeal']['view_permission'];
                    }else
                    {
                        $EmployeeMeal['view_permission']=NULL;
                    }
                    if(!empty($data['EmployeeMeal']['manage_permission']))
                    {
                    $EmployeeMeal['manage_permission']=$data['EmployeeMeal']['manage_permission'];
                    }else
                    {
                        $EmployeeMeal['manage_permission']=NULL;
                    }
                    if(!empty($data['EmployeeMeal']['delete_permission']))
                    {
                    $EmployeeMeal['delete_permission']=$data['EmployeeMeal']['delete_permission'];
                    }else
                    {
                        $EmployeeMeal['delete_permission']=NULL;
                    }
                    
                $checkcom=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['EmployeeMeal']['name'])->first();
                if(empty($checkcom))
                {
                    \DB::table('roles_permissions')->insert($EmployeeMeal);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['EmployeeMeal']['name'])->update($EmployeeMeal);
                }     
                   
            }
            if(!empty($request->UserRole))
            {
                    $UserRole['role_id']=$request->role_id;
                    $UserRole['title']=$data['UserRole']['name'];
                    if(!empty($data['UserRole']['view_permission']))
                    {
                        $UserRole['view_permission']=$data['UserRole']['view_permission'];
                    }else
                    {
                        $UserRole['view_permission']=NULL;
                    }
                    if(!empty($data['UserRole']['add_permission']))
                    {
                    $UserRole['add_permission']=$data['UserRole']['add_permission'];
                    }else
                    {
                        $UserRole['add_permission']=NULL;
                    }
                    if(!empty($data['UserRole']['manage_permission']))
                    {
                    $UserRole['manage_permission']=$data['UserRole']['manage_permission'];
                    }else
                    {
                        $UserRole['manage_permission']=NULL;
                    }
                    if(!empty($data['UserRole']['delete_permission']))
                    {
                    $UserRole['delete_permission']=$data['UserRole']['delete_permission'];
                    }else
                    {
                        $UserRole['delete_permission']=NULL;
                    }
                    if(!empty($data['UserRole']['edit_permission']))
                    {
                    $UserRole['edit_permission']=$data['UserRole']['edit_permission'];
                    }else
                    {
                        $UserRole['edit_permission']=NULL;
                    }
                $checkcon=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['UserRole']['name'])->first();
                if(empty($checkcon))
                {
                    \DB::table('roles_permissions')->insert($UserRole);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['UserRole']['name'])->update($UserRole);
                }    
            }
            if(!empty($request->UserPermission))
            {
                    $UserPermission['role_id']=$request->role_id;
                    $UserPermission['title']=$data['UserPermission']['name'];
                    if(!empty($data['UserPermission']['view_permission']))
                    {
                        $UserPermission['view_permission']=$data['UserPermission']['view_permission'];
                    }else
                    {
                        $UserPermission['view_permission']=NULL;
                    }
                    if(!empty($data['UserPermission']['add_permission']))
                    {
                    $UserPermission['add_permission']=$data['UserPermission']['add_permission'];
                    }else
                    {
                        $UserPermission['add_permission']=NULL;
                    }
                    if(!empty($data['UserPermission']['manage_permission']))
                    {
                    $UserPermission['manage_permission']=$data['UserPermission']['manage_permission'];
                    }else
                    {
                        $UserPermission['manage_permission']=NULL;
                    }
                    if(!empty($data['UserPermission']['edit_permission']))
                    {
                    $UserPermission['edit_permission']=$data['UserPermission']['edit_permission'];
                    }else
                    {
                        $UserPermission['edit_permission']=NULL;
                    }
                    if(!empty($data['UserPermission']['delete_permission']))
                    {
                    $UserPermission['delete_permission']=$data['UserPermission']['delete_permission'];
                    }else
                    {
                        $UserPermission['delete_permission']=NULL;
                    }
                $checkUserPermission=\DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['UserPermission']['name'])->first();
                if(empty($checkUserPermission))
                {
                    \DB::table('roles_permissions')->insert($UserPermission);
                }else
                {
                    \DB::table('roles_permissions')->where('role_id',$request->role_id)->where('title',$data['UserPermission']['name'])->update($UserPermission);
                }  
            }
            return redirect()->back()->with('success','Permission saved successfully');
            
        }else
        {

            $userrole=Role::where('role_name',$name)->first();
            $home=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','Home')->first();
            $Canteen=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','Canteen')->first();
            $Department=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','Department')->first();
            $Division=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','Division')->first();
            $EmployeeCategory=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','EmployeeCategory')->first();
            $Item=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','Item')->first();
            $CardInventory=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','CardInventory')->first();
            $UserRole=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','UserRole')->first();
            $UserPermission=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','UserPermission')->first();
            $ManageUsers=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','ManageUsers')->first();
            $EmployeeMeal=\DB::table('roles_permissions')->where('role_id',$userrole->id)->where('title','EmployeeMeal')->first();
            return view('admin.users.user_permission',compact('userrole','home','Canteen','Department','Division','EmployeeCategory','Item','CardInventory','UserRole','UserPermission','ManageUsers','EmployeeMeal'));
        }
        
    }

    public function usermessages(Request $request)
    {
        $messages=\DB::table('user_messages')->leftJoin('users','users.id','user_messages.user_id')->select('users.name','users.email','user_messages.*')->get();
        return view('admin.users.user_messages')->with(['messages'=>$messages]);
    }

    public function Employeemeal(Request $request)
    {
        // dd($request->all());
        $result=Session::get('admin');
         $data=[];
        if($result->role_name!='Admin')
        {
            $category=EmpCategoryMaster::where('emp_category_master.create_by',$result->id)->get();
            $query=Employee::where('employee_meal.canteen_code',$result->canteen_code);
                  if(!empty($request->category))
                   {
                    $query->where('employee_meal.empcategory',$request->category);
                    $data['category']=$request->category;
                   }
                   if(!empty($request->empid))
                   {
                    $query->where('employee_meal.empid',$request->empid);
                    $data['empid']=$request->empid;
                   }
                   if(!empty($request->from) && !empty($request->to))
                   {
                    $fromdate=date('d-m-Y',strtotime($request->from));
                    $todate=date('d-m-Y',strtotime($request->to));
                    $query->whereBetween('employee_meal.meal_date',[$fromdate,$todate]);
                    $data['from']=$request->from;
                    $data['to']=$request->to;
                   }
            $employeemeal=$query->whereNull('deleted_at')->groupBy('employee_meal.empcategory','employee_meal.meal_date','employee_meal.food_type','employee_meal.quantity','employee_meal.empid','employee_meal.canteen_code')->get();

        }else
        {
            
           
            $category=EmpCategoryMaster::get();
            $query=Employee::whereNull('deleted_at');
                   if(!empty($request->category))
                   {
                    $query->where('employee_meal.empcategory',$request->category);
                    $data['category']=$request->category;
                   }
                   if(!empty($request->empid))
                   {
                    $query->where('employee_meal.empid',$request->empid);
                    $data['empid']=$request->empid;
                   }
                   if(!empty($request->from) && !empty($request->to))
                   {
                    $fromdate=date('d-m-Y',strtotime($request->from));
                    $todate=date('d-m-Y',strtotime($request->to));
                    $query->whereBetween('employee_meal.meal_date',[$fromdate,$todate]);
                    $data['from']=$request->from;
                    $data['to']=$request->to;
                   }
            $employeemeal=$query->groupBy('employee_meal.empcategory','employee_meal.meal_date','employee_meal.food_type','employee_meal.quantity','employee_meal.empid','employee_meal.canteen_code')->get();
           
            
        }
        if(!empty($employeemeal) && count($employeemeal)>0)
            {
                $bquantity=0;
                $lquantity=0;
                $evquantity=0;
                $dquantity=0;
                $bamount=0;
                $lamount=0;
                $evamount=0;
                $damount=0;
                $totalamount=0;
                $totalcmpdamount=0;
                $totalempdamount=0;
                $response=array();

                foreach($employeemeal as $meal)
                {

                    $item=DB::table('item_master')->where('item_id',$meal->food_type)->first();
                    $canteen=DB::table('canteen_master')->where('canteenCode',$item->canteenCode)->first();
                    $username=DB::table('card_inventory_master')->where('empId',$meal->empid)->first();
                    if(!empty($item->cmp_contribution && $item->emp_contribution))
                    {
                        $itemrate=$item->cmp_contribution+$item->emp_contribution;
                    }else
                    {
                        $itemrate=0;
                    }
                    
                    if($item->item_desc=='Breakfast')
                    {
                        $itemtype=DB::table('item_master')->where('item_desc','Breakfast')->first();
                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                        $bquantity+=$meal->quantity;
                        $response['bquantity']=$bquantity;
                        $bamount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                        $response['bamount']=$bamount;
                        $response['totalamount']=$bamount;
                        $totalcmpdamount+=$itemtype->cmp_contribution;
                        $response['totalcmpdamount']=$totalcmpdamount;
                        $totalempdamount+=$itemtype->emp_contribution;
                        $response['totalempdamount']=$totalempdamount;
                    }
                    if($item->item_desc=='Lunch')
                    {
                        $itemtype=DB::table('item_master')->where('item_desc','Lunch')->first();
                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                        $lquantity+=$meal->quantity;
                        $response['lquantity']=$lquantity;
                        $lamount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                        $response['lamount']=$lamount;
                        $response['totalamount']=$lamount;
                        $totalcmpdamount+=$itemtype->cmp_contribution;
                        $response['totalcmpdamount']=$totalcmpdamount;
                        $totalempdamount+=$itemtype->emp_contribution;
                        $response['totalempdamount']=$totalempdamount;
                        
                    }
                    if($item->item_desc=='Evening Snacks')
                    {
                        $itemtype=DB::table('item_master')->where('item_desc','Evening Snacks')->first();
                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                        $evquantity+=$meal->quantity;
                        $response['evquantity']=$evquantity;
                        $evamount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                        $response['evamount']=$evamount;
                        $response['totalamount']=$evamount;
                        $totalcmpdamount+=$itemtype->cmp_contribution;
                        $response['totalcmpdamount']=$totalcmpdamount;
                        $totalempdamount+=$itemtype->emp_contribution;
                        $response['totalempdamount']=$totalempdamount;
                    }
                    if($item->item_desc=='Dinner')
                    {
                        $itemtype=DB::table('item_master')->where('item_desc','Dinner')->first();
                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                        $dquantity+=$meal->quantity;
                        $response['dquantity']=$dquantity;
                        $damount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                        $response['damount']=$damount;
                        $response['totalamount']=$damount;
                        $totalcmpdamount+=$itemtype->cmp_contribution;
                        $response['totalcmpdamount']=$totalcmpdamount;
                        $totalempdamount+=$itemtype->emp_contribution;
                        $response['totalempdamount']=$totalempdamount;
                    }
                    
                }
            }
        
        return view('admin.users.manage_employee_meal')->with(['employeemeal'=>$employeemeal,'category'=>$category,'data'=>$data,'employee'=>$response]);
    }

    public function deleteempmeal(Request $request ,$id)
    {
        $data['deleted_at']=\Carbon\Carbon::now();
        Employee::where('id',$id)->update($data);
        return redirect()->back()->with('success','Employee meal data deleted successfully');
    }

    public function employeedate()
    {
        $EmployeeMeal=Employee::get();
        foreach($EmployeeMeal as $val)
        {
            $item=ItemMaster::where('item_id',$val->food_type)->first();
            $data['canteen_code']=$item->canteenCode;
            Employee::where('id',$val->id)->update($data);
            
        }
        
    }

}
