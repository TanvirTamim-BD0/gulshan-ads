@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account Request</h6>
				<hr/>

				<div align="right">
					<a href="{{route('create-ad-account')}}" class="btn btn-primary">Create Ad Account</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<div align="right">
								<a href="{{route('ad-account-request-status-filter','Created')}}" class="btn btn-success">Created</a>

								<a href="{{route('ad-account-request-status-filter','Reject')}}" class="btn btn-danger">Reject</a>

								<a href="{{route('ad-account-request-status-filter','Pending')}}" class="btn btn-warning">Pending</a>
							</div><br>
							
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>User</th>
										<th>Account Name</th>
										<th>Facebook Page</th>
										<th>Website</th>
										<th>Business Manager Id</th>
										<th>Ad Account Type</th>
										<th>Time Zone</th>
										<th>Business Type</th>
										<th>Request Time</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									
									@foreach($adAccountRequestData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>
										<td>{{$adAccount->account_name}}</td>
										<td>
											<a href="#" data-bs-toggle="modal"
	                                        data-bs-target="#details{{$adAccount->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye"></i> View</a>
										</td>
										<td>Website 1 : {{$adAccount->website_url}} <br>
											Website 2 : {{$adAccount->website_url_2}}</td>
										<td>{{$adAccount->business_manager_id}}</td>
										<td>{{$adAccount->add_account_type}}</td>
										<td>{{$adAccount->time_zone_name}}</td>
										<td>{{$adAccount->business_type}}</td>
										<td>{{$adAccount->created_at}}</td>

										@if($adAccount->status == 'Created')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Created </span></td>
										@elseif($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
										
										<td>
				                            <div class="table-actions  fs-6">
				                            <a href="{{route('ad-account-create',$adAccount->id)}}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Account"><i class="bi bi-pencil-square"></i> Create Account </a><br>

				                            @if($adAccount->status == 'Reject')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$adAccount->id}}"  class="btn btn-sm btn-danger" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Reject</a>
	                                        @endif

				                            </div>
				                            

				                         </td>
									</tr>

									<!-- details show -->
									<div class="modal fade" id="details{{$adAccount->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Facebook Page</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            <p><strong>Facebook page 1:</strong> {{$adAccount->facebook_page_url_1}} </p>
                                                            <p><strong>Facebook page 2:</strong>  {{$adAccount->facebook_page_url_2}} </p>
                                                            <p><strong>Facebook page 3:</strong>  {{$adAccount->facebook_page_url_3}} </p>
                                                            <p><strong>Facebook page 4:</strong> {{$adAccount->facebook_page_url_4}} </p>
                                                            <p><strong>Facebook page 5:</strong>  {{$adAccount->facebook_page_url_5}} </p>

                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$adAccount->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('ad-account-request-reject')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="ad_account_request_id" value="{{$adAccount->id}}">
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