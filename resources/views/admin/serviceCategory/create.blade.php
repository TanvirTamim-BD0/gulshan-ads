@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Service Category</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Service Category</h6>
                <hr/>

                <form class="row g-3" action="{{route('service-category.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" required>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Service Category</button>
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