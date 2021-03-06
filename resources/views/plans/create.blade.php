@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Plan</h2>
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



{!! Form::open(array('route' => 'plans.store','method'=>'POST')) !!}
<!-- <form method="POST" id="frm_submit" > -->
    	@csrf
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12" id="level">
        <fieldset>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Plan Name:</strong>
                {!! Form::text('plan_name', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
        </div>
        </fieldset>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit"  id="btn_submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="{{ route('plans.index') }}"> Back</a>
    </div>
</div>
<!-- </form> -->

{!! Form::close() !!}

@endsection


