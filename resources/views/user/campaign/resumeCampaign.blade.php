@extends('user.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Campaign History</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Post</th>
										<th>Details</th>
										<th>Audience</th>
										<th>Placement</th>
										<th>Date</th>
										<th class="text-center">Campaign Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($campaignData as $campaign)
									@if(isset($campaign))
									<tr>
										<td>{{ $loop->iteration }}</td>

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
											Location : {{$campaign->audienceData->area}} , {{$campaign->audienceData->district}} , {{$campaign->audienceData->country}} <br>
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

										<td class="text-center"><a href="{{route('campaign-pause-submit',$campaign->id)}}"><span class="badge bg-warning text-white" style="padding: 10px;"> Pause <i class="bi bi-arrow-down"></i> </span></a></td>


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
										
									</tr>

									@endif
									@endforeach
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection