@extends('user.master')
@section('content')
	
	<h1>Tiktok Ad Account Rename</h1>

        <form action="{{route('tiktok-ad-account-rename-request-submit')}}" method="post">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">

                    	<div class="col">
                    		<div class="mb-3">
									<label class="form-label">Ad Account</label>
										<select class="single-select" name="ad_account_id" id="ad_account_id" required>
											<option selected disabled>Select Ad Account</option>
											@foreach($accountData as $account)
										 	 @if(isset($account))
											<option value="{{$account->id}}">{{$account->ad_name}} ({{$account->ad_account_number}})</option>
											@endif
											@endforeach				
										</select>
								  </div>
						</div>


                        <!-- <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Old Name</label>
                                <input type="text" class="form-control" name="old_name" required>
                            </div>
                        </div> -->

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">New Name </label>
                                <input type="text" class="form-control" name="new_name">
                            </div>
                        </div>
                        

                        <div class="col">
                            <button class="btn btn-primary px-4 float-end">Submit</button>
                        </div>
                    
                    </div>
                </div>
            </div>
            
        </form>

@endsection