@extends('user.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account Disabled History</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Ad Account</th>
										<th>Date</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>

									@foreach($appealData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}})</td>
										<td>{{ $adAccount->created_at }}</td>
									
										
										@if($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Rejected </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Under Review </span></td>
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