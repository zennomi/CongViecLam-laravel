@extends('admin.layouts.app')
@section('title')
    {{ __('faq_category_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('faq_category_list') }}</h3>
                        @if (userCan('faq.create'))
                            <a href="{{ route('module.faq.category.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('create') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('icon') }}</th>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('faq.update') || userCan('faq.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @forelse ($faqCategories as $faqCategory)
                                    <tr data-id="{{ $faqCategory->id }}">
                                        <th>{{ $loop->iteration }}</th>
                                        <th><i class="{{ $faqCategory->icon }}"></i></th>
                                        <th>{{ $faqCategory->name }}</th>
                                        @if (userCan('faq.update') || userCan('faq.delete'))
                                            <td>
                                                @if (userCan('faq.update'))
                                                    <div class="handle btn btn-success mt-0"><i
                                                            class="fas fa-hand-rock"></i></div>
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('edit') }}"
                                                        href="{{ route('module.faq.category.edit', $faqCategory->id) }}"
                                                        class="btn bg-info"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if (userCan('faq.delete'))
                                                    <form
                                                        action="{{ route('module.faq.category.destroy', $faqCategory->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete') }}"
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
                                            @if (userCan('faq.create'))
                                                <x-admin.not-found word="faq_category" route="module.faq.category.create" />
                                            @else
                                                <x-admin.not-found word="faq_category" route="" />
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable tr');
                },
                classes: {
                    "ui-sortable": "highlight"
                },
            });
            $("#sortable").disableSelection();

            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('module.faq.category.updateOrder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });
    </script>
@endsection
