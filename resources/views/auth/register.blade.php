@extends('layouts.app')

@section('title', 'Register - KARAM Canteen')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <div class="auth-header">
            <h1>KARAM <span>Canteen</span></h1>
            <p>Create your account</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="form-group">
                <label>Employee Code</label>
                <input type="text" name="emp_code"
                       value="{{ old('emp_code') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name"
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department"
                       value="{{ old('department') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="auth-btn">
                Create Account
            </button>

        </form>

        <p class="auth-footer">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </p>

    </div>

</div>

@endsection