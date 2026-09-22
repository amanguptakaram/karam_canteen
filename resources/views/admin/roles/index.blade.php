@extends('admin.layouts.app')

@section('title', 'Roles')

@section('content')

<div class="roles-page">

    {{-- Header --}}
    <div class="roles-header">

        <div>
            <div class="roles-breadcrumb">
                Administration <span>/</span> Roles
            </div>

            <h1>Roles</h1>

            <p>
                Manage admin roles and control their access to system features.
            </p>
        </div>

        <a
            href="{{ route('roles.create') }}"
            class="roles-primary-btn"
        >
            <span class="btn-plus">+</span>
            Create Role
        </a>

    </div>


    {{-- Success Message --}}
    @if (session('success'))

        <div class="roles-alert roles-alert-success">

            <div class="alert-icon">✓</div>

            <div>
                <strong>Success</strong>
                <p>{{ session('success') }}</p>
            </div>

        </div>

    @endif


    {{-- Error Message --}}
    @if (session('error'))

        <div class="roles-alert roles-alert-error">

            <div class="alert-icon">!</div>

            <div>
                <strong>Action failed</strong>
                <p>{{ session('error') }}</p>
            </div>

        </div>

    @endif


    {{-- Main Card --}}
    <div class="roles-card">

        <div class="roles-card-header">

            <div>

                <h2>All Roles</h2>

                <p>
                    Assign and manage permissions for each admin role.
                </p>

            </div>

            <div class="roles-total">

                <span>{{ $roles->count() }}</span>

                {{ $roles->count() == 1 ? 'Role' : 'Roles' }}

            </div>

        </div>


        {{-- Roles Table --}}
        @if ($roles->count())

            <div class="roles-table-wrapper">

                <table class="roles-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Role</th>

                            <th>Slug</th>

                            <th>Permissions</th>

                            <th>Created</th>

                            <th class="actions-column">Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($roles as $role)

                            <tr>

                                {{-- Number --}}
                                <td class="number-cell">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- Role --}}
                                <td>

                                    <div class="role-info">

                                        <div class="role-avatar">
                                            {{ strtoupper(substr($role->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="role-title">
                                                {{ $role->name }}
                                            </div>

                                            <div class="role-subtitle">
                                                Admin role
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Slug --}}
                                <td>

                                    <span class="slug-badge">
                                        {{ $role->slug }}
                                    </span>

                                </td>


                                {{-- Permissions --}}
                                <td>

                                    <div class="permission-summary">

                                        <span class="permission-count">
                                            {{ $role->permissions->count() }}
                                        </span>

                                        <span class="permission-text">
                                            {{ $role->permissions->count() == 1 ? 'permission' : 'permissions' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Created --}}
                                <td>

                                    <span class="created-date">
                                        {{ $role->created_at->format('d M Y') }}
                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="role-actions">

                                        {{-- Manage Permissions --}}
                                        <a
                                            href="{{ route('roles.permissions.edit', $role) }}"
                                            class="action-btn permission-btn"
                                        >
                                            <span>✓</span>
                                            Manage Permissions
                                        </a>


                                        {{-- Edit Role --}}
                                        <a
                                            href="{{ route('roles.edit', $role) }}"
                                            class="action-btn edit-btn"
                                        >
                                            Edit
                                        </a>


                                        {{-- Delete Role --}}
                                        <form
                                            action="{{ route('roles.destroy', $role) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this role?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- Empty State --}}
            <div class="roles-empty">

                <div class="empty-icon">
                    R
                </div>

                <h3>No roles created yet</h3>

                <p>
                    Create your first admin role to start managing access.
                </p>

                <a
                    href="{{ route('roles.create') }}"
                    class="roles-primary-btn"
                >
                    <span class="btn-plus">+</span>
                    Create First Role
                </a>

            </div>

        @endif

    </div>

</div>

@endsection


@push('styles')

<style>

/* ========================================
   ROLES PAGE
======================================== */

.roles-page {
    width: 100%;
    max-width: 1400px;
}


/* ========================================
   HEADER
======================================== */

.roles-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 25px;
    margin-bottom: 28px;
}

.roles-breadcrumb {
    margin-bottom: 8px;
    color: #94a3b8;
    font-size: 12px;
    font-weight: 500;
}

.roles-breadcrumb span {
    margin: 0 6px;
    color: #cbd5e1;
}

.roles-header h1 {
    margin: 0;
    color: #172b44;
    font-size: 30px;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.roles-header p {
    margin: 6px 0 0;
    color: #7b8da5;
    font-size: 14px;
}


/* ========================================
   PRIMARY BUTTON
======================================== */

.roles-primary-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 11px 17px;

    background: #172b44;
    color: #ffffff;

    border-radius: 8px;
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    border: none;

    transition: all 0.2s ease;
}

.roles-primary-btn:hover {
    background: #0f2035;
    color: #ffffff;
    transform: translateY(-1px);
}

.btn-plus {
    font-size: 18px;
    line-height: 1;
}


/* ========================================
   ALERTS
======================================== */

.roles-alert {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 13px 16px;
    margin-bottom: 20px;

    border-radius: 8px;

    font-size: 13px;
}

.roles-alert strong {
    display: block;
    margin-bottom: 2px;
}

.roles-alert p {
    margin: 0;
}

.roles-alert-success {
    background: #ecfdf5;
    border: 1px solid #bbf7d0;
    color: #047857;
}

.roles-alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
}

.alert-icon {
    width: 28px;
    height: 28px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(255, 255, 255, 0.7);

    font-weight: 700;
}


/* ========================================
   CARD
======================================== */

.roles-card {
    background: #ffffff;

    border: 1px solid #e5eaf0;
    border-radius: 12px;

    overflow: hidden;

    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
}

.roles-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 21px 24px;

    border-bottom: 1px solid #edf1f5;
}

.roles-card-header h2 {
    margin: 0 0 4px;

    color: #172b44;

    font-size: 17px;
    font-weight: 700;
}

.roles-card-header p {
    margin: 0;

    color: #8a9ab0;

    font-size: 13px;
}

.roles-total {
    display: flex;
    align-items: center;
    gap: 6px;

    padding: 7px 12px;

    background: #f5f7fa;

    border-radius: 20px;

    color: #64748b;

    font-size: 12px;
    font-weight: 600;
}

.roles-total span {
    color: #172b44;
    font-weight: 700;
}


/* ========================================
   TABLE
======================================== */

.roles-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.roles-table {
    width: 100%;
    border-collapse: collapse;
}

.roles-table th {
    padding: 13px 20px;

    background: #fafbfd;

    border-bottom: 1px solid #edf1f5;

    color: #7b8da5;

    text-align: left;

    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.roles-table td {
    padding: 16px 20px;

    border-bottom: 1px solid #f0f3f6;

    color: #52647a;

    font-size: 13px;

    vertical-align: middle;
}

.roles-table tbody tr:last-child td {
    border-bottom: none;
}

.roles-table tbody tr {
    transition: background 0.15s ease;
}

.roles-table tbody tr:hover {
    background: #fbfcfd;
}

.number-cell {
    width: 45px;
    color: #9aa8ba !important;
}


/* ========================================
   ROLE INFO
======================================== */

.role-info {
    display: flex;
    align-items: center;
    gap: 11px;
}

.role-avatar {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f4f7;

    border-radius: 9px;

    color: #172b44;

    font-size: 14px;
    font-weight: 700;
}

.role-title {
    color: #172b44;

    font-size: 14px;
    font-weight: 650;
}

.role-subtitle {
    margin-top: 2px;

    color: #9aa8ba;

    font-size: 11px;
}


/* ========================================
   SLUG
======================================== */

.slug-badge {
    display: inline-block;

    padding: 5px 8px;

    background: #f5f7fa;

    border: 1px solid #e8edf2;

    border-radius: 5px;

    color: #64748b;

    font-family: monospace;

    font-size: 11px;
}


/* ========================================
   PERMISSIONS
======================================== */

.permission-summary {
    display: flex;
    align-items: center;
}

.permission-count {
    display: inline-flex;

    min-width: 28px;
    height: 26px;

    align-items: center;
    justify-content: center;

    margin-right: 7px;

    background: #f1f5f9;

    border-radius: 6px;

    color: #172b44;

    font-size: 12px;
    font-weight: 700;
}

.permission-text {
    color: #7b8da5;

    font-size: 12px;
}


/* ========================================
   DATE
======================================== */

.created-date {
    color: #7b8da5;
    font-size: 12px;
}


/* ========================================
   ACTIONS
======================================== */

.actions-column {
    min-width: 270px;
}

.role-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
}

.role-actions form {
    margin: 0;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;

    padding: 7px 10px;

    border-radius: 6px;

    border: 1px solid transparent;

    text-decoration: none;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    transition: all 0.2s ease;
}


/* Manage Permissions */

.permission-btn {
    background: #172b44;
    border-color: #172b44;
    color: #ffffff;
}

.permission-btn:hover {
    background: #0f2035;
    border-color: #0f2035;
    color: #ffffff;
}


/* Edit */

.edit-btn {
    background: #f5f7fa;
    border-color: #e6ebf0;
    color: #475569;
}

.edit-btn:hover {
    background: #e9eef3;
    color: #172b44;
}


/* Delete */

.delete-btn {
    background: #fff1f2;
    border-color: #ffe0e3;
    color: #c2414b;
}

.delete-btn:hover {
    background: #ffe4e6;
    color: #b4232d;
}


/* ========================================
   EMPTY STATE
======================================== */

.roles-empty {
    padding: 70px 20px;
    text-align: center;
}

.empty-icon {
    width: 55px;
    height: 55px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 15px;

    background: #f1f4f7;

    border-radius: 14px;

    color: #172b44;

    font-size: 18px;
    font-weight: 700;
}

.roles-empty h3 {
    margin: 0 0 7px;

    color: #172b44;

    font-size: 17px;
}

.roles-empty p {
    margin: 0 0 20px;

    color: #8a9ab0;

    font-size: 13px;
}


/* ========================================
   RESPONSIVE
======================================== */

@media (max-width: 768px) {

    .roles-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .roles-card-header {
        align-items: flex-start;
        gap: 12px;
        flex-direction: column;
    }

    .roles-table {
        min-width: 1000px;
    }

}

</style>

@endpush