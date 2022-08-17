<?php
namespace App\Helpers;

use App\Banner;
use App\Deal;
use App\Mail\VerifyMail;
use App\MediaImages;
use App\Moods;
use danielme85\CConverter\Currency;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Cookie;
use App\Models\admin\CardInventory;
use App\Models\User;

/*
 * GuzzleHttp Client method
 */

class Helper {

function getAPI($type = '', $url = '', $params = []) {

	$default = [
		'max' => 5,
		'strict' => false,
		'referer' => true,
		'protocols' => ['http', 'https'],
		'track_redirects' => false,
		'timeout' => 5,
	];

	$client;

	$api_url = config('services.api.url');

	$client = new \GuzzleHttp\Client([
		'base_uri' => $api_url,
		$default,
	]);

	try {

		//$headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
		//$params['headers'] = $headers;
		//prd($params);
		$response = $client->request($type, '/api/' . $url, $params);

		/*$statusCode = $response->getStatusCode();
			dd($statusCode);
			if($statusCode == 404){
				prd("asdfas");
		*/

		$data = json_decode($response->getBody()->getContents());
		//prd($data);
		return $data;
	} catch (ClientException $e) {
		$response = $e->getResponse();
		//prd($response);
		if (isset($response) && $response->getBody() !== null) {
			$responseBodyAsString = json_decode($response->getBody()->getContents());
			//prd($responseBodyAsString);
			return $responseBodyAsString;
		} else {
			return "Couldn't connect to API";
		}
	}
}

function userLog($message, $request) {

	return UserLog::create([
		'visitor' => $request->ip(),
		'message' => $message,
		'user_id' => auth()->user()->id,
	]);

}

public static function RandNum($length) {
	$chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$clen = strlen($chars) - 1;
	$id = '';

	for ($i = 0; $i < $length; $i++) {
		$id .= $chars[mt_rand(0, $clen)];
	}
	return ($id);
}
function OtpCode($length) {
    $chars = "1234567890";
    $clen = strlen($chars) - 1;
    $id = '';

    for ($i = 0; $i < $length; $i++) {
        $id .= $chars[mt_rand(0, $clen)];
    }
    return ($id);
}
function RanDeg($length) {
    $chars = "1234";
    $clen = strlen($chars) - 1;
    $id = '';

    for ($i = 0; $i < $length; $i++) {
        $id .= $chars[mt_rand(0, $clen)];
    }
    return ($id);
}
function SentOTP($code, $phone, $message=null,$dltid = null,$tempId = null) {
    $otps['DLT_TE_ID'] = $dltid;
    $otps['dev_mode']=1;
    $otps['template_id'] = $tempId;
   
    $message==null?"Ems Your otp for phone verification is ".$code:$message;
	$result = \LaravelMsg91::sendOtp($phone, $code, $message,$otps);
    return $result;
}
function SentMessage($code, $phone,$dltid = null) {
   $otps['DLT_TE_ID'] = $dltid;
    $otps['dev_mode']=1;
   	$result = \LaravelMsg91::sendOtp($phone, $code, "Ems Your Password For Login Is ".$code,$otps);
	return $result;
}
function SentAgreement($phone,$code,$msg,$dltid = null) {
   $otps['DLT_TE_ID'] = $dltid;
    $otps['dev_mode']=1;
    
	$result = \LaravelMsg91::sendOtp($phone, $code,$msg,$otps);
	//dd($result);
    //$result = 'success';
	return $result;
}
function message($phone,$message,$dltid = null) {
	
  $otps['DLT_TE_ID'] = $dltid;

    $otps['dev_mode']=1;
	$result = \LaravelMsg91::message($phone, $message,$otps);
    return $result;
}

function ResentOTP($phone,$dltid = null) {
 $otps['DLT_TE_ID'] = $dltid;
    $otps['dev_mode']=1;
	$result = \LaravelMsg91::resendOtp($phone ,'voice',$otps);
	//$result = 'success';
	return $result;
}
function ResentVoiceOTP($phone,$dltid = null) {
$otps['DLT_TE_ID'] = $dltid;
    $otps['dev_mode']=1;
    $result = \LaravelMsg91::resendOtp($phone ,'voice',$otps);
    //$result = 'success';
    return $result;
}
function ResendOTP($phone) {

	$result = \LaravelMsg91::resendOtp($phone);
	//$result = 'success';
	return $result;
}

function VerifyOTP($code, $phone) {
    $result = \LaravelMsg91::verifyOtp($phone, $code, ['raw' => true]);
    
    return $result;
}


function SentMailVerification($user) {

	$verifyUser = VerifyUser::create([
		'user_id' => $user->id,
		'token' => str_random(40),
	]);
	$user['token'] = $verifyUser['token'];
	(Mail::to($user->email)->send(new VerifyMail($user)));
	return true;
}

function currencyConvert($amount) {
	$currency = new Currency($api = 'yahoo', $https = false, $useCache = false, $cacheMin = 0);

	$from = getenv("CURRENCY");
	$ip = '82.156.72.110';
	//$ip = \Request::ip();
	$location = \Location::get($ip);
	$whereCountries = \Rinvex\Country\CountryLoader::country($location->countryCode)->getCurrency();

	$to = $whereCountries['iso_4217_code'];
	$countrySymbol = $whereCountries['iso_4217_code'];
//	dd($amount, $from, $to);
	$data = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
//	dd($data);
	preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
	$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
	$convert = number_format(round($converted, 3), 2);
//	dd($amount, $from, $to, $convert);
	//To convert a value
	return $convert;
}

function getIndianCurrency(float $number) {
	$decimal = round($number - ($no = floor($number)), 2) * 100;
	$hundred = null;
	$digits_length = strlen($no);
	$i = 0;
	$str = array();
	$words = array(0 => '', 1 => 'one', 2 => 'two',
		3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
		7 => 'seven', 8 => 'eight', 9 => 'nine',
		10 => 'ten', 11 => 'eleven', 12 => 'twelve',
		13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
		16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
		19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
		40 => 'forty', 50 => 'fifty', 60 => 'sixty',
		70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
	while ($i < $digits_length) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += $divider == 10 ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
		} else {
			$str[] = null;
		}

	}
	$Rupees = implode('', array_reverse($str));
	$paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
function Slug() {
    $request = new \Illuminate\Http\Request();
    $host = $request->getHost();
    $baseurl = $request->getBaseUrl();

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $slug =  explode("/",$actual_link);
    $slugreturn = $slug[3];
    if($slugreturn!=null){

        $result = Organisation::where('slug',$slugreturn)->first();
        if($result){
            $ex1 = $result->id;
        }else{
            $ex1=0;
        }
    }
    if($ex1>0)
    {
        \Session::put('slug', $ex1);

    }
    else{
        \Session::put('slug', '');

    }

    return $slugreturn;
}

function isValid($value)
{
    try {
        // Validate the value...
    } catch (Exception $e) {
        report($e);

        return false;
    }
}


 function toText($amt) {
        if (is_numeric($amt)) {
            return toQuadrillions(abs($amt));
        } else {
            return 'Only numeric values are allowed.';
        }
    }

     function toOnes($amt) {
        $words = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine'
        );

        if ($amt >= 0 && $amt < 10)
            return $words[$amt];
       
    }

     function toTens($amt) { // handles 10 - 99
        $firstDigit = intval($amt / 10);
        $remainder = $amt % 10;

        if ($firstDigit == 1) {
            $words = array(
                0 => 'Ten',
                1 => 'Eleven',
                2 => 'Twelve',
                3 => 'Thirteen',
                4 => 'Fourteen',
                5 => 'Fifteen',
                6 => 'Sixteen',
                7 => 'Seventeen',
                8 => 'Eighteen',
                9 => 'Nineteen'
            );

            return $words[$remainder];
        } else if ($firstDigit >= 2 && $firstDigit <= 9) {
            $words = array(
                2 => 'Twenty',
                3 => 'Thirty',
                4 => 'Forty',
                5 => 'Fifty',
                6 => 'Sixty',
                7 => 'Seventy',
                8 => 'Eighty',
                9 => 'Ninety'
            );

            $rest = $remainder == 0 ? '' : toOnes($remainder);
            return $words[$firstDigit] . ' ' . $rest;
        }
        else
            return toOnes($amt);
    }

     function toHundreds($amt) {
        $ones = intval($amt / 100);
        $remainder = $amt % 100;

        if ($ones >= 1 && $ones < 10) {
            $rest = $remainder == 0 ? '' : toTens($remainder);
            return toOnes($ones) . ' Hundred ' . $rest;
        }
        else
            return toTens($amt);
    }

     function toThousands($amt) {
        $hundreds = intval($amt / 1000);
        $remainder = $amt % 1000;

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : toHundreds($remainder);
            return toHundreds($hundreds) . ' Thousand ' . $rest;
        }
        else
            return toHundreds($amt);
    }

     function toMillions($amt) {
        $hundreds = intval($amt / pow(1000, 2));
        $remainder = $amt % pow(1000, 2);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : toThousands($remainder);
            return toHundreds($hundreds) . ' Million ' . $rest;
        }
        else
            return toThousands($amt);
    }

     function toBillions($amt) {
        $hundreds = intval($amt / pow(1000, 3));
        /* Note:taking the modulos results in a negative value, but
          this seems to work pretty fine */

        $remainder = $amt - $hundreds * pow(1000, 3);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : toMillions($remainder);
            return toHundreds($hundreds) . ' Billion ' . $rest;
        }
        else
            return toMillions($amt);
    }

     function toTrillions($amt) {
        $hundreds = intval($amt / pow(1000, 4));
        $remainder = $amt - $hundreds * pow(1000, 4);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : toBillions($remainder);
            return toHundreds($hundreds) . ' Trillion ' . $rest;
        }
        else
            return toBillions($amt);
    }

     function toQuadrillions($amt) {
        $hundreds = intval($amt / pow(1000, 5));
        $remainder = $amt - $hundreds * pow(1000, 5);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : toTrillions($remainder);
            return toHundreds($hundreds) . ' Quadrillion ' . $rest;
        }
        else
            return toTrillions($amt);
    }

    function convertDateinWords($date)
    {
            $datearrya = explode('-', $date);
            $date = $datearrya[2].'/'.$datearrya[1].'/'.$datearrya[0];
        $your_date = Carbon::createFromFormat('d/m/Y', $date);
        $textdate = date("jS F, Y", strtotime($your_date));
        
        return $textdate;
    }

 function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }


}

    
  function safe_b64encode($string) {
    
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

 function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
    
   function encode($value){ 
        
        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    function decode($value){
        
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
    function addMonths($dateToAdd,$mon){
        return date('d-m-Y', strtotime("+".$mon." months", strtotime($dateToAdd))-1);
    }

    public static function getCookie()
    {
    	
		if(!empty($_COOKIE['useremail']))
	   	{
	   		$check=User::where('email',$_COOKIE['useremail'])->first();
	    	if(!empty($check->remember_token))
	    	{
	            $res['email'] = $_COOKIE['useremail'];
	      	    
		      	if(!empty($_COOKIE['userpass']))
			   	{
			   	  $res['password'] = $_COOKIE['userpass'];
			      
			   	}
			   	return $res;
	        }
    	}else
    	{

    	}
    	
   }

   public static function sendemail($subject="",$title="",$details="",$to="")
   {
        
        $details = [
        'subject'=>$subject,
        'title' => $subject,
        'body' => $details
          ];
        \Mail::to($to)->send(new \App\Mail\MyTestMail($details));
       
        
   }

   public static function checkEmail($email) {
           if ( strpos($email, '@') !== false ) {
              $split = explode('@', $email);
              return (strpos($split['1'], '.') !== false ? true : false);
           }
           else {
              return false;
           }
        }

    public static function _getStatusCodeMessage($status)
    {
        $code = [
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized Request',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented'
        ];
        return (isset($code[$status])) ? $code[$status] : "";
    }

    public static function setHeader($status)
    {
       $status_header = 'HTTP/1.1 ' . $status . ' ' . Helper::_getStatusCodeMessage($status);
        $content_type="application/json; charset=utf-8";         
        header($status_header);
        header('Content-type: ' . $content_type);
       header('X-Powered-By: ' . "Hitflop <imgglobal.in>");
    }

    public static function isAuthorize($request){
        if($request->header('Authorization')){
            $auth_key = $request->header('Authorization');
            if(isset($auth_key) && $auth_key != "") {
                $dataa = explode(" ",$auth_key);
                if(isset($dataa[1])){
                    $main_key = $dataa[1];
                }else{
                    $main_key = $auth_key;
                }
                $model = CardInventory::where('access_token', $main_key)->first();
                if($model){
                    return $model;
                }
                else{
                    Helper::setHeader(401);
                    $json['success'] = false;
                    $json['msg'] = 'You cannot access this page';
                    echo json_encode($json);die;
                }
            }
            else{
                Helper::setHeader(401);
                $json['success'] = false;
                $json['msg'] = 'You cannot access this page';
                echo json_encode($json);die;
            }
        }else{
            Helper::setHeader(401);
            $json['success'] = false;
            $json['msg'] = 'You cannot access this page';
            echo json_encode($json);die;
        }
        
    }

   
}

?>