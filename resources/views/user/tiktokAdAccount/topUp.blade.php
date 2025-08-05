@extends('user.master')
@section('content')
	
	<h1>Tiktok Ad Account Limit Request </h1>
    <form action="{{route('tiktok-ad-account-top-up-submit')}}" method="post">
    @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Balance Top-Ups</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="example" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        
                                        <th width="40%">Ads Account</th>
                                        <th class="text-center" width="30%">Note</th>
                                        <th class="text-center" width="30%">Diposit Amount $ </th>
                                        <th class="text-center" width="30%">Remaining Amount </th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($accountData as $data)
                                  @if(isset($data))
                                  <tr>
                                      <input type="hidden" value="{{$data->id}}" name="addMoreInputFields[{{ $loop->iteration }}][ad_account_id]">
                                      <td>{{$data->ad_name}} ({{$data->ad_account_number}})</td>
                                      <td><input type="text" name="addMoreInputFields[{{ $loop->iteration }}][note]" class="form-control" placeholder="Example : 0$ Theke 100$"></td>
                                      <td><input type="number" name="addMoreInputFields[{{ $loop->iteration }}][amount]" class="form-control" placeholder="100"></td>
                                      <td><input disabled class="form-control" value="{{$data->balance}}"></td>
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
                                <input class="form-check-input" type="checkbox" required value="" checked id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    I understand upon submission my account balance will be debited.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" required value="" checked id="flexCheckDefault2">
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