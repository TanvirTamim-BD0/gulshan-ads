@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Recharge Request</h6>
				<hr/>

				<div align="right">
					<a href="{{route('add-balance')}}" class="btn btn-primary">Add Balance</a>
				</div><br>



				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<div align="right">
								<a href="{{route('balanace-request-status-filter','Confirmed')}}" class="btn btn-success">Confirmed</a>

								<a href="{{route('balanace-request-status-filter','Reject')}}" class="btn btn-danger">Reject</a>

								<a href="{{route('balanace-request-status-filter','Pending')}}" class="btn btn-warning">Pending</a>
							</div><br>

							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<!-- <th></th> -->
										<th>SL</th>
										<th>User</th>
										<th>Payment Method</th>
										<th>USD</th>
										<th class="text-center">Confirmation Screenshot</th>
										<th>Request Time</th>
										<th>Confirmed Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($balanaceData as $balanace)
									@if(isset($balanace))
									<tr>
										<!-- <td>
											<a href="{{route('balance-delete',$balanace->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i></a>

										</td> -->
										<td>{{ $loop->iteration }}</td>
										<td>{{$balanace->userData->name}} ({{$balanace->userData->userID}})</td>

										@if($balanace->manual_payment ==  null)
										<td>{{$balanace->paymentMethodData->paymentMethodCategoryData->payment_method}} ({{$balanace->paymentMethodData->ac_number}}) </td>
										@else
										<td>{{$balanace->manual_payment}}</td>
										@endif
										

										<td>${{$balanace->usd}}</td>

										@if($balanace->manual_payment ==  null)
										<td class="text-center">
											<a href="javascript:;" data-bs-toggle="modal"
	                                        	data-bs-target="#imageShow{{$balanace->id}}"  class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Rejected">
	                                         <img src="{{ asset('/uploads/confirmation_screenshot/'.$balanace->confirmation_screenshot) }}" alt="" style="height: 70px; width: 80px;">
	                                    	</a>
	                                    </td>
	                                    @else
	                                    <td></td>
	                                    @endif

	                                    <td>{{ $balanace->created_at  }} </td>
	                                    <td>{{ $balanace->confirmed_date  }} </td>

										@if($balanace->status == 'Confirmed')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Confirmed </span></td>
										@elseif($balanace->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
										
										<td>
										
				                            <div class="table-actions  fs-6">

				                              @if($balanace->status == 'Confirmed')
				                        	  @else
				                              <a href="{{route('balance-confirmed',$balanace->id)}}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Confirmed"><i class="bi bi-check-circle"></i> Confirmed</a><br>
				                              @endif

				                              @if($balanace->status == 'Reject')
				                              @else
				                              <a href="javascript:;" data-bs-toggle="modal"
	                                        	data-bs-target="#rejectedData{{$balanace->id}}"  class="btn btn-sm btn-danger" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Rejected"><i class="bi bi-file-earmark-x"></i> Reject</a><br>
	                                          @endif

	                                          

	                                          <a href="{{route('balance-edit',$balanace->id)}}" class="btn btn-sm btn-primary" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a><br>

	                                          <br>

				                            </div>
				                        
				                        </td>

									</tr>

									<!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$balanace->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('balanace-request-rejected')}}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$balanace->id}}" name="balance_id">
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

                                  	<!-- Image Show -->
                                    <div class="modal fade" id="imageShow{{$balanace->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                
                                                <div class="modal-body text-center">
                                                    
                                                    <img src="{{ asset('/uploads/confirmation_screenshot/'.$balanace->confirmation_screenshot) }}" alt="" style="height: 250px; width: 250px;">

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

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