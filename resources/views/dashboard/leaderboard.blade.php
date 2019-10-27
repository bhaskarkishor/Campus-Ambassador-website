@extends('voyager::master')

@section('css')
<style>
    .table{

    }
    .container{
        padding:20px;
    }
</style>
@stop

@section('page_header')
<div class="page-title">
    Leader-Board
</div>
@endsection

@section('content')
<div class="container">
    <div class="">
    <table class="table-bordered table-striped table-condensed table-hover table">
        <tr><th>Rank</th>
            <th>WissID</th>
            <th>Name</th>
            <th>college</th>
            <th>Points</th>
        </tr>
        <?php $rank = 0 ?>
    @foreach($data as $data)
    <tr><td>{{ ++$rank }}
        <td>{{ $data->WissID }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->college }}</td>
        <td>{{ $data->points }}</td>
    </tr>
    @endforeach
</table>
    </div>
</div>

@stop