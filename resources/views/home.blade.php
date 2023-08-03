@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>{{ __('Dashboard') }}</h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="welcome-message">
                        <h3>Welcome back, {{ Auth::user()->name }}!</h3>
                        <p>You are logged in to the dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
