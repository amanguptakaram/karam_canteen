@extends('admin.layouts.app')

@section('content')

<div class="page-container">

    <div class="page-header">
        <h1>Add User</h1>
        <p>Create a new user and assign a role.</p>
    </div>

    <div class="card">

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>Employee Code</label>
                    <input
                        type="text"
                        name="emp_code"
                        value="{{ old('emp_code') }}"
                        required
                    >
                    @error('emp_code')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Department</label>
                    <input
                        type="text"
                        name="department"
                        value="{{ old('department') }}"
                    >
                    @error('department')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                    >
                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Role</label>

                    <select name="role_id" required>
                        <option value="">Select Role</option>

                        @foreach ($roles as $role)
                            <option
                                value="{{ $role->id }}"
                                {{ old('role_id') == $role->id ? 'selected' : '' }}
                            >
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('role_id')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="form-actions">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Create User
                </button>

            </div>

        </form>

    </div>

</div>

<style>
    .page-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 24px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        color: #172b44;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
    }

    .card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 25px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .form-group input,
    .form-group select {
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #172b44;
    }

    .error {
        color: #dc2626;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-primary {
        background: #172b44;
        color: white;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection