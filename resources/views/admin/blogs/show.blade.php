@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h1> {{ $blog->title }}</h1>
                        <small>{{ $blog->publish_date }}</small>
                        <img width="100%" src="{{ asset('storage/blogs/images/' . $blog->image) }}">

                        <p>
                            {{ $blog->content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
