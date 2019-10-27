<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pointcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($post){ 
        $id = auth()->user()->id;
        $wissid = auth()->user()->WissID; 
        $pointarray = \DB::select('select points from users where id = ?',[$id]);
        //$point = json_decode($pointarray[0]);
        
        $point = $pointarray[0]->points;
        $point += 10;

        $newpoint = \DB::update('update users set points = :point where id = :id',array("point"=>$point, "id"=>$id));
        
        $changeshare = \DB::table('shares')->where('wissID',$wissid)->update([$post => 1]);
    }

    public function posts(){
        
        $wissid = auth()->user()->WissID;
        
       
        $data = \DB::select("SELECT post,id from fbposts");
        $shares = \DB::select("select * from shares where wissID = ?",[$wissid]);
                
        return view('dashboard.fb',['data' => $data,'post'=>$shares]);
    }
}
