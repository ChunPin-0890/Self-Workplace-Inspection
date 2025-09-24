@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card with shadow and rounded corners -->
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header bg-primary text-white rounded-top">
                        <h2 class="m-0">{{ __('Dashboard') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="welcome-message text-center">
                            <h3 class="display-4 text-primary mb-4">Welcome back, {{ Auth::user()->name }}!</h3>
                            <p>You are logged in to the dashboard. Explore the features and
                                settings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Add Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection