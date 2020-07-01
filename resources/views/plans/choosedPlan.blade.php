@extends('layouts.app')


@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Choossed Plan</h2>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
@if($userplans[0] !== null)
 <tr>
   <th>No</th>
   <th>Plan Name</th>
   <th width="280px">Action</th>
 </tr>
 
 @foreach ($userplans as $key => $userplan)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $userplan->plans->plans_name }}</td>
    
    <td>
       <a class="btn btn-info" href="{{ route('plans.startPlan',$userplan->id) }}">Start Plan</a>
    </td>
  </tr>
 @endforeach
 @else
  <tr>
  <td >
    <a class="btn btn-primary" href="{{ route('plans.index') }}">
                                        {{ __('You have not Choosed plan, Choose Plan') }}
                                    </a>
                                    </td>
  </tr>
 @endif
</table>

</div>
{!! $userplans->render() !!}


@endsection