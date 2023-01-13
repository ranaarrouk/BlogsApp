@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{ __('Blogs List') }}</h1>
            <div class="col-md-12">
                @include('admin.blogs.search_results')
            </div>
        </div>
    </div>
    @include('admin.message_modal')
@endsection
@push('jsscripts')
    <script>
        $(document).ready(function () {
            $(function () {
                var table = $('#blogs-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('blogs.index') }}",
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'publish_date', name: 'publish_date'},
                        {data: 'status', name: 'status'},
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    initComplete: function (settings, json) {
                        $('.delete-blog').on('click', function (e) {
                            e.preventDefault();
                            let url = $(this).data("url");
                            $('#responseTitle').text("Delete Blog");
                            $.ajax({
                                method: "DELETE",
                                url: url,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function (response) {
                                    table.clear().draw();
                                    $('#responseMessage').addClass("alert-success");
                                    $('#responseMessage').text(response);
                                    $('#messageModal').modal('show');
                                },
                                error: function (response) {
                                    $('#responseMessage').addClass("alert-danger");
                                    $('#responseMessage').text("Something went wrong");
                                    $('#messageModal').modal('show');
                                }
                            });
                        })
                    }
                });

            });

        });
    </script>
@endpush
