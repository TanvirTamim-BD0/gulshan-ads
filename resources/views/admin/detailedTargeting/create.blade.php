@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Detailed Targeting</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Detailed Targeting</h6>
                <hr/>

                <form class="row g-3" action="{{route('detailed-targeting.store')}}" method="post" enctype="multipart/form-data">
                @csrf 

                  <div class="col">
                  <label class="form-label">Type</label>
                    <select class="single-select" name="type" required>
                      <option selected disabled>Select Type</option>
                      <option value="Demographics">Demographics</option>
                      <option value="Interests">Interests</option>
                      <option value="Behaviors">Behaviors</option>
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Detailed Targeting</button>
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