@extends('admin.master')
@section('content')

<h1>Create Tiktok Ad Account</h1>

        <form action="{{route('google-ad-account-create-submit',$adAccount->id)}}" method="post">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">  

                        <div class="col">
                            <div class="mb-3">
                            <label class="form-label">User</label>
										<select class="single-select" name="user_id" required>
											<option selected disabled>Select User</option>
											@foreach($userData as $user)
										  	@if(isset($user))
											<option value="{{$user->id}}" {{ $user->id == $adAccount->user_id ? 'selected' : '' }} >{{$user->name}} ({{$user->userID}}) </option>
											@endif
											@endforeach						
										</select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Ad Account Number</label>
                                <input type="number" class="form-control" value="" name="ad_account_number" required>
                            </div>
                        </div>

                    	<div class="col">
                            <div class="mb-3">
                                <label class="form-label">Ad Account Name</label>
                                <input type="text" class="form-control" value="" name="ad_name" required>
                                @error('ad_account_number')
                                    <span class=text-danger>{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 1</label>
                                <input type="text" class="form-control" name="facebook_page_url_1" value="{{$adAccount->facebook_page_url_1}}" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 2 </label>
                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_2}}" name="facebook_page_url_2">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 3 </label>
                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_3}}" name="facebook_page_url_3">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 4 </label>
                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_4}}" name="facebook_page_url_4">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Facebook Page URL 5 </label>
                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_5}}" name="facebook_page_url_5">
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Website or Destination URL</label>
                                <input type="text" class="form-control" value="{{$adAccount->website_url}}" name="website_url">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Business Manager ID</label>
                                <input type="text" class="form-control" value="{{$adAccount->business_manager_id}}" name="business_manager_id" required>
                            </div>
                        </div>

                        <div class="col mt-4">
                            <button class="btn btn-primary px-4 ">Update</button>
                        </div>

                    
                    </div>
                </div>
            </div>
            
            
        </form>
   @endsection