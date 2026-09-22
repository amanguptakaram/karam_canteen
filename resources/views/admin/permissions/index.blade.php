@extends('admin.layouts.app')

@section('content')

<style>
    .permission-page {
        max-width: 1100px;
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

    .permission-table {
        width: 100%;
        border-collapse: collapse;
    }

    .permission-table th {
        background: #f8fafc;
        color: #374151;
        font-size: 13px;
        text-align: left;
        padding: 14px 18px;
        border-bottom: 1px solid #e5e7eb;
    }

    .permission-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #e5e7eb;
        color: #4b5563;
        font-size: 14px;
    }

    .permission-table tr:last-child td {
        border-bottom: none;
    }

    .permission-name {
        font-weight: 600;
        color: #172b44;
    }

    .permission-slug {
        font-family: monospace;
        background: #f3f4f6;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 12px;
        color: #374151;
    }

    .module-badge {
        display: inline-block;
        padding: 5px 9px;
        background: #eef2f7;
        color: #172b44;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #6b7280;
    }

    @media (max-width: 700px) {
        .permission-table {
            min-width: 650px;
        }

        .permission-card {
            overflow-x: auto;
        }
    }
</style>

<div class="permission-page">

    <div class="page-header">
        <h1>Permissions</h1>

        <p>
            Available permissions defined by the application.
        </p>
    </div>

    <div class="permission-card">

        @if ($permissions->count())

            <table class="permission-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Module</th>
                        <th>Permission</th>
                        <th>Slug</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($permissions as $permission)

                        @php
                            $parts = explode('.', $permission->slug);
                            $module = $parts[0];
                            $action = $parts[1] ?? '';
                        @endphp

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="module-badge">
                                    {{ $module }}
                                </span>
                            </td>

                            <td class="permission-name">
                                {{ ucwords(str_replace(['_', '-'], ' ', $action)) }}
                            </td>

                            <td>
                                <span class="permission-slug">
                                    {{ $permission->slug }}
                                </span>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty-state">
                No permissions available.
            </div>

        @endif

    </div>

</div>

@endsection