@extends('layouts.default')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

@section('content')
<div class="container-fluid">
        <div class="row">
<div class="col-md-12">
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Add User</h3>
                <div class="card-tools">
                <a  href="{{ url('users') }}" class="btn btn-block btn-primary  btn-sm"></i>Go Back</a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
          <form role="form" action="{{ route('users.store') }}" method="POST">
              @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter name">
                    {!! $errors->first('name', '<p class="error text-danger">:message</p>') !!}
                </div>

                <label for="name">User Type</label>
                <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" class="user_type" value="0" id="radioPrimary1" name="user_type" checked>
                        <label for="radioPrimary1">
                            App User
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" class="user_type" value="1" id="radioPrimary2" name="user_type">
                        <label for="radioPrimary2">
                            Admin Panel
                        </label>
                      </div>
                    </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control" disabled id="email" placeholder="Enter email">
                    {!! $errors->first('email', '<p class="error text-danger">:message</p>') !!}
                </div>
                  <div class="form-group">
                    <label for="mobile">Mobile No.</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('name') }}" id="mobile" placeholder="Enter mobile">
                    {!! $errors->first('mobile', '<p class="error text-danger">:message</p>') !!}
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="text" name="password" class="form-control" value="{{ old('password') }}" id="exampleInputPassword1" placeholder="Password">
                    {!! $errors->first('password', '<p class="error text-danger">:message</p>') !!}
                </div>
                  <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" value="{{ old('name') }}" rows="3" placeholder="Enter address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="pincode">Pincode </label>
                    <input name="pincode" type="text" class="form-control" value="{{ old('name') }}"  id="pincode" placeholder="Enter mobile">
                    {!! $errors->first('pincode', '<p class="error text-danger">:message</p>') !!}
                </div>
                  <div class="form-group">
                    <label for="state">State</label>
                    <select type="state" class="form-control" id="state" >
                    <option value="">Please Select </option>
                    @foreach(Config::get('constant.indianStates') as $key=>$val)
                    <option value="{{ $key }}">
                        {{ $val }}
                    </option>
                    @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <label for="gstin">GSTIN</label>
                    <input type="text" name="gstin" value="{{ old('name') }}" class="form-control" id="gstin" placeholder="Enter gstin">
                    {!! $errors->first('gstin', '<p class="error text-danger">:message</p>') !!}
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
                </div>
</div>
</div>
@endsection
