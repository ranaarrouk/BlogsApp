@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" id="blogsDev">

        </div>
    </div>
@endsection
@push('jsscripts')
    <script>
        $.ajax({
            url: "{{ route('home.blogs') }}",
            method: "GET",
            success: function (data) {
                alert('success');
                console.log(data);
                $('#blogsDev').html(data);
            },
            error: function (response) {

            }
        });
    </script>
@endpush
