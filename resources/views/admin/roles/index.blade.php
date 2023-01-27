@extends('admin.layouts.app')
@section('title')
    {{ __('roles') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title line-height-36">{{ __('roles_list') }}</h3>
                            <div class="d-flex align-items center">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-dark mr-2">
                                    <i class="fas fa-users mr-1"></i>
                                    {{ __('all_users') }}
                                </a>
                                @if (auth()->user()->can('role.create'))
                                    <a href="{{ route('role.create') }}"
                                        class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                        <i class="fas fa-plus mr-1"></i>
                                        {{ __('create') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">{{ __('name') }}</th>
                                    <th>{{ __('permission') }}</th>
                                    @if (auth()->user()->can('role.edit') ||
                                        auth()->user()->can('role.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ ucwords($role->name) }}</td>
                                        <td>
                                            <a href="#" id="ShowPer{{ $loop->index + 1 }}"
                                                onclick="ShowPermission('ShowPer{{ $loop->index + 1 }}', 'allPermission{{ $loop->index + 1 }}' )">
                                                <svg width="22px" height="22px" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <span class="row d-none" id="allPermission{{ $loop->index + 1 }}">
                                                <a href="#" id="ShowPer{{ $loop->index + 1 }}"
                                                    onclick="HidePermission('allPermission{{ $loop->index + 1 }}' , 'ShowPer{{ $loop->index + 1 }}' )"
                                                    class="col-md-1">
                                                    <svg width="22px" height="22px" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <span class="col-md-11">
                                                    @foreach ($role->permissions as $item)
                                                        <span
                                                            class="badge badge-primary permission">{{ $item->name }}</span>
                                                    @endforeach
                                                </span>
                                            </span>
                                        </td>
                                        @if (auth()->user()->can('role.edit') ||
                                            auth()->user()->can('role.delete'))
                                            <td>
                                                @if (auth()->user()->can('role.edit'))
                                                    <a href="{{ route('role.edit', $role->id) }}"
                                                        class="btn bg-info"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if (auth()->user()->can('role.delete'))
                                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-admin.not-found word="roles" route="role.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function ShowPermission(id1, id2) {
            // remove Icon
            $('#' + id1).addClass('d-none');
            // Show Permission
            $('#' + id2).removeClass('d-none');
        };

        function HidePermission(id1, id2) {
            // d-none class add in permission span
            $('#' + id1).addClass('d-none');
            // show eye icon
            $('#' + id2).removeClass('d-none');
        }
    </script>
@endsection
