@extends('layouts.app')

@section('content')
    <div class="container"
         style="background-image: url('{{asset('images/background-2.jpg')}}'); height: 1000px;border-radius: 0.3rem">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-lg-5">
                <h1> {{__('Edit Blog ')}}</h1>
                <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                </div>
                <form id="SubmitForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-md-12">
                        <label for="input-title">Title</label>
                        <input type="text" name="title" class="form-control" id="input-title" placeholder="Title"
                               value="{{ $blog->title }}">
                        <span class="text-danger" id="titleErrorMsg"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="input-content">Content</label>
                        <textarea class="form-control" name="content" id="input-content"
                                  placeholder="Content">{{ $blog->content }}</textarea>
                        <span class="text-danger" id="contentErrorMsg"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="mt-5" for="input-image">Update Image</label>
                        @if($blog->image)
                            <img class="img-thumbnail" src="{{ asset('storage/blogs/images/' . $blog->image) }}">
                        @endif
                        <input type="file" class="form-control" name="image" id="input-image" placeholder="Image">
                        <span class="text-danger" id="imageErrorMsg"></span>

                    </div>
                    <div class="form-group col-md-12 mb-3">
                        <label for="input-status">Status</label>
                        <select name="status" id="input-status" class="form-control">
                            @foreach(getBlogStatus() as $status)
                                <option value="{{$status}}"
                                        @if($blog->status == $status)  selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="statusErrorMsg"></span>
                    </div>

                    <div class="form-group col-md-12 mb-3">
                        <label for="input-publishDate">Publish Date</label>
                        <input type="date" class="form-control" name="publish_date" id="input-publishDate"
                               value="{{ $blog->publish_date }}"
                               placeholder="Publish Date">
                        <span class="text-danger" id="publishDateErrorMsg"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();
                let formData;

                // clear error messages
                $('#titleErrorMsg').text("");
                $('#contentErrorMsg').text("");
                $('#imageErrorMsg').text("");
                $('#statusErrorMsg').text("");
                $('#publishDateErrorMsg').text("");

                formData = new FormData(this);

                $.ajax({
                    url: "{{ route('blogs.update', $blog->id) }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#successMsg').text(response);
                        $('#successMsg').show();
                    },
                    error: function (response) {
                        console.log(response);
                        $('#titleErrorMsg').text(response.responseJSON.title);
                        $('#contentErrorMsg').text(response.responseJSON.content);
                        $('#imageErrorMsg').text(response.responseJSON.image);
                        $('#statusErrorMsg').text(response.responseJSON.status);
                        $('#publishDateErrorMsg').text(response.responseJSON.publish_date);
                    },
                });
            });
        });
    </script>
@endsection
