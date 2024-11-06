@extends('user.master')
@section('content')
	
	<h1>Create Campaign</h1>

        <form action="{{route('campaign-submit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Post Title / Post Link</label>
                                <input type="text" class="form-control" name="post_link" required>
                            </div>
                        </div>

                        <div class="col"> 
                        	<div class="mb-3">   
			                    <label class="form-label">Post Image (Optional)</label>  
			                    <input class="form-control" type="file" name="post_image" onchange="readURL(this);" />
                                <br>

                                <img id="blah" />
			                </div>
		                  </div>
                        
                        <div class="col">
                                <div class="mb-3">
                                <label class="form-label">Campaign Type</label>
                                <select class="single-select" name="campaign_type" required>
                                    <option selected disabled>Select Campaign Type</option>
                                    <option value="Promote">Promote</option>
                                    <option value="Message">Message</option>
                                    <option value="Engagement">Engagement</option> 
                                    <option value="Call">Call</option>    
                                    <option value="Lead Form">Lead Form</option>                 
                                </select>
                                </div>
                            </div>


                        <h5>Audience</h5>
                        <h6>Location</h6>
                        <hr>
                        <div class="row">

                            <div class="col-4">
                                <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select class="single-select" id="country" onchange="getDistrict(value)" required>
                                    <option selected disabled>Select Country</option>
                                    @foreach($audienceData as $audience)
                                    @if(isset($audience))
                                    <option value="{{$audience->country}}">{{$audience->country}}</option>
                                    @endif
                                    @endforeach                     
                                </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                <label class="form-label">District</label>
                                <select class="single-select" name="district" id="district" onchange="getArea(value)" required>
                                    <option selected disabled>Select District</option>
                                                         
                                </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                <label class="form-label">Area</label>
                                <select class="single-select" name="location_id[]" id="area" required multiple>
                                    <option disabled>Select Area</option>
                                                         
                                </select>
                                </div>
                            </div>

                        </div>


                        <h6>Detailed Targeting</h6>
                        <hr>
                        <div class="row">

                            <div class="col-6">
                                <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select class="single-select" name="detailed_targeting_type" onchange="getFeatures(value)" required>
                                    <option selected disabled>Select Type</option>
                                    <option value="Demographics">Demographics</option>
                                    <option value="Interests">Interests</option>
                                    <option value="Behaviors">Behaviors</option>                 
                                </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                <label class="form-label">Select Features</label>
                                <select class="single-select" name="detailed_targeting_name" onchange="getChiled(value)" id="features" required>
                                    <option selected disabled>Select Features</option>
                                                    
                                </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                <label class="form-label">Select Child</label>
                                <select class="single-select" name="detailed_targeting_chiled[]" id="chiled" required multiple>
                                    <option disabled>Select Chiled</option>
                                                    
                                </select>
                                </div>
                            </div>
                            


                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="Male" checked>
                                              <label class="form-check-label" for="exampleRadios1">
                                                Male
                                              </label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="Female">
                                              <label class="form-check-label" for="exampleRadios2">
                                                Female
                                              </label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gender" id="exampleRadios3" value="Both">
                                              <label class="form-check-label" for="exampleRadios3">
                                                Both
                                              </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-4">
                                <div class="mb-5">
                                    <label class="form-label">Age Start</label>
                                    <input type="number" class="form-control" name="age_start">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-5">
                                    <label class="form-label">Age End</label>
                                    <input type="number" class="form-control" name="age_end">
                                </div>
                            </div>

                        </div>


                     <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Total Budget</label>
                                <input type="number" class="form-control" name="budget">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Days</label>
                                <input type="number" class="form-control" name="days">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" style="margin-right: 10px;"> Facebook</label>
                                <input type="hidden" name="facebook" value="No">
                                <input type="checkbox" class="form-check-input" name="facebook" value="Yes">
                                
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" style="margin-right: 10px;"> Instagram</label>
                                <input type="hidden" name="instagram" value="No">
                                <input type="checkbox" class="form-check-input" name="instagram" value="Yes">
                                
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" style="margin-right: 10px;"> Messenger</label>
                                <input type="hidden" name="messenger" value="No">
                                <input type="checkbox" class="form-check-input" name="messenger" value="Yes">
                                
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" style="margin-right: 10px;"> Whatsapp</label>
                                <input type="hidden" name="whatsapp" value="No">
                                <input type="checkbox" class="form-check-input" name="whatsapp" value="Yes">
                                
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">

                        <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Please sending editor access on your page</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="editor_access" id="exampled1" value="Yes" checked>
                                              <label class="form-check-label" for="exampled1">
                                                Yes
                                              </label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="editor_access" id="exampled12" value="No">
                                              <label class="form-check-label" for="exampled12">
                                                No
                                              </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Editor 1 
                                    <a href="#" style="margin-left: 2px;"  data-bs-toggle="modal"
                                            data-bs-target="#someText" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i style="color: black;" class="bi bi-info-square-fill"></i></a>  
                                </label>
                                <input type="text" class="form-control" value="{{$editorAccess->editor_1}}" disabled>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Editor 2
                                    <a href="#" style="margin-left: 2px;"  data-bs-toggle="modal"
                                            data-bs-target="#someText" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i style="color: black;" class="bi bi-info-square-fill"></i></a>
                                </label>
                                <input type="text" class="form-control" value="{{$editorAccess->editor_2}}" disabled>
                            </div>
                        </div>
                    </div>

                        <div class="col">
                            <button class="btn btn-primary px-4 float-end">Submit</button>
                        </div>
                    
                    </div>
                </div>
            </div>
            
        
        </form>


        <div class="modal fade" id="someText" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>

                                          <div class="modal-body">
                                            <p>{{$editorAccess->note}}</p>

                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>


        <script>

           function getDistrict(value){
            var country = value;

            var url = "{{ route('country-wise-district-data') }}";
            if (country != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        country: country
                    },
                    success: function (data) {
                        //For Section...
                        $("#district").empty();
                        $("#district").append('<option value="" selected disabled>Select District </option>');

                        $.each(data, function(key,value){
                            $("#district").append('<option value="'+value.district+'">'+value.district+'</option>');
                        });

                    }

                });
            }
        }


        function getArea(value)
        {
            var district = value;

            var url = "{{ route('district-wise-area-data') }}";
            if (district != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        district: district
                    },
                    success: function (data) {
                        //For Section...
                        $("#area").empty();
                        $("#area").append('<option value="" disabled>Select Area </option>');

                        $.each(data, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.area+'</option>');
                        });

                    }

                });
            }
        }


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
                            $("#features").append('<option value="'+value.name+'">'+value.name+'</option>');
                        });

                    }

                });
            }
        }


        function getChiled(value){
            var chiled = value;

            var url = "{{ route('detailed-targeting-wise-chiled-data') }}";
            if (chiled != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        chiled: chiled
                    },
                    success: function (data) {
                        //For Section...
                        $("#chiled").empty();
                        $("#chiled").append('<option value="" disabled>Select Child </option>');

                        $.each(data, function(key,value){
                            $("#chiled").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });

                    }

                });
            }
        }

        </script>


        <script>
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#blah').attr('src', e.target.result).width(150).height(150);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }
    </script>



@endsection

