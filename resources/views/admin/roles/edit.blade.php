@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('content')

<div class="role-edit-page">

    {{-- Header --}}
    <div class="role-edit-header">

        <div>

            <div class="role-edit-breadcrumb">
                Administration
                <span>/</span>
                Roles
                <span>/</span>
                Edit
            </div>

            <h1>Edit Role</h1>

            <p>
                Update the information for this admin role.
            </p>

        </div>


        <a
            href="{{ route('roles.index') }}"
            class="edit-secondary-btn"
        >
            ← Back to Roles
        </a>

    </div>


    {{-- Success --}}
    @if (session('success'))

        <div class="edit-alert edit-alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="edit-alert edit-alert-error">

            <strong>Please check the following:</strong>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form Card --}}
    <div class="edit-role-card">

        <div class="edit-role-card-header">

            <div class="edit-role-avatar">
                {{ strtoupper(substr($role->name, 0, 1)) }}
            </div>

            <div>

                <h2>
                    {{ $role->name }}
                </h2>

                <p>
                    Role ID: #{{ $role->id }}
                </p>

            </div>

        </div>


        <form
            method="POST"
            action="{{ route('roles.update', $role) }}"
            class="edit-role-form"
        >

            @csrf

            @method('PUT')


            {{-- Role Name --}}
            <div class="edit-form-group">

                <label for="name">
                    Role Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $role->name) }}"
                    required
                >

                <small>
                    The display name of this role.
                </small>

                @error('name')
                    <span class="edit-field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Role Slug --}}
            <div class="edit-form-group">

                <label for="slug">
                    Role Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug', $role->slug) }}"
                    required
                >

                <small>
                    The unique system identifier for this role.
                </small>

                @error('slug')
                    <span class="edit-field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Permissions Placeholder --}}
            <div class="edit-permission-info">

                <div class="edit-info-icon">
                    i
                </div>

                <div>

                    <strong>
                        Permissions
                    </strong>

                    <p>
                        Permission assignment will be available here after
                        the Permissions module is created.
                    </p>

                    <span>
                        Current permissions:
                        {{ $role->permissions->count() }}
                    </span>

                </div>

            </div>


            {{-- Actions --}}
            <div class="edit-form-actions">

                <a
                    href="{{ route('roles.index') }}"
                    class="edit-secondary-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="edit-primary-btn"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('styles')

<style>

/* PAGE */

.role-edit-page {
    width: 100%;
    max-width: 1000px;
}


/* HEADER */

.role-edit-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 20px;

    margin-bottom: 28px;
}

.role-edit-breadcrumb {
    margin-bottom: 8px;

    color: #94a3b8;

    font-size: 12px;
}

.role-edit-breadcrumb span {
    margin: 0 6px;
    color: #cbd5e1;
}

.role-edit-header h1 {
    margin: 0;

    color: #172b44;

    font-size: 30px;
    font-weight: 700;
}

.role-edit-header p {
    margin: 6px 0 0;

    color: #7b8da5;

    font-size: 14px;
}


/* BUTTONS */

.edit-primary-btn,
.edit-secondary-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 11px 17px;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    transition: 0.2s ease;
}

.edit-primary-btn {
    background: #172b44;

    border: 1px solid #172b44;

    color: #ffffff;
}

.edit-primary-btn:hover {
    background: #0f2035;
    color: #ffffff;
}

.edit-secondary-btn {
    background: #ffffff;

    border: 1px solid #e1e7ed;

    color: #475569;
}

.edit-secondary-btn:hover {
    background: #f8fafc;
    color: #172b44;
}


/* ALERT */

.edit-alert {
    padding: 13px 16px;

    margin-bottom: 20px;

    border-radius: 8px;

    font-size: 13px;
}

.edit-alert-success {
    background: #ecfdf5;

    border: 1px solid #bbf7d0;

    color: #047857;
}

.edit-alert-error {
    background: #fef2f2;

    border: 1px solid #fecaca;

    color: #b91c1c;
}

.edit-alert ul {
    margin: 7px 0 0;
    padding-left: 18px;
}


/* CARD */

.edit-role-card {
    background: #ffffff;

    border: 1px solid #e5eaf0;

    border-radius: 12px;

    overflow: hidden;

    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
}


/* CARD HEADER */

.edit-role-card-header {
    display: flex;

    align-items: center;

    gap: 13px;

    padding: 22px 24px;

    border-bottom: 1px solid #edf1f5;
}

.edit-role-avatar {
    width: 45px;
    height: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f4f7;

    border-radius: 10px;

    color: #172b44;

    font-size: 16px;
    font-weight: 700;
}

.edit-role-card-header h2 {
    margin: 0 0 3px;

    color: #172b44;

    font-size: 17px;
}

.edit-role-card-header p {
    margin: 0;

    color: #94a3b8;

    font-size: 11px;
}


/* FORM */

.edit-role-form {
    padding: 27px 24px;
}

.edit-form-group {
    margin-bottom: 23px;
}

.edit-form-group label {
    display: block;

    margin-bottom: 8px;

    color: #334155;

    font-size: 13px;
    font-weight: 650;
}

.edit-form-group input {
    width: 100%;

    box-sizing: border-box;

    padding: 12px 13px;

    background: #ffffff;

    border: 1px solid #d9e0e7;

    border-radius: 7px;

    color: #172b44;

    font-size: 14px;

    outline: none;

    transition: 0.2s ease;
}

.edit-form-group input:focus {
    border-color: #8798ab;

    box-shadow: 0 0 0 3px rgba(23, 43, 68, 0.06);
}

.edit-form-group small {
    display: block;

    margin-top: 7px;

    color: #94a3b8;

    font-size: 11px;
}

.edit-field-error {
    display: block;

    margin-top: 6px;

    color: #dc2626;

    font-size: 11px;
}


/* PERMISSION INFO */

.edit-permission-info {
    display: flex;

    align-items: flex-start;

    gap: 11px;

    padding: 15px;

    margin-bottom: 25px;

    background: #f8fafc;

    border: 1px solid #e7edf2;

    border-radius: 8px;
}

.edit-info-icon {
    width: 24px;
    height: 24px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e9eef3;

    border-radius: 50%;

    color: #52647a;

    font-size: 12px;
    font-weight: 700;
}

.edit-permission-info strong {
    display: block;

    margin-bottom: 4px;

    color: #475569;

    font-size: 12px;
}

.edit-permission-info p {
    margin: 0 0 5px;

    color: #8a9ab0;

    font-size: 11px;

    line-height: 1.5;
}

.edit-permission-info span {
    color: #64748b;

    font-size: 11px;
    font-weight: 600;
}


/* ACTIONS */

.edit-form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 9px;

    padding-top: 20px;

    border-top: 1px solid #edf1f5;
}


/* RESPONSIVE */

@media (max-width: 700px) {

    .role-edit-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .edit-role-form {
        padding: 22px 18px;
    }

    .edit-role-card-header {
        padding: 18px;
    }

    .edit-form-actions {
        flex-direction: column-reverse;
    }

    .edit-form-actions .edit-primary-btn,
    .edit-form-actions .edit-secondary-btn {
        width: 100%;
    }

}

</style>

@endpush