@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Update Location</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Update Location</h6>
                <hr/>

                <form class="row g-3" action="{{route('audience.update',$audienceData->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                  <div class="col-12">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control" value="{{$audienceData->area}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">District</label>
                    <input type="text" name="district" class="form-control" value="{{$audienceData->district}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="{{$audienceData->country}}" required>
                  </div>


                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update Location</button>
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