@extends('admin.layouts.app')
@section('title')
    {{ __('category_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('category_list') }}</h3>
                        @if (userCan('post.create'))
                            <a href="{{ route('module.category.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus"></i>&nbsp;{{ __('create') }}</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row" class="text-center">
                                                <th width="5%">#</th>
                                                <th>{{ __('image') }}</th>
                                                <th>{{ __('name') }} ({{ __('posts') }})</th>
                                                @if (userCan('post.update') || userCan('post.delete'))
                                                    <th width="150px"> {{ __('action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($categories as $category)
                                                <tr role="row" class="odd">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <img width="50px" height="50px" class="rounded"
                                                            src="{{ $category->image_url }}" alt="">
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ $category->name }}({{ $category->posts_count }})
                                                    </td>
                                                    @if (userCan('post.update') || userCan('post.delete'))
                                                        <td class="sorting_1 text-center" tabindex="0">
                                                            @if (userCan('post.update'))
                                                                <a data-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('edit') }}"
                                                                    href="{{ route('module.category.edit', $category->id) }}"
                                                                    class="btn bg-info"><i
                                                                        class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if (userCan('post.delete'))
                                                                <form
                                                                    action="{{ route('module.category.delete', $category->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button data-toggle="tooltip" data-placement="top"
                                                                        title="{{ __('delete') }}"
                                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                        class="btn bg-danger"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
