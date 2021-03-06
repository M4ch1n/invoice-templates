@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-header">{{ __('Dashboard') }}</div>                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 offset-md-10">
                            <a class="btn-orange btn-small">Create Invoice</a>    
                        </div>
                    </div>
                    
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
