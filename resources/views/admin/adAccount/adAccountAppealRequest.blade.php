@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account Disabled Request</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<div align="right">
								<!-- <a href="{{route('ad-account-appeal-status-filter','Complete')}}" class="btn btn-success">Complete</a> -->

								<a href="{{route('ad-account-appeal-status-filter','Reject')}}" class="btn btn-danger">Rejected</a>

								<a href="{{route('ad-account-appeal-status-filter','Pending')}}" class="btn btn-warning">Under Review</a>
							</div><br>
							
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th>SL</th>
										<th>User</th>
										<th>Ad Account</th>
										<th>Confirmed Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountAppealData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>
											<a href="{{route('ad-account-appeal-request-delete',$adAccount->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i></a>	
										</td>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>
										<td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}})</td>
										<td>{{$adAccount->confirmed_date}}</td>
									
										
										@if($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Rejected </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Under review </span></td>
										@endif
										
										<td>
				                            <div class="table-actions  fs-6">
				                            
 
				                            @if($adAccount->status == 'Reject')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$adAccount->id}}"  class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Rejected</a><br>
	                                        @endif
	                                        
	                                        <br>

				                            </div>

				                         </td>

									</tr>

									<!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$adAccount->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('ad-account-appeal-request-reject',$adAccount->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="ad_account_appeal_id" value="{{$adAccount->id}}">
                                               	<div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Text</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            	<textarea class="form-control" cols="20" rows="5" name="rejected_text">
                                                            		
                                                            	</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Submit</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

									@endif
									@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection