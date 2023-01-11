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
    <script>
        $(document).ready( function () {
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
                    ]
                });
            });
        } );
    </script>
@endsection
