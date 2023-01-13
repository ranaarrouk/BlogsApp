@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{ __('Blogs List') }}</h1>
            <!-- Button trigger modal -->
            <button type="button" class="m-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                {{ __('Advanced Search') }}
            </button>
            <!-- Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="searchModalLabel">{{ __('Advanced Search') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12 mb-3">
                                <label for="input-status">Status</label>
                                <select name="status" id="input-status" class="form-control">
                                    <option value="">...</option>
                                @foreach(getBlogStatus() as $status)
                                        <option value="{{$status}}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="input-publishDate">Publish Date</label>
                                <input type="date" class="form-control" name="publish_date" id="input-publishDate"
                                       placeholder="Publish Date">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button id="searchBtn" type="button" class="btn btn-primary">{{ __('Go') }}</button>
                        </div>
                    </div>
                </div>
            </div>
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
                    ajax: {
                        url: "{{ route('blogs.index') }}",
                        data: function (d) {
                            d.status = $('#input-status').val(),
                            d.publish_date = $('#input-publishDate').val(),
                                d.search = $('input[type="search"]').val()
                        }
                    },

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

                $('#searchBtn').on('click', function () {
                    table.clear().draw();
                });

            });

        });
    </script>
@endpush
