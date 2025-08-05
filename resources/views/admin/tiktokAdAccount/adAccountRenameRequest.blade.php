@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Tiktok Ad Account Rename Request</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<div align="right">
								<a href="{{route('tiktok-ad-account-rename-status-filter','Complete')}}" class="btn btn-success">Complete</a>

								<a href="{{route('tiktok-ad-account-rename-status-filter','Reject')}}" class="btn btn-danger">Reject</a>

								<a href="{{route('tiktok-ad-account-rename-status-filter','Pending')}}" class="btn btn-warning">Pending</a>
							</div><br>

							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th>SL</th>
										<th>User</th>
										<th>Ad Account</th>
										<th>New Name</th>
										<th>Complete Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountRenameData as $adAccountRename)
									@if(isset($adAccountRename))
									<tr>
										<td>
											<a href="{{route('tiktok-ad-account-rename-request-delete',$adAccountRename->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i></a>
										</td>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccountRename->userData->name}} ({{$adAccountRename->userData->userID}})</td>
										<td>{{$adAccountRename->adAccountData->ad_name}} ({{$adAccountRename->adAccountData->ad_account_number}})</td>
										<td>{{$adAccountRename->new_name}}</td>
										<td>{{$adAccountRename->confirmed_date}}</td>
										
										@if($adAccountRename->status == 'Complete')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Complete </span></td>
										@elseif($adAccountRename->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
										
										<td>
				                            <div class="table-actions  fs-6">
				                            @if($adAccountRename->status == 'Complete')
				                        	@else
				                            
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#completeData{{$adAccountRename->id}}"  class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Complete"><i class="bi bi-check-circle"></i> Complete</a><br>

				                            @endif
 
				                            @if($adAccountRename->status == 'Reject')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$adAccountRename->id}}"  class="btn btn-sm btn-danger" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Reject</a><br>
	                                        @endif
	                                        
	                                        <br>
				                            </div>

				                         </td>

									</tr>


									<!-- Rejected Text -->
                                    <div class="modal fade" id="completeData{{$adAccountRename->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('tiktok-ad-account-rename-request-complete',$adAccountRename->id)}}" method="post">
                                                @csrf
                                               	<input type="hidden" name="ad_account_rename_id" value="{{$adAccountRename->id}}"> 
                                               	<div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Update Account Name</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            <input type="text" class="form-control" name="ad_name" value="{{$adAccountRename->old_name}}">
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Update</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

									<!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$adAccountRename->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('tiktok-ad-account-rename-request-reject',$adAccountRename->id)}}" method="post">
                                                @csrf
                                               	<input type="hidden" name="ad_account_rename_id" value="{{$adAccountRename->id}}"> 
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