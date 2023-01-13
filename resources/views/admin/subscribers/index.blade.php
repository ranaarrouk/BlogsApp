@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{ __('Subscribers List') }}</h1>
            <div class="col-md-12">
                @include('admin.subscribers.search_results')
            </div>
        </div>
    </div>
@endsection
@push('jsscripts')
    <script>
        $(document).ready( function () {
            $(function () {
                var table = $('#subscribers-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('subscribers.index') }}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'username', name: 'username'},
                        {data: 'password', name: 'password'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        } );
    </script>
@endpush
