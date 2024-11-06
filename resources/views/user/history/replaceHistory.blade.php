@extends('user.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account Replace History</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Ad Account</th>
										<th>Business Manager Id</th>
										<th class="text-center">Screenshot Of Rejected Appeal</th>
										<th>Date</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>

									@foreach($replaceData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}})</td>
										<td>{{$adAccount->business_manager_id}}</td>
										<td class="text-center">
											<a data-bs-toggle="modal" data-bs-target="#imageShowReplace{{$adAccount->id}}" >
												<img src="{{ asset('/uploads/screenshot_of_rejected_appeal/'.$adAccount->screenshot_of_rejected_appeal) }}" width="65" height="55" alt="">
											</a>
										</td>
										<td>{{ $adAccount->created_at }}</td>

										@if($adAccount->status == 'Complete')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Complete </span></td>
										@elseif($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
										
							

									</tr>


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