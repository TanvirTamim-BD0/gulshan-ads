@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Admin</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Admin</h6>
                <hr/>

                <form class="row g-3" action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" required>
                  </div>

                  <div class="col-12">
                  <label class="form-label">Role</label>
                    <select class="single-select" name="roles" required>
                      <option selected disabled>Select Role</option>
                      @foreach($roles as $role)
                      @if(isset($role))
                      <option value="{{$role->name}}">{{ Str::title($role->name) }}</option>
                      @endif
                      @endforeach           
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Admin</button>
                    </div>
                  </div>

                </form>

              </div>
              </div>
            </div>

		</div>
	</div>
	<!--end row-->


@endsection