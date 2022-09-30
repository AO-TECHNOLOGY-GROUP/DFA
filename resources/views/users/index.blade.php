@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">User Management</a></li>
{{--                    <li class="breadcrumb-item active" aria-current="page">User Management</li>--}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Users</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">User Management</h4>
                        </div>
                        <div class="col-lg-6">
                            @can('create_users')
                                <a href="{{ route('users.create') }}"
                                   class="btn btn-sm btn-soft-primary float-right  mr-2"
                                   data-toggle="tooltip" data-placement="top"
                                   title="New User">
                                    <i class="uil uil-plus"> Add Portal User</i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($users))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Maker</th>
                                <th>Checker</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ ucwords($user->first_name .' '. $user->last_name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucwords($user->role) }}</td>
                                    <td>{!! status_label($user->status) !!}</td>
                                    @if(!empty($users))
                                        <td>
                                            {{ makerCheckerName($user->creator_id)}}
                                            <small class="d-block"></small>
                                        </td>
                                    @else
                                        <td>...</td>
                                    @endif
                                    <td>
                                        {{ makerCheckerName($user->verifier_id) }}
                                        <small class="d-block"></small>
                                    </td>
                                    <td class="text-center">
                                        @if($user->id !=auth()->user()->id)
                                            @can('manage_users')
                                                <a href="{{ route('users.edit', $user->id) }}" title="Edit User"
                                                   class="btn btn-outline-primary btn-sm" data-toggle="tooltip"
                                                   data-placement="top"><i class="uil uil-edit-alt"></i>
                                                </a>
                                            @endcan

                                            @can('view_users')
{{--                                                <a href="{{ route('users.show', $user->id) }}" title="view Role"--}}
{{--                                                   class="btn btn-outline-primary btn-sm" rel="tooltip"--}}
{{--                                                   data-placement="top"><i class="uil uil-eye"></i> view--}}
{{--                                                </a>--}}
                                            @endcan

                                            @can('manage_users')
                                                <a href="{{route('users.logs',$user->id)}}" data-toggle="tooltip"
                                                   class="btn btn-outline-primary btn-sm " data-original-title=""
                                                   title="Download User Logs">
                                                    <i class="uil uil-file-download-alt"></i> Download
                                                </a>
                                            @endcan

                                            @can('user_delete')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                      style="display:inline-block;" class="">
                                                    @csrf
                                                    <button type="button" rel="tooltip"
                                                            class="btn btn-outline-danger btn-sm"
                                                            title="Delete User"
                                                            data-placement="top" data-toggle="modal"
                                                            data-target="#confirmDelete" data-title="Deactivate User"
                                                            data-message="Are you sure you want to delete this user?">
                                                        <i class="uil uil-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        @else
                                            <a type="button" href="{{ route('settings.profile') }}" rel="tooltip"
                                               class="btn btn-outline-primary btn-sm " data-original-title=""
                                               title="Edit Profile">
                                                <i class="uil uil-edit-alt"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Maker</th>
                                <th>Checker</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        {!! $users->links() !!}
                    @else
                        <br>
                        <div class="row">
                            <div class="alert alert-secondary container-fluid">
                                No records found
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection

