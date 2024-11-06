@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Balance Report Filter</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Balance Report Filter</h6>
                <hr/>

                <form class="row g-3" action="{{route('ad-account-balanace-top-up-report')}}" method="post">
                @csrf

                  <div class="col-12">
									<label class="form-label">User</label>
										<select class="single-select" name="user_id" onchange="getAdAccount(value)" required>
											<option selected disabled>Select User</option>
											@foreach($userData as $user)
										 	 @if(isset($user))
											<option value="{{$user->id}}">{{$user->name}} ({{$user->userID}}) </option>
											@endif
											@endforeach						
										</select>
								  </div>


								  <div class="col-12">
									<label class="form-label">Ad Account</label>
										<select class="single-select" name="ad_account_id" id="ad_account_id" required>
											<option selected disabled>Select Ad Account</option>
																	
										</select>
								  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Filter</button>
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

<script>
    function getAdAccount(value) {
  
        var userId = value;
        var url = "{{ route('get-ad-account-user-wise') }}";
        if (userId != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    userId: userId
                },
                success: function (data) {
                    //For Section...
                    $("#ad_account_id").empty();
                    $("#ad_account_id").append('<option value="" selected disabled>Select Ad Account </option>');

                    $.each(data.sectionData, function(key,value){
                        $("#ad_account_id").append('<option value="'+value.id+'">'+value.ad_name+'</option>');
                    });

                }

            });
        }
    };
  </script>