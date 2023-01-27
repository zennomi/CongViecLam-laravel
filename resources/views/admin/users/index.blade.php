@extends('admin.layouts.app')
@section('title')
    {{ __('users_list') }}
@endsection

@section('content')
    @php
    $userr = auth()->user();
    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title line-height-36">{{ __('users_list') }}</h3>
                            <div class="d-flex align-items center">
                                <a href="{{ route('role.index') }}" class="btn btn-outline-dark mr-2">
                                    <i class="fas fa-lock mr-1"></i>
                                    {{ __('all_roles') }}
                                </a>
                                <a href="{{ route('user.create') }}" class="btn bg-primary">
                                    <i class="fas fa-plus mr-1"></i> &nbsp;
                                    {{ __('create') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('roles') }}</th>
                                    @if ($userr->can('admin.edit') || $userr->can('admin.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn bg-info"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-admin.not-found route="user.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
