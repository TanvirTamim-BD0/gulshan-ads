@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account BM Link Request</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th>SL</th>
										<th>User</th>
										<th>BM Name</th>
										<th>Reply</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountBMLinkData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>
											<a href="{{route('ad-account-bm-link-request-delete',$adAccount->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-archive-fill"></i></a>
										</td>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>

										<td>{{$adAccount->bm_name}}</td>
										<td>{{$adAccount->reply}}</td>

										@if($adAccount->status == 'Complete')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Complete </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
										
										<td>
				                            <div class="table-actions  fs-6">
				                            @if($adAccount->status == 'Complete')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$adAccount->id}}"  class="btn btn-sm btn-primary" style="margin-top: 5px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reply"><i class="bi bi-reply"></i> Reply</a><br>
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
                                                <form action="{{route('ad-account-bm-link-reply',$adAccount->id)}}" method="post">
                                                @csrf	
                                               	<div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Reply</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            	<textarea class="form-control" cols="20" rows="5" name="reply">
                                                            		
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