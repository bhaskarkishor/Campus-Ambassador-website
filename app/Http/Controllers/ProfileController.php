<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 

class ProfileController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function dashboard(){
        
        $pointarray = \DB::select('select name,WissId,college,points from users order by points desc');
        $message = \DB::select('select Notifications,created_at from messages order by created_at');
        return view('vendor.voyager.index',["info"=>$pointarray, "message"=>$message]);
    }
}