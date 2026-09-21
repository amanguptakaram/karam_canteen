@extends('layouts.app')

@section('title', 'Login - KARAM Canteen')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <div class="auth-header">
            <h1>KARAM <span>Canteen</span></h1>
            <p>Login to your account</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">
                Login
            </button>

        </form>

        <p class="auth-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Create Account</a>
        </p>

    </div>

</div>

@endsection