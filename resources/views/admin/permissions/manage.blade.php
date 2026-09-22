@extends('admin.layouts.app')

@section('content')

<style>
    .permission-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 24px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        color: #172b44;
        font-size: 28px;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
    }

    .permission-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    .permission-group {
        border-bottom: 1px solid #e5e7eb;
    }

    .permission-group:last-child {
        border-bottom: none;
    }

    .group-header {
        background: #f8fafc;
        padding: 16px 20px;
        font-weight: 700;
        color: #172b44;
        text-transform: capitalize;
    }

    .permission-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        padding: 18px 20px;
    }

    .permission-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .permission-item:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .permission-item input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #172b44;
    }

    .permission-name {
        color: #374151;
        font-size: 14px;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-primary {
        background: #172b44;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #243b59;
    }

    @media (max-width: 700px) {
        .permission-list {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            text-align: center;
        }
    }
</style>

<div class="permission-page">

    <div class="page-header">
        <h1>Manage Permissions</h1>
        <p>
            Assign permissions to
            <strong>{{ $role->name }}</strong>
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('roles.permissions.update', $role) }}"
    >
        @csrf
        @method('PUT')

        <div class="permission-card">

            @php
                $groupedPermissions = $permissions->groupBy(function ($permission) {
                    return explode('.', $permission->slug)[0];
                });
            @endphp

            @foreach ($groupedPermissions as $module => $modulePermissions)

                <div class="permission-group">

                    <div class="group-header">
                        {{ $module }}
                    </div>

                    <div class="permission-list">

                        @foreach ($modulePermissions as $permission)

                            <label class="permission-item">

                                <input
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->id }}"
                                    {{ in_array($permission->id, $assignedPermissions) ? 'checked' : '' }}
                                >

                                <span class="permission-name">
                                    {{ ucwords(explode('.', $permission->slug)[1]) }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                </div>

            @endforeach

            <div class="actions">

                <a
                    href="{{ route('roles.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Permissions
                </button>

            </div>

        </div>

    </form>

</div>

@endsection