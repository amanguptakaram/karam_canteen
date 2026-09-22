@extends('admin.layouts.app')

@section('title', 'Users')

@section('page-title', 'Users')

@section('content')

<style>
    /*
    |--------------------------------------------------------------------------
    | Users Table
    |--------------------------------------------------------------------------
    */

    .users-table-card {
        width: 100%;
        overflow: hidden;
    }

    .users-table-wrapper {
        width: 100%;
        overflow: hidden;
    }

    .users-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .users-table th {
        background: #f8fafc;
        color: #374151;
        font-weight: 700;
        font-size: 13px;
        text-align: left;
        padding: 14px 12px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .users-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    .users-table tr:last-child td {
        border-bottom: none;
    }

    /*
    |--------------------------------------------------------------------------
    | Column Widths
    |--------------------------------------------------------------------------
    */

    .users-table th:nth-child(1),
    .users-table td:nth-child(1) {
        width: 22%;
    }

    .users-table th:nth-child(2),
    .users-table td:nth-child(2) {
        width: 12%;
    }

    .users-table th:nth-child(3),
    .users-table td:nth-child(3) {
        width: 12%;
    }

    .users-table th:nth-child(4),
    .users-table td:nth-child(4) {
        width: 21%;
    }

    .users-table th:nth-child(5),
    .users-table td:nth-child(5) {
        width: 11%;
    }

    .users-table th:nth-child(6),
    .users-table td:nth-child(6) {
        width: 13%;
    }

    .users-table th:nth-child(7),
    .users-table td:nth-child(7) {
        width: 9%;
    }

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    .table-user {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .table-user-avatar {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        background: #fff3e0;
        color: #c87800;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

    .table-user-info {
        min-width: 0;
    }

    .table-user-info strong {
        display: block;
        color: #172b44;
        font-size: 14px;
        line-height: 1.35;
        overflow-wrap: anywhere;
    }

    /*
    |--------------------------------------------------------------------------
    | Role Badge
    |--------------------------------------------------------------------------
    */

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-user {
        background: #eef4ff;
        color: #315ea8;
    }

    /*
    |--------------------------------------------------------------------------
    | Action
    |--------------------------------------------------------------------------
    */

    .table-action-btn {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 6px;
        background: #f3f4f6;
        color: #374151;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-action-btn:hover {
        background: #e5e7eb;
    }

    /*
    |--------------------------------------------------------------------------
    | Add User Button
    |--------------------------------------------------------------------------
    */

    .users-add-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 16px;
        border-radius: 7px;
        background: #172b44;
        color: #ffffff !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .users-add-btn:hover {
        background: #243b59;
    }

    /*
    |--------------------------------------------------------------------------
    | Mobile / Smaller Screens
    |--------------------------------------------------------------------------
    */

    @media (max-width: 900px) {

        .users-table th,
        .users-table td {
            padding: 10px 8px;
            font-size: 12px;
        }

        .table-user-avatar {
            width: 32px;
            height: 32px;
            min-width: 32px;
        }

        .users-table th:nth-child(3),
        .users-table td:nth-child(3) {
            display: none;
        }

        .users-table th:nth-child(3) {
            width: 0;
        }

        .users-table th:nth-child(1),
        .users-table td:nth-child(1) {
            width: 25%;
        }

        .users-table th:nth-child(2),
        .users-table td:nth-child(2) {
            width: 14%;
        }

        .users-table th:nth-child(4),
        .users-table td:nth-child(4) {
            width: 23%;
        }

        .users-table th:nth-child(5),
        .users-table td:nth-child(5) {
            width: 13%;
        }

        .users-table th:nth-child(6),
        .users-table td:nth-child(6) {
            width: 15%;
        }

        .users-table th:nth-child(7),
        .users-table td:nth-child(7) {
            width: 10%;
        }
    }
</style>


<div class="admin-page-header">

    <div>
        <h2>Users</h2>

        <p>
            Manage registered KARAM Canteen users.
        </p>
    </div>

    <a
        href="{{ route('admin.users.create') }}"
        class="users-add-btn"
    >
        + Add User
    </a>

</div>


<div class="admin-table-card users-table-card">

    <div class="admin-table-header">

        <div>

            <h3>
                Registered Users
            </h3>

            <span>
                {{ $users->count() }} registered users
            </span>

        </div>

    </div>


    @if ($users->count())

        <div class="users-table-wrapper">

            <table class="users-table">

                <thead>

                    <tr>

                        <th>User</th>

                        <th>Employee Code</th>

                        <th>Department</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Registered</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($users as $user)

                        <tr>

                            <td>

                                <div class="table-user">

                                    <div class="table-user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div class="table-user-info">

                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $user->emp_code }}
                            </td>


                            <td>
                                {{ $user->department ?? '—' }}
                            </td>


                            <td>
                                {{ $user->email }}
                            </td>


                            <td>

                                @if ($user->userRole)

                                    <span class="status-badge status-user">
                                        {{ $user->userRole->name }}
                                    </span>

                                @else

                                    <span class="status-badge">
                                        No Role
                                    </span>

                                @endif

                            </td>


                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>


                            <td>

                                <a
                                    href="{{ route('admin.users.show', $user) }}"
                                    class="table-action-btn"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="admin-empty-state">

            <div class="empty-icon">
                👥
            </div>

            <h3>
                No Users Found
            </h3>

            <p>
                Registered users will appear here.
            </p>

        </div>

    @endif

</div>

@endsection