@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Edit Tiktok Ad Account Limit Request</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Edit Ad Account TopUp Balance  - {{$adAccountTopUpData->adAccountData->ad_name}}({{$adAccountTopUpData->adAccountData->ad_account_number}}) </h6>
                <hr/>

                <form class="row g-3" action="{{route('tiktok-ad-account-top-up-request-update',$adAccountTopUpData->id)}}" method="post">
                @csrf

                  <div class="col-12">
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" value="{{$adAccountTopUpData->amount}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Note</label>
                    <input type="text" class="form-control" name="note" value="{{$adAccountTopUpData->note}}">
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update</button>
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