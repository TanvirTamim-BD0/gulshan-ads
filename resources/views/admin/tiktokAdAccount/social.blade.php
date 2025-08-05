@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Tiktok Ad Account List</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Ad Account</th>
										<th>Social</th>
									
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td>{{ $loop->iteration }}</td>

										<td>
											{{$adAccount->ad_name}} ({{$adAccount->ad_account_number}}) <br>
										</td>

										<td>
											Facebook : <a href="#" data-bs-toggle="modal"
	                                        data-bs-target="#details{{$adAccount->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye"></i> View</a>
	                                        <br>
	                                        Website : {{$adAccount->website_url}}

	                                        <br>
											<a href="#" style="text-decoration: underline;"  data-bs-toggle="modal"
	                                        data-bs-target="#social_media{{$adAccount->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-pencil-fill"></i></a> 
										</td>
										
									</tr>


									<!-- social_media Modal -->
									<div class="modal fade" id="social_media{{$adAccount->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
									        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									      </div>

									      <form action="{{route('tiktok-update-account-data',$adAccount->id)}}" method="post">
            							  @csrf
									      <div class="modal-body">
					                        
					                        	<div class="col">
						                            <div class="mb-3">
						                                <label class="form-label">Facebook Page URL 1</label>
						                                <input type="text" class="form-control" name="facebook_page_url_1" value="{{$adAccount->facebook_page_url_1}}" required>
						                            </div>
						                        </div>
						                        <div class="col">
						                            <div class="mb-3">
						                                <label class="form-label">Facebook Page URL 2 </label>
						                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_2}}" name="facebook_page_url_2">
						                            </div>
						                        </div>
						                        <div class="col">
						                            <div class="mb-3">
						                                <label class="form-label">Facebook Page URL 3 </label>
						                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_3}}" name="facebook_page_url_3">
						                            </div>
						                        </div>
						                        <div class="col">
						                            <div class="mb-3">
						                                <label class="form-label">Facebook Page URL 4 </label>
						                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_4}}" name="facebook_page_url_4">
						                            </div>
						                        </div>
						                        <div class="col">
						                            <div class="mb-2">
						                                <label class="form-label">Facebook Page URL 5 </label>
						                                <input type="text" class="form-control" value="{{$adAccount->facebook_page_url_5}}" name="facebook_page_url_5">
						                            </div>
						                        </div>

						                        <div class="col">
						                            <div class="mb-3">
						                                <label class="form-label">Website or Destination URL</label>
						                                <input type="text" class="form-control" value="{{$adAccount->website_url}}" name="website_url">
						                            </div>
						                        </div>

									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									        <button type="submit" class="btn btn-primary">Save changes</button>
									      </div>
									      </form>
									    </div>
									  </div>
									</div>


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


                                    @endif
									@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection