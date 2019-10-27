@extends('voyager::master')

@section('page_header')
<div class="page-title"> 
<h2>Campus Ambassador</h2>
<h4>Wissenaire 20</h4>
</div>
@stop

@section('css')
<style>
    .card{
        text-align:center;
    }
    .profilex{
        margin:auto;
        padding:30px 20px;
    }
    .avatar{
        border-radius:50%;
        max-width:100px;
    }
</style>
@stop

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
       <!--@include('voyager::dimmers')-->
        <div class="analytics-container">
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="card" style="padding:10px;"> 
                            <h4>Notifications</h5>
                                <ul class="list-group">
                                <?php 
                                $notification = App\Message::all();
                                foreach($notification as $message){
                                    echo '<li class="list-group-item">'.$message->notifications.'</li>';
                                    
                                }
                                ?>
                                </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="profilex">
                                  <img class="avatar" src="{{ Auth::user()->avatar }}"/>
                                <h4>
                                    WissID : <b>{{  Auth::user()->WissID}}</b><br>
                                    Name : {{  Auth::user()->name }}<br>
                                    College : {{ Auth::user()->college }}<br>
                                    <h1 class="">Points : {{ Auth::user()->points }}</h1>
                                    
                                </h4>
                               
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@stop