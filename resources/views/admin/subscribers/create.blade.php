@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                    Added Successfully
                </div>
                <form>
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="input-name">Name</label>
                        <input type="text" class="form-control" id="input-name" placeholder="Name">
                        <span class="text-danger" id="nameErrorMsg"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="input-username">Username</label>
                        <input type="text" class="form-control" id="input-username" placeholder="Username">
                        <span class="text-danger" id="usernameErrorMsg"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input-password">Password</label>
                        <input type="password" class="form-control" id="input-password" placeholder="Password">
                        <span class="text-danger" id="passwordErrorMsg"></span>

                    </div>
                    <div class="form-group col-md-12 mb-3">
                        <label for="input-status">Status</label>
                        <select id="input-status" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                        <span class="text-danger" id="statusErrorMsg"></span>
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

                let name = $('#input-name').val();
                let username = $('#input-username').val();
                let password = $('#input-password').val();
                let status = $('#input-status').val();

                $.ajax({
                    url: "{{ route('subscribers.store') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        username: username,
                        password: password,
                        status: status,
                    },
                    success: function (response) {
                        $('#successMsg').show();
                        console.log(response);
                    },
                    error: function (response) {
                        $('#nameErrorMsg').text(response.responseJSON.errors.name);
                        $('#usernameErrorMsg').text(response.responseJSON.errors.username);
                        $('#passwordErrorMsg').text(response.responseJSON.errors.password);
                        $('#statusErrorMsg').text(response.responseJSON.errors.status);
                    },
                });
            });
        });
    </script>
@endsection
