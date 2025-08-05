@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Tiktok Ad Account Limit Request</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<div align="right">
								<a href="{{route('tiktok-ad-account-topup-status-filter','Complete')}}" class="btn btn-success">Complete</a>

								<a href="{{route('tiktok-ad-account-topup-status-filter','Reject')}}" class="btn btn-danger">Reject</a>

								<a href="{{route('tiktok-ad-account-topup-status-filter','Pending')}}" class="btn btn-warning">Pending</a>
							</div><br>
							
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th>SL</th>
										<th>User</th>
										<th>Ad Account</th>
										<th>Exist Balance</th>
										<th>TopUp Amount</th>
										<th>Note</th>
										<th>Complete Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountTopUpData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>
											<a href="{{route('tiktok-ad-account-top-up-request-delete',$adAccount->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i></a>

										</td>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>
										<td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}})</td>
										<td>{{$adAccount->userData->balance}}</td>
										<td>{{$adAccount->amount}}</td>
										<td>{{$adAccount->note}}</td>
										<td>{{$adAccount->confirmed_date}}</td>

										@if($adAccount->status == 'Complete')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Complete </span></td>
										@elseif($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
										
										<td>
				                            <div class="table-actions  fs-6">
				                            @if($adAccount->status == 'Complete')
				                        	@else
				                            <a href="{{route('tiktok-ad-account-top-up-request-complete',$adAccount->id)}}" class="btn btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Complete"><i class="bi bi-check-circle"></i> Complete</a><br>
				                            @endif
 
				                            @if($adAccount->status == 'Reject')
				                            @else
				                            <a href="{{route('tiktok-ad-account-top-up-request-reject',$adAccount->id)}}" style="margin-top: 5px;"  class="btn btn-sm btn-danger"><i class="bi bi-file-earmark-x"></i> Reject</a><br>
	                                        @endif

	                                        <a href="{{route('tiktok-ad-account-top-up-request-edit',$adAccount->id)}}" style="margin-top: 5px;" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a><br>

	                                        <br>

	                                        
				                            </div>
				                         </td>

									</tr>


							

									@endif
									@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection