<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use Validator,Redirect,Response,File;
 use Socialite;
 use App\User;

 use Illuminate\Support\Facades\Schema;
 use Illuminate\Database\Schema\Blueprint;

 class SocialController extends Controller
 {
 public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();
 }
 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user(); 
   $user = $this->createUser($getInfo,$provider); 
   auth()->login($user); 
   $wissid = auth()->user()->WissID; 
   $userdata = \DB::select('select college,course,Mobile from users where wissID = ?',[$wissid]);
   if(is_null($userdata[0]->college) || is_null($userdata[0]->Mobile) || is_null($userdata[0]->course))
    return redirect()->to('/dashboard/editinfo');
   return redirect()->to('/home');
 }
 function createUser($getInfo,$provider){
 $user = User::where('provider_id', $getInfo->id)->first();
 $results = \DB::table('users')->count();
      $results = $results+1;
      if ($results < 10)
        $wissid = 'WISS20CA000'.$results;
        else if ($results<100)
        $wissid = 'WISS20CA00'.$results;
        else if($results < 1000)
        $wissid = 'WISS20CA0'.$results;
        else 
        $wissid = 'WISS20CA'.$results;
 if (!$user) {
      $user = User::create([
         'name'     => $getInfo->name,
         'email'    => $getInfo->email,
         'provider' => $provider,
         'provider_id' => $getInfo->id,
         'avatar' => $getInfo->avatar,
         'WissID' => $wissid
     ]);
   
  $shares = \DB::insert('insert into shares (wissID) values(?)',[$wissid]);
     /* $id = $getInfo->id;
      //$avatar = $getInfo->avatar;
      $results = \DB::table('users')->count();
      $results = $results++;
      if ($results < 10)
        $wissid = 'WISS20CA000'.$results;
        else if ($results<100)
        $wissid = 'WISS20CA00'.$results;
        else if($results < 1000)
        $wissid = 'WISS20CA0'.$results;
        else 
        $wissid = 'WISS20CA'.$results;
      //$affected = \DB::update("update users set avatar = :avatar where provider_id = :id", array("avatar" => $avatar , 'id'=>$id,));
      $second =  \DB::update("update users set WissID = :wissid where provider_id = :id", array("wissid" => $wissid , 'id'=>$id,));
      //DB::statement('alter table fbposts add column ? TinyInt(1) default 0',[$wissid]);*/

      
      }
      //auth()->login($user); 
      //return redirect()->to('dashboard/editinfo');
      return $user;
    }
  }