@extends('user.master')
@section('content')
	
	<h1>Google Ad Account BM share/remove </h1>
    <form action="{{route('google-ad-account-transfer-submit')}}" method="post">
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
                                        <th>Ad Account</th>
                                        <th>Transfer or Share</th>
                                        <th>Business Manager ID</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($accountData as $data)
                                  @if(isset($data))
                                  <tr>
                                      <td>{{$data->ad_name}} ({{$data->ad_account_number}})</td>

                                      <input type="hidden" value="{{$data->id}}" name="addMoreInputFields[{{ $loop->iteration }}][ad_account_id]">

                                      <td>
                                        <div class="col">
                                            <div class="form-check mt-2">
                                                <label class="form-check-label" for="transfer_or_share1{{$data->id}}">
                                                    Remove from old BM and shared new BM.
                                                    
                                                </label>
                                                <input class="form-check-input" type="radio" name="addMoreInputFields[{{ $loop->iteration }}][transfer_or_share]" id="transfer_or_share1{{$data->id}}" value="Remove from old BM and shared new BM.">
                                                    
                                            </div>

                                            <div class="form-check mt-2">
                                                <label class="form-check-label" for="transfer_or_share2{{$data->id}}">
                                                    keep old with and share with also New BM.
                                                </label>
                                                <input class="form-check-input" type="radio" name="addMoreInputFields[{{ $loop->iteration }}][transfer_or_share]" id="transfer_or_share2{{$data->id}}" value="keep old with and share with also New BM.">
                                            </div>
                                       </div>
                                      </td>
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
                                    I confirm the Business Manager ID I have entered is correct.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" required checked id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
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