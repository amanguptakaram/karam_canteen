@extends('layouts.app')

@section('title', 'Login - KARAM Canteen')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<div class="auth-page">

    <div class="auth-card">

        {{-- Back to Home --}}
        <a href="{{ route('home') }}" class="back-home">
            <span>←</span>
            Back to Home
        </a>

        {{-- Brand --}}
        <div class="auth-header">
            <div class="brand-mark">K</div>

            <h1>
                KARAM <span>Canteen</span>
            </h1>

            <p>Welcome back! Please login to continue.</p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="error-box">
                <div class="error-title">
                    Please check the following:
                </div>

                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login.store') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>

                <div class="input-wrapper">
                    <span class="input-icon">✉</span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        autocomplete="email"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="auth-btn">
                <span>Login</span>
                <span class="btn-arrow">→</span>
            </button>

        </form>

        <div class="auth-divider">
            <span>or</span>
        </div>

        <p class="auth-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Create Account</a>
        </p>

    </div>

</div>

@endsection