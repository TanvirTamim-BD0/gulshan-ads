@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Campaign Request</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>User</th>
										<th>Post</th>
										<th>Details</th>
										<th>Audience</th>
										<th>Placement</th>
										<th>Date</th>
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($campaignData as $campaign)
									@if(isset($campaign))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$campaign->userData->name}} ({{$campaign->userData->userID}})</td>
										<td>
											Post Title/Link : {{$campaign->post_link}} <br>

											@if($campaign->post_image)
											Post Image : <img src="{{ asset('/uploads/post_image/'.$campaign->post_image) }}" width="65" height="55" alt="">
											@endif
										</td>

										<td>
											Type : {{$campaign->campaign_type}} <br>
											Budget : {{$campaign->budget}} <br>
											Days : {{$campaign->days}} <br>
											Editor Access  : {{$campaign->editor_access}} <br>
										</td>

										<td>
											Location : <a href="#" style="text-decoration: underline;"  data-bs-toggle="modal"
	                                        data-bs-target="#locationView{{$campaign->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye"></i> View</a> <br>

											Detailed Targeting : {{$campaign->detailed_targeting_type}} , {{$campaign->detailed_targeting_name}} <br>
											Detailed Targeting Child : 
											<a href="#" style="text-decoration: underline;"  data-bs-toggle="modal"
	                                        data-bs-target="#childView{{$campaign->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye"></i> View</a> 
											
											 <br>
											Gender : {{$campaign->gender}} <br>
											Age Start-End : {{$campaign->age_start}} - {{$campaign->age_end}} <br>
										</td>

										<td>
											Facebook : {{$campaign->facebook}} <br>
											Instagram : {{$campaign->instagram}} <br>
											Messenger : {{$campaign->messenger}} <br>
											Whatsapp : {{$campaign->whatsapp}} <br>
										</td>

										<td>{{ $campaign->created_at }}</td>


										@if($campaign->status == 'Confirmed')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Confirmed </span></td>
										@elseif($campaign->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif


										<td>
				                            @if($campaign->status == 'Confirmed')
				                        	@else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#confirmedData{{$campaign->id}}"  class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-check-circle"></i> Confirmed</a><br>
				                            @endif
 
				                            @if($campaign->status == 'Reject')
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$campaign->id}}"  class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Reject</a><br>
	                                        @endif
				                         </td>
									
									</tr>

									<!-- location view -->
									<div class="modal fade" id="locationView{{$campaign->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Location</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                	@php
			                                            $locationDatas = App\Models\Campaign::getlocationData($campaign->id);    
			                                        @endphp

                                                    @foreach ($locationDatas as $locationData)
													<span class="badge mt-2" style="background-color: #0d6efd; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">
													{{$locationData->area}} ,{{$locationData->district}} 
												    </span>
													@endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

									<!-- child show -->
									<div class="modal fade" id="childView{{$campaign->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Detailed Targeting Child</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                	@php
			                                            $getChiledData = App\Models\Campaign::getChiledData($campaign->id);      
			                                        @endphp

                                                    @foreach ($getChiledData as $chiledData)
													<span class="badge mt-2" style="background-color: #0d6efd; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">
													{{ $chiledData->name }}
												    </span>
													@endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<!-- Confirmed Text -->
                                    <div class="modal fade" id="confirmedData{{$campaign->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('campaign-request-confirmed',$campaign->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="service_buy_id" value="{{$campaign->id}}">
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
                                    <div class="modal fade" id="rejectedData{{$campaign->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('campaign-request-reject',$campaign->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="service_buy_id" value="{{$campaign->id}}">
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