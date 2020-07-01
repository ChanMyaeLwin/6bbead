@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Level</h2>
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


{!! Form::model($plan, ['method' => 'PATCH','route' => ['plans.addLevel', $plan->id]]) !!}
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
            <strong>Level Name:</strong>
            {!! Form::text('level_name', null, array('placeholder' => '','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="row dayList col-xs-12 col-sm-12 col-md-12">
                
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">
            <strong>Day No:</strong>
            {!! Form::number('day_no', null, array('min' => 1,'placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
            <strong>Day:</strong>
            {!! Form::select('day_name', $day_array,0, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">
            <strong>No of Round:</strong>
            {!! Form::text('no_of_round', null, array('placeholder' => '','class' => 'form-control','min'=>1)) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
            <strong>First Defination:</strong>
            {!! Form::textarea('first_defination', null, array('placeholder' => '','class' => 'form-control','rows' => 3)) !!}
            </div>
        </div>
        <div class="col-xs-5 col-sm-5 col-md-5">
            <div class="form-group">
            <strong>Second Defination:</strong>
            {!! Form::textarea('second_defination', null, array('placeholder' => '','class' => 'form-control','rows' => 3)) !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
         <a class="btn btn-primary" href="{{ route('plans.index') }}"> Back</a>
    </div>
</div>

{!! Form::close() !!}


@endsection