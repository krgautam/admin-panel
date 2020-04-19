@extends('layouts.default')

@section('content')
<!-- /.col -->
<div class="col-md-12">
</div>
<div class="col-md-12">
          <!-- /.card -->

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">User Details</h3>
                <div class="card-tools">
                <a  href="{{ url('user/create') }}" class="btn btn-block btn-success btn-lg"><i class="fas fa-plus" ></i>Add User</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>User Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($data) && $data->count())
                        @foreach($data as $key => $value)
                    <tr>
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->mobile }}</td>
                      <td>{{ Config::get('constant.userType.' .$value->user_type) }}
                      </td>
                      <td>
                      <a href="{{ url('user/'.$value->id.'/edit') }}" title="Edit" class="text-muted">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="{{ url('user/'.$value->id.'/delete') }}" title="Delete" class="text-muted">
                        <i class="fas fa-trash"></i>
                      </a>
                      </td>
                    </tr>
                    @endforeach
        @else
            <tr>
                <td colspan="5">No Record Found.</td>
            </tr>
        @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          {!! $data->links() !!}
@endsection

