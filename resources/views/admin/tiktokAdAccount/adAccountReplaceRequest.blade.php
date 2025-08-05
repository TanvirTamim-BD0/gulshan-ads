@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Tiktok Ad Account Replace Request</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<div align="right">
								<a href="{{route('tiktok-ad-account-replace-status-filter','Complete')}}" class="btn btn-success">Complete</a>

								<a href="{{route('tiktok-ad-account-replace-status-filter','Reject')}}" class="btn btn-danger">Reject</a>

								<a href="{{route('tiktok-ad-account-replace-status-filter','Pending')}}" class="btn btn-warning">Pending</a>
							</div><br>
							
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>User</th>
										<th>Ad Account</th>
										<th>Business Manager Id</th>
										<th class="text-center">Screenshot Of Rejected Appeal</th>
										<th>Confirmed Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountReplaceData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>
										<td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}})</td>
										<td>{{$adAccount->business_manager_id}}</td>
										<td class="text-center">
											<a data-bs-toggle="modal" data-bs-target="#imageShowReplace{{$adAccount->id}}" >
												<img src="{{ asset('/uploads/screenshot_of_rejected_appeal/'.$adAccount->screenshot_of_rejected_appeal) }}" width="65" height="55" alt="">
											</a>
										</td>
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
				                            <a href="{{route('tiktok-ad-account-replace-request-complete',$adAccount->id)}}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Complete"><i class="bi bi-check-circle"></i> Complete</a><br>
				                            @endif
 
				                            @if($adAccount->status == 'Reject')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$adAccount->id}}"  class="btn btn-sm btn-danger" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Reject</a><br>
	                                        @endif
	                                        
	                                        <a href="{{route('tiktok-ad-account-raplace-request-delete',$adAccount->id)}}" class="btn btn-sm btn-danger" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i> Delete</a><br>
				                            </div>

				                         </td>

									</tr>

									<!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$adAccount->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('tiktok-ad-account-replace-request-reject',$adAccount->id)}}" method="post">
                                                @csrf
                                               	<input type="hidden" name="ad_account_replace_id" value="{{$adAccount->id}}"> 
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
                                    <div class="modal fade" id="imageShowReplace{{$adAccount->id}}" tabindex="-1"
                                        aria-labelledby="imageShowReplace" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                
                                                <div class="modal-body text-center">
                                                    
                                                    <img src="{{ asset('/uploads/screenshot_of_rejected_appeal/'.$adAccount->screenshot_of_rejected_appeal) }}" alt="" style="height: 250px; width: 250px;">

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