@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Balance Report</h6>
				<hr/>

				<form class="row g-3" action="{{route('pdf-ad-account-data')}}" method="post">
                @csrf

                <input type="hidden" name="user_id" value="{{$userID}}">
                <input type="hidden" name="ad_account_id" value="{{$adAccountId}}">

				<div style="margin-right: 20;">
					<button type="submit" class="btn btn-danger">PDF</button>
				</div>

				</form>
				<br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="" class="table table-striped table-bordered" style="width:100%">
								<h5>Name : {{$userData->name}}</h5>
								<h5>Account Name : {{$accountData->ad_name}}</h5><br>

								<thead>
									<tr>
										<th>SL</th>
										<th>Date</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									@foreach($balanceData as $balanace)
									@if(isset($balanace))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$balanace->confirmed_date}}</td>
										<td>{{$balanace->amount}}</td>
									</tr>
									@endif
									@endforeach

									<tr>
										<td></td>
										<td></td>
										<td><b>Total : </b> <b>{{$totalBalanace}}</b></td>
									</tr>
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection