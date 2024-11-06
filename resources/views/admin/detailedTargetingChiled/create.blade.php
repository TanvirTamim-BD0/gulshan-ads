@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Detailed Targeting Child</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Detailed Targeting Child</h6>
                <hr/>

                <form class="row g-3" action="{{route('detailed-targeting-chiled.store')}}" method="post" enctype="multipart/form-data">
                @csrf 

                  <div class="col-12">
                                <div class="mb-1">
                                <label class="form-label">Type</label>
                                <select class="single-select" onchange="getFeatures(value)" required>
                                    <option selected disabled>Select Type</option>
                                    <option value="Demographics">Demographics</option>
                                    <option value="Interests">Interests</option>
                                    <option value="Behaviors">Behaviors</option>                 
                                </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                <label class="form-label">Features</label>
                                <select class="single-select" name="detailed_targeting_id" id="features" required>
                                    <option selected disabled>Select Features</option>
                                                    
                                </select>
                                </div>
                            </div>

                            <div class="col-12">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" required>
                            </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Child</button>
                    </div>
                  </div>

                </form>

              </div>
              </div>
            </div>

		</div>
	</div>
	<!--end row-->

 <script>
  function getFeatures(value)
        {
            var features = value;

            var url = "{{ route('detailed-targeting-wise-data') }}";
            if (features != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        features: features
                    },
                    success: function (data) {
                        //For Section...
                        $("#features").empty();
                        $("#features").append('<option value="" selected disabled>Select Features </option>');

                        $.each(data, function(key,value){
                            $("#features").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });

                    }

                });
            }
        }

        </script>


@endsection