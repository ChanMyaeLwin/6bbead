@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Plan</h2>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $plan->plans_name }}
        </div>
    </div>
    <table class="table table-bordered">
 <tr>
    <th>Day No</th>
    <th>Level Name</th>
    <th>Day Name</th>
    <th>First Defination</th>
    <th>Second Defination</th>
    <th>No of Round</th>
 </tr>
 @foreach ($levels as $key => $level)
  <tr>
    <td>{{ $level->day_no }}</td>
    <td>{{ $level->level_name }}</td>
    <td>{{ $level->day_name }}</td>
    <td>{{ $level->first_defination }}</td>
    <td>{{ $level->second_defination }}</td>
    <td>{{ $level->no_of_round }}</td>

    <!-- <td>
       <a class="btn btn-info" href="{{ route('plans.show',$level->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('plans.edit',$level->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['plans.destroy', $level->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      
    </td> -->
  </tr>
 @endforeach
</table>
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a class="btn btn-primary" href="{{ route('plans.index') }}"> Back</a>
    </div>
</div>


@endsection