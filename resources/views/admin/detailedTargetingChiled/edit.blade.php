@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Update Detailed Targeting Child</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Update Detailed Targeting Child</h6>
                <hr/>

                <form class="row g-3" action="{{route('detailed-targeting-chiled.update',$detailedTargetingChiledData->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                 
                            <div class="col-12">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" value="{{$detailedTargetingChiledData->name}}" required>
                            </div>


                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update Child</button>
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