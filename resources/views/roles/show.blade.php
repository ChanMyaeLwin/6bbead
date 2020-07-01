@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
        <div class="form-group">
            <strong>Permissions:</strong>
            @if($role->permissions) 
                @foreach ($role->permissions as $key => $permission)
                {{$permission->name . ' | '}}
                @endforeach
            @endif
        </div>
    </div>
    
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
    </div>
</div>


@endsection