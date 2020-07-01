@extends('layouts.app')


@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Plan Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('plans.create') }}"> Create New Plan</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($plans as $key => $plan)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $plan->plans_name }}</td>
    
    <td>
       <a class="btn btn-info" href="{{ route('plans.show',$plan->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('plans.edit',$plan->id) }}">Edit</a>
 
        {!! Form::open(['method' => 'DELETE','route' => ['plans.destroy', $plan->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      
    </td>
  </tr>
 @endforeach
</table>

</div>
{!! $plans->render() !!}


@endsection