@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Choose Plan</h2>
        </div>
        <div class="pull-right">
           
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($plan, ['method' => 'PATCH','route' => ['plans.choosePlan', $plan->id]]) !!}
<input type="hidden" id="plan_id" name="plan_id" value="{{$plan->id}}">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Plan Name:</strong>
            {!! Form::text('plans_name', null, array('placeholder' => '','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Start Date:</strong>
            {!! Form::date('start_date', null, array('placeholder' => 'Start Date','class' => 'form-control')) !!}
      
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Choose </button>
         <a class="btn btn-primary" href="{{ route('plans.index') }}"> Back</a>
    </div>
</div>

{!! Form::close() !!}


@endsection