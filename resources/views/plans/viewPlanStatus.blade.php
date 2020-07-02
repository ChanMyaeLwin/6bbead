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
            <strong>Plan Name:</strong>
            {{ $plan->plans_name }}
        </div>
    </div>
    <table class="table table-bordered">
 <tr>
    <th>Day No</th>
    <th>Level Name</th>
    <th>Day Name</th>
    <th>First Defination</th>
    <th>No of Round</th>
    <th>Start Time</th>
    <th>End Time</th>
 </tr>
 @foreach ($userdays as $key => $userday)
  <tr>
    <td>{{ $userday->day_no }}</td>
    <td>{{ $userday->levelDays->level_name }}</td>
    <td>{{ $userday->levelDays->day_name }}</td>
    <td>{{ $userday->levelDays->first_defination }}</td>
    <td>{{ $userday->levelDays->no_of_round }}</td>
    <td>{{ $userday->start_time }}</td>
    <td>{{ $userday->end_time }}</td>
  </tr>
 @endforeach
</table>
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a class="btn btn-primary" href="{{ route('plans.index') }}"> Back</a>
    </div>
</div>


@endsection