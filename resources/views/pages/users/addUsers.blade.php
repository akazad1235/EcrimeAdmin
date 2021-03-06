@extends('layouts.master')

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title font-weight-bold text-primary font">Create Admin</h4>
                    <p class="sub-header">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('added_recorded'))
                            <script>
                                toastr.success("{!!Session::get('added_recorded')!!}");
                            </script>
                        @endif
                         @if(Session::has('error_recorded'))
                            <script>
                                toastr.error("{!!Session::get('error_recorded')!!}");
                            </script>
                        @endif
                    </p>

                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('users.store')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Name<span class="text-danger">*</span></label>
                                    <input type="text" id="simpleinput" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="example-email">Email<span class="text-danger">*</span></label>
                                    <input type="email" id="example-email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dest">Police Station<span class="text-danger">*</span></label>
                                    <select class="selectpicker" data-live-search="true" name="station"  data-style="btn-light">
                                            <option>Choose..</option>
                                            @foreach ($getSation as $value)
                                            <option value="{{$value->id}}">{{$value->policeStationName}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                            <label for="rules">User Roles<span class="text-danger">*</span></label>
                                            <select id="rules" class="form-control" required="" name="user_role">
                                                <option value="">Choose..</option>
                                                <option value="1">Admin</option>
                                                <option value="0">User</option>
                                               
                                            </select>
                                        </div>
                                <div class="form-group mb-3">
                                    <label for="pass">Passwords<span class="text-danger">*</span></label>
                                    <input type="password" id="pass" name="password" class="form-control" placeholder="password minimum 6 character" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-textarea"></label>
                                    <input type="submit"  class=" btn btn-primary"  value="Submit">
                                </div>
                            </form>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
@endsection