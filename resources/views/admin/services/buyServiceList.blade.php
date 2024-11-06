@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Service Buy Request</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>User</th>
										<th>Service</th>
										<th>Exist Balance</th>
										<th>Service Amount</th>
										<th>Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($buyServiceData as $buyService)
									@if(isset($buyService))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$buyService->userData->name}} ({{$buyService->userData->userID}})</td>
										<td>{{$buyService->serviceData->name}}</td>
										<td>{{$buyService->userData->balance}}</td>
										<td>{{$buyService->serviceData->price}}</td>
										<td>{{$buyService->created_at}}</td>

										<td class="text-center">
											@if($buyService->status == 'Confirmed')
											<span class="badge bg-success text-white" style="padding: 10px;"> Confirmed </span>
											@elseif($buyService->status == 'Reject')
											<span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span>
											@else
											<span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span>
											@endif
										</td>
										
										<td>
				                            @if($buyService->status == 'Confirmed')
				                        	@else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#confirmedData{{$buyService->id}}"  class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-check-circle"></i> Confirmed</a><br>
				                            @endif
 
				                            @if($buyService->status == 'Reject')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$buyService->id}}"  class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Reject</a><br>
	                                        @endif

	                                        <a href="{{route('service-buy-request-delete',$buyService->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i> Delete</a><br>
	                                        
				                         </td>

									</tr>

									<!-- Confirmed Text -->
                                    <div class="modal fade" id="confirmedData{{$buyService->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('service-buy-request-confirmed',$buyService->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="service_buy_id" value="{{$buyService->id}}">
                                               	<div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Text</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            	<textarea class="form-control" cols="20" rows="5" name="confirmed_text">
                                                            		
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

									<!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$buyService->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('service-buy-request-reject',$buyService->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="service_buy_id" value="{{$buyService->id}}">
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