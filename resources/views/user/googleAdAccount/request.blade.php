@extends('user.master')
@section('content')
	
	<h1>Google Ad Account Request</h1>

        <form action="{{route('google-ad-account-request-submit')}}" method="post">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Account Name</label>
                                <input type="text" class="form-control" name="account_name" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 1</label>
                                <input type="text" class="form-control" name="facebook_page_url_1" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 2 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_2">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 3 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_3">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 4 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_4">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 5 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_5">
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Website or Destination URL</label>
                                <input type="text" class="form-control" name="website_url" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Website or Destination URL 2</label>
                                <input type="text" class="form-control" name="website_url_2" required>
                            </div>
                        </div>

                        <div class="col mb-3">
                                        <h6>Select Add Account Type</h6>
                                        <select class="single-select" id="add_account_type" name="add_account_type" required>
                                          <option selected disabled>Select Add Account Type</option>
                                          <option value="Credit Line">Credit Line</option>
                                          <option value="Card">Card</option>
                                        </select>
                                    </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Business Manager ID</label>
                                <input type="text" class="form-control" name="business_manager_id" required>
                            </div>
                        </div>

                        <div class="col mb-3">
                                        <h6>Select TimeZone</h6>
                                        <select class="single-select" id="time_zone_name" name="time_zone_name" required>
                                          <option selected disabled>Select TimeZone</option>

                                          @foreach($timeZoneData as $timeZone)
                                          <option value="{{$timeZone->name}}"> {{$timeZone->name}} </option>  
                                          @endforeach

                                        </select>
                                    </div>

                        <div class="col mb-3">
                                        <h6>Select Business Type (optional)</h6>
                                        <select class="single-select" id="business_type" name="business_type">
                                          <option selected disabled>Select Business Type</option>

                                          @foreach($businessTypeData as $businessType)
                                          <option value="{{$businessType->name}}"> {{$businessType->name}} </option>  
                                          @endforeach

                                        </select>
                                    </div>
                    
                    </div>
                </div>
            </div>
            
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg col-md col-sm">
                            <div class="blance_header_box rounded-1"></div>
                            <h4>Confirmation</h4>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1 mt-3">
                        <div class="col ">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    I confirm payment has been made and has left my account.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    I understand the balance on my account can only be updated after the
                                    funds are received by Aurora.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    If making a transfer, I have checked the payment details and confirm I
                                    sent the funds to the correct bank details.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault4">
                                <label class="form-check-label" for="flexCheckDefault4">
                                    I have read and agree to the Terms and Conditions.
                                </label>
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