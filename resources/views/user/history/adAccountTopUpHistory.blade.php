@extends('user.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account Top Up History</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Ad Account</th>
										<th>TopUp Amount</th>
										<th>Note</th>
										<th>Date</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountTopUpData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}})</td>
										<td>{{$adAccount->amount}}</td>
										<td>{{$adAccount->note}}</td>
										<td>{{ $adAccount->created_at }}</td>

										@if($adAccount->status == 'Complete')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Complete </span></td>
										@elseif($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
									

									</tr>


									@endif
									@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection