<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function leaderboard(){
       
        $data = \DB::select('select college,points,name,WissID from users order by points desc');
        return view('dashboard.leaderboard',['data'=>$data]);
    }

    public function dashboard(){
        return view('vendor.voyager.index');
    }

    public function contactUS()
    {
        return view('dashboard.contact');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUSPost(Request $request)
    {
        $this->validate($request, [
         'name' => 'required',
         'email' => 'required|email',
         'message' => 'required'
         ]);
        ContactUS::create($request->all());
        return back()->with('success', 'Thanks for contacting us!');
    }


    public function editpage(){
        $id = auth()->user()->id;
        $data = \DB::select('select name,WissID,college,avatar,email,mobile,course from users where id =:id',['id'=>$id]);
        return view('vendor/editinfo',["dataTypeContent"=>$data]);
    }

    public function storedata(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'college'=>'required',
            'mobile'=>'required',
            'course'=>'required'
        ]);
        $id = auth()->user()->id;
        \DB::update('update users set name = :name,college = :college, mobile = :mobile,course = :course where id = :id',["name"=>$request->name,"college"=>$request->college,"mobile"=>$request->mobile,"course"=>$request->course,"id"=>$id]);
        //return back()->with('success','Records have been changed');
        return redirect('/home');
    }
}
