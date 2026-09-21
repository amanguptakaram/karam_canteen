@extends('admin.layouts.app')

@section('title', 'Users')

@section('page-title', 'Users')

@section('content')

    <div class="admin-page-header">

        <div>
            <h2>Users</h2>

            <p>
                Manage registered KARAM Canteen users.
            </p>
        </div>

    </div>


    <div class="admin-table-card">

        <div class="admin-table-header">

            <div>
                <h3>Registered Users</h3>

                <span>
                    {{ $users->count() }} registered users
                </span>
            </div>

        </div>


        @if ($users->count())

            <div class="admin-table-wrapper">

                <table class="admin-table">

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
                                    {{ $user->department }}
                                </td>


                                <td>
                                    {{ $user->email }}
                                </td>


                                <td>

                                    @if ($user->role === 'admin')

                                        <span class="status-badge status-admin">
                                            Admin
                                        </span>

                                    @else

                                        <span class="status-badge status-user">
                                            User
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

                <h3>No Users Found</h3>

                <p>
                    Registered users will appear here.
                </p>

            </div>

        @endif

    </div>

@endsection