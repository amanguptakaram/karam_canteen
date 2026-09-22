@extends('admin.layouts.app')

@section('title', 'Create Role')

@section('content')

<div class="role-form-page">

    {{-- Header --}}
    <div class="role-form-page-header">

        <div>

            <div class="role-form-breadcrumb">
                Administration
                <span>/</span>
                Roles
                <span>/</span>
                Create
            </div>

            <h1>Create Role</h1>

            <p>
                Create a role for users who will access the admin panel.
            </p>

        </div>


        <a
            href="{{ route('roles.index') }}"
            class="secondary-btn"
        >
            ← Back to Roles
        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="form-alert">

            <div class="form-alert-icon">!</div>

            <div>

                <strong>Please check the following:</strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- Form Card --}}
    <div class="role-form-card">

        {{-- Card Header --}}
        <div class="role-form-card-header">

            <div class="form-role-icon">
                R
            </div>

            <div>

                <h2>Role Information</h2>

                <p>
                    Define the basic identity of this role.
                </p>

            </div>

        </div>


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('roles.store') }}"
            class="role-form"
        >

            @csrf


            {{-- Role Name --}}
            <div class="form-field">

                <label for="name">
                    Role Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Manager"
                    autocomplete="off"
                    required
                >

                <small>
                    The name displayed in the admin panel.
                </small>

                @error('name')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Role Slug --}}
            <div class="form-field">

                <label for="slug">
                    Role Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug') }}"
                    placeholder="e.g. manager"
                    autocomplete="off"
                    required
                >

                <small>
                    A unique system identifier for this role.
                </small>

                @error('slug')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Future Permissions Notice --}}
            <div class="permissions-notice">

                <div class="notice-icon">
                    i
                </div>

                <div>

                    <strong>Permissions will be assigned separately.</strong>

                    <p>
                        After creating the role, you can assign the required
                        permissions to it from the role management section.
                    </p>

                </div>

            </div>


            {{-- Actions --}}
            <div class="role-form-actions">

                <a
                    href="{{ route('roles.index') }}"
                    class="secondary-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="primary-btn"
                >
                    Create Role
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('styles')

<style>

/* ================================
   PAGE
================================ */

.role-form-page {
    width: 100%;
    max-width: 1000px;
}


/* ================================
   HEADER
================================ */

.role-form-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 20px;

    margin-bottom: 28px;
}

.role-form-breadcrumb {
    margin-bottom: 8px;

    color: #94a3b8;

    font-size: 12px;
}

.role-form-breadcrumb span {
    margin: 0 6px;
    color: #cbd5e1;
}

.role-form-page-header h1 {
    margin: 0;

    color: #172b44;

    font-size: 30px;
    font-weight: 700;

    letter-spacing: -0.5px;
}

.role-form-page-header p {
    margin: 6px 0 0;

    color: #7b8da5;

    font-size: 14px;
}


/* ================================
   BUTTONS
================================ */

.primary-btn,
.secondary-btn {
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

.primary-btn {
    background: #172b44;
    color: #ffffff;
    border: 1px solid #172b44;
}

.primary-btn:hover {
    background: #0f2035;
    color: #ffffff;
}

.secondary-btn {
    background: #ffffff;

    border: 1px solid #e1e7ed;

    color: #475569;
}

.secondary-btn:hover {
    background: #f8fafc;
    color: #172b44;
}


/* ================================
   ERROR
================================ */

.form-alert {
    display: flex;

    gap: 12px;

    padding: 14px 16px;

    margin-bottom: 20px;

    background: #fef2f2;

    border: 1px solid #fecaca;

    border-radius: 8px;

    color: #991b1b;

    font-size: 13px;
}

.form-alert-icon {
    width: 27px;
    height: 27px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fee2e2;

    border-radius: 50%;

    font-weight: 700;
}

.form-alert strong {
    display: block;
    margin-bottom: 4px;
}

.form-alert ul {
    margin: 0;
    padding-left: 17px;
}


/* ================================
   CARD
================================ */

.role-form-card {
    background: #ffffff;

    border: 1px solid #e5eaf0;

    border-radius: 12px;

    overflow: hidden;

    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
}


/* ================================
   CARD HEADER
================================ */

.role-form-card-header {
    display: flex;
    align-items: center;

    gap: 13px;

    padding: 22px 24px;

    border-bottom: 1px solid #edf1f5;
}

.form-role-icon {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f4f7;

    border-radius: 10px;

    color: #172b44;

    font-size: 16px;
    font-weight: 700;
}

.role-form-card-header h2 {
    margin: 0 0 4px;

    color: #172b44;

    font-size: 17px;
    font-weight: 700;
}

.role-form-card-header p {
    margin: 0;

    color: #8a9ab0;

    font-size: 13px;
}


/* ================================
   FORM
================================ */

.role-form {
    padding: 27px 24px;
}

.form-field {
    margin-bottom: 23px;
}

.form-field label {
    display: block;

    margin-bottom: 8px;

    color: #334155;

    font-size: 13px;
    font-weight: 650;
}

.form-field input {
    width: 100%;

    box-sizing: border-box;

    padding: 12px 13px;

    background: #ffffff;

    border: 1px solid #d9e0e7;

    border-radius: 7px;

    color: #172b44;

    font-family: inherit;

    font-size: 14px;

    outline: none;

    transition: 0.2s ease;
}

.form-field input::placeholder {
    color: #a3afbd;
}

.form-field input:focus {
    border-color: #8798ab;

    box-shadow: 0 0 0 3px rgba(23, 43, 68, 0.06);
}

.form-field small {
    display: block;

    margin-top: 7px;

    color: #94a3b8;

    font-size: 11px;
}

.field-error {
    display: block;

    margin-top: 6px;

    color: #dc2626;

    font-size: 11px;
}


/* ================================
   PERMISSION NOTICE
================================ */

.permissions-notice {
    display: flex;

    align-items: flex-start;

    gap: 11px;

    padding: 14px;

    margin-top: 5px;

    margin-bottom: 25px;

    background: #f8fafc;

    border: 1px solid #e7edf2;

    border-radius: 8px;
}

.notice-icon {
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

.permissions-notice strong {
    display: block;

    margin-bottom: 3px;

    color: #475569;

    font-size: 12px;
}

.permissions-notice p {
    margin: 0;

    color: #8a9ab0;

    font-size: 11px;

    line-height: 1.5;
}


/* ================================
   ACTIONS
================================ */

.role-form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 9px;

    padding-top: 20px;

    border-top: 1px solid #edf1f5;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 700px) {

    .role-form-page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .role-form {
        padding: 22px 18px;
    }

    .role-form-card-header {
        padding: 18px;
    }

    .role-form-actions {
        flex-direction: column-reverse;
    }

    .role-form-actions .primary-btn,
    .role-form-actions .secondary-btn {
        width: 100%;
    }

}

</style>

@endpush