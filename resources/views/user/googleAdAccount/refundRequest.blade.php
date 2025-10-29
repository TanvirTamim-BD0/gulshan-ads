@extends('user.master')
@section('content')
    
    <h1>Google Ad Account Refund Request</h1>

        <form action="{{route('google-ad-account-refund-request-submit')}}" method="post">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">

                        <div class="col mb-3">
                                        <h6>Ad Account</h6>
                                        <select class="single-select" id="from_ad_account_id" name="ad_account_id" required>
                                          <option selected disabled>Select Ad Account</option>

                                          @foreach($accountData as $account)
                                          <option value="{{$account->id}}"> {{$account->ad_name}} ({{$account->ad_account_number}}) </option>  
                                          @endforeach 

                                        </select>
                                    </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" required>
                            </div>
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