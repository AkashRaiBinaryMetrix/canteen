<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_detail;
use Hash;
use Session;
use Helper;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    { 
      
       $check=User::where('email',$request->email)->first();
       // $url=$request->route()->getName();
       // dd($url);
            if(!empty($check) && Hash::check($request->password,$check->password))
            {
             if(!empty($request->remember && $request->remember==1))
             {
                setcookie('useremail', $request->email);
                setcookie('userpass', $request->password);
                User::where('email',$request->email)->update(['remember_token'=>'1']);
             }else
             {
               unset($_COOKIE['useremail']); 
               unset($_COOKIE['userpass']); 
               User::where('email',$request->email)->update(['remember_token'=>NULL]);
             }
             if($check->email_verified_at!=NULL)
                {
                    
                        if($check->user_status==0 && $check->user_status!=null)
                        {
                        $res['status']='false';
                        $res['msg']='You cannot login now in this account. Please contact to administrator';
                        return $res;
                        }
                        if($check->reject_status==0 && $check->reject_status!=null)
                        {
                        
                        $res['status']='false';
                        $res['msg']='You cannot login now in this account. Please contact to administrator';
                        return $res;
                        }
                    
                    Session::put('user',$check);
                    $res['status']='true';
                    // $res['url']='{{route('.$url.')}}';
                    $res['msg']='Login successfull.';
                    return $res;
                }else
                {
                    $res['status']='false';
                    $res['msg']='Your Email Id is not verified';
                    return $res;
                }
           } else if(empty($check))
           {
             $res['status']='1';
             $res['msg']='Email id not matched with records';
             return $res;
           }
           else if(!Hash::check($request->password,$check->password))
           {
             $res['status']='2';
             $res['msg']='Password not matched with records';
             return $res;
           } 
        
    }

    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
         
            $finduser = User::where('facebook_id', $user->id)->first();
        
            if($finduser){
         
                Auth::login($finduser);
                \Session::put('user',$finduser);
                return redirect()->intended('/');
         
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'provider'=> 'Facebook',
                    'password' => encrypt($user->id)
                ]);
        
                Auth::login($newUser);
                \Session::put('user',$newUser);
                return redirect()->intended('/');
            }
        
        } catch (Exception $e) {
            \DB::table('error_logs')->insert([
                    'error' => $e->getMessage(),
                    'title'=> 'twitter login'
                ]);
            return redirect('/');
        }
    }

    public function redirect()
    {
        // return Socialite::driver('twitter')->redirect();
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback()
    {
       // $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
       //  auth()->login($user);
       //  return redirect()->to('/');

        try {
     
            $user = Socialite::driver('twitter')->user();
            
            $userWhere = User::where('twitter_id', $user->id)->first();
        
            if($userWhere){
      
                Auth::login($userWhere);
                \Session::put('user',$userWhere);
                return redirect('/');
      
            }else{
              
                
                if($user->avatar)
                {
                
                    $image = $user->avatar;
                    $imagename=basename($image);
                    $filename = explode('.', $imagename);
                    $name = 'twitter-pic'.'-'.rand(1111,9999).'.'.$filename[1];
                    $destinationPath = public_path('user/images/');
                    if (! \File::exists($destinationPath))
                    {
                        \File::makeDirectory($destinationPath, 777, true, true);
                    }
                    Image::make($image)->save($destinationPath.$name);
                    
                } 
                $gitUser = User::create([
                    'name' => $user->name,
                    'twitter_id'=> $user->id,
                    'provider'=> 'Twitter',
                    'password' => encrypt($user->email),
                    'email' => $user->email,
                    'profile_pic' => $name
                ]);
                User_detail::create([
                    'user_id' => $gitUser->id,
                    'image' => $name
                ]);
     
                Auth::login($gitUser);
                \Session::put('user',$gitUser);
                return redirect('/');
            }
     
        } catch (Exception $e) {
            \DB::table('error_logs')->insert([
                    'error' => $e->getMessage(),
                    'title'=> 'twitter login'
                ]);
            return redirect('/');
            // dd($e->getMessage());
        }
    }

    
}
