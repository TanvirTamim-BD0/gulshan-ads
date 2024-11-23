@extends('user.master')
@section('content')
	
	<h1>Ad Account Try Hold Request</h1>

        <form action="{{route('ad-account-try-hold-submit')}}" method="post">
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
                                        <th></th>
                                        <th>Ads Account</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($accountData as $data)
                                    @if(isset($data))
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="{{$data->id}}" id="flexCheckDefault" name="ad_account_ids[{{$data->id}}]">
                                        </td>

                                        <td>{{$data->ad_name}} ({{$data->ad_account_number}})</td>
                                    </tr>
                                    @endif
                                    @endforeach

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
                                    I confirm the ad account I have selected is disabled and doesn’t have an active appeal.
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" checked required value="" id="flexCheckDefault2">
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