@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add User</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add User</h6>
                <hr/>

                <form class="row g-3" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" class="form-control">
                  </div>

                  <div class="col-12">
                    <label class="form-label">Whatsapp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control">
                  </div>

                  <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control">
                  </div>

                  <div class="col-12">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Note</label>
                    <input type="text" name="note" class="form-control">
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add User</button>
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