@extends('user.master')
@section('content')
	
	<h1>Tiktok Ad Account Replace</h1>
    <form action="{{route('google-ad-account-replace-submit')}}" method="post" enctype="multipart/form-data">
    @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Account Details</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="example" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ads Account</th>
                                        <th>Screenshot of Rejected Appeal</th>
                                        <th>Business Manager ID</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($accountData as $data)
                                  @if(isset($data))
                                  <tr>
                                      <td>{{$data->ad_name}} ({{$data->ad_account_number}})</td>

                                      <input type="hidden" value="{{$data->id}}" name="addMoreInputFields[{{ $loop->iteration }}][ad_account_id]">

                                      <td><input type="file" class="dropify" name="addMoreInputFields[{{ $loop->iteration }}][screenshot_of_rejected_appeal]" data-height="200" /></td>

                                       <td><input type="text" class="form-control" placeholder="Business Manager ID" name="addMoreInputFields[{{ $loop->iteration }}][business_manager_id]"></td>
                                  </tr>
                                  @endif
                                  @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg col-md col-sm">
                            <div class="blance_header_box rounded-1"></div>
                            <h4>
                                Confirmation</h4>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1 mt-3">
                        <div class="col ">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    I confirm the ad account I have selected is disabled and the appeal was rejected.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    I understand this replacement ad account will take the balance from the original.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    I understand I cannot re-use any flagged creatives, domains or assets on this account.
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