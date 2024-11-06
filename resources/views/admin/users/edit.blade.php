@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Update User</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Update User</h6>
                <hr/>

                <form class="row g-3" action="{{route('users.update',$userData->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$userData->name}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" class="form-control" value="{{$userData->company_name}}">
                  </div>

                  <div class="col-12">
                    <label class="form-label">Whatsapp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{$userData->whatsapp_number}}">
                  </div>

                  <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$userData->email}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>


                  <div class="col-12">
                    <label class="form-label">Note</label>
                    <input type="text" name="note" class="form-control" value="{{$userData->note}}">
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update User</button>
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