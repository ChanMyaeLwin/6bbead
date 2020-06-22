@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('6b Bead is') }}</div>

                <div class="card-body">
                   
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('6b Bead is 6b Bead') }}</label> 
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                        <a class="btn btn-primary" href="{{ route('plans.index') }}">
                                        {{ __('Start Your Plan') }}
                                    </a>
                        </div>  
                    </div>

                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
