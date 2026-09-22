@extends('layouts.app')

@section('title', 'Register - KARAM Canteen')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<div class="auth-page">

    <div class="auth-card register-card">

        {{-- Back to Home --}}
        <a href="{{ route('home') }}" class="back-home">
            <span>←</span>
            Back to Home
        </a>

        {{-- Brand --}}
        <div class="auth-header register-header">
            <div class="brand-mark">K</div>

            <h1>
                KARAM <span>Canteen</span>
            </h1>

            <p>Create your employee account.</p>
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

        {{-- Register Form --}}
        <form method="POST" action="{{ route('register.store') }}" class="auth-form register-form">
            @csrf

            <div class="form-group">
                <label for="emp_code">Employee Code</label>

                <div class="input-wrapper">
                    <span class="input-icon">ID</span>

                    <input
                        type="text"
                        id="emp_code"
                        name="emp_code"
                        value="{{ old('emp_code') }}"
                        placeholder="Employee code"
                        autocomplete="off"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>

                <div class="input-wrapper">
                    <span class="input-icon">👤</span>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Your full name"
                        autocomplete="name"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>

                <div class="input-wrapper">
                    <span class="input-icon">✉</span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Your email address"
                        autocomplete="email"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="department">Department</label>

                <div class="input-wrapper">
                    <span class="input-icon">🏢</span>

                    <input
                        type="text"
                        id="department"
                        name="department"
                        value="{{ old('department') }}"
                        placeholder="Your department"
                        autocomplete="organization"
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
                        placeholder="Create password"
                        autocomplete="new-password"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>

                <div class="input-wrapper">
                    <span class="input-icon">🔐</span>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        autocomplete="new-password"
                        required
                    >
                </div>
            </div>

            <div class="register-submit">
                <button type="submit" class="auth-btn">
                    <span>Create Account</span>
                    <span class="btn-arrow">→</span>
                </button>
            </div>

        </form>

        <div class="auth-divider">
            <span>or</span>
        </div>

        <p class="auth-footer">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </p>

    </div>

</div>

@endsection