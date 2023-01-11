@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-6 col-md-4">
                    <div class="card  mb-3">
                        <a href="{{ route("blogs.show", $blog->id) }}" style=" text-decoration: inherit;color: inherit;">
                            <div class="card-header">{{ $blog->title }}
                            </div>
                            <div class="card-body">
                                <img width="100%" src="{{ asset('storage/blogs/images/' . $blog->image) }}"
                                     class="img-thumbnail">
                                <p class="card-text"><small class="text-muted">{{ $blog->publish_date }}</small></p>
                                <p class="card-text"><small class="text-muted">{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
