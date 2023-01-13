@extends('layouts.app')

@section('content')
    <div class="container"
         style="background-image: url('{{asset('images/background-2.jpg')}}'); height: 600px;border-radius: 0.3rem">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-lg-5">
                <h1> {{__('Create New Subscriber')}}</h1>
                <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                </div>
                <form id="SubmitForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-md-12">
                        <label for="input-name">Name</label>
                        <input type="text" name="name" class="form-control" id="input-name" placeholder="Name"
                               value="{{ $subscriber->name }}">
                        <span class="text-danger" id="nameErrorMsg"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="input-username">Username</label>
                        <input type="text" class="form-control" id="input-username" placeholder="Username"
                               value="{{ $subscriber->username }}" disabled="disabled">
                        <span class="text-danger" id="usernameErrorMsg"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input-password">Password</label>
                        <input type="password" name="password" class="form-control" id="input-password" placeholder="Password">
                        <span class="text-danger" id="passwordErrorMsg"></span>

                    </div>
                    <div class="form-group col-md-12 mb-3">
                        <label for="input-status">Status</label>
                        <select name="status" id="input-status" class="form-control">
                            @foreach(getSubscriberStatus() as $status)
                                <option value="{{$status}}"
                                        @if($subscriber->status == $status)  selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="statusErrorMsg"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('jsscripts')
    <script>
        $(document).ready(function () {
            $('#SubmitForm').on('submit', function (e) {
                e.preventDefault();

                // clear error messages
                $('#nameErrorMsg').text("");
                $('#usernameErrorMsg').text("");
                $('#passwordErrorMsg').text("");
                $('#statusErrorMsg').text("");

                // get inputs values
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('subscribers.update', $subscriber->id) }}",
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
                        $('#nameErrorMsg').text(response.responseJSON.name);
                        $('#usernameErrorMsg').text(response.responseJSON.username);
                        $('#passwordErrorMsg').text(response.responseJSON.password);
                        $('#statusErrorMsg').text(response.responseJSON.status);
                    },
                });
            });
        });
    </script>
@endpush
