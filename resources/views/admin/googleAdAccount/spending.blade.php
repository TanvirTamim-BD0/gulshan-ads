@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Google Ad Account Daily Spending</h6>
				<hr/>



				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Ad Account</th>
										<th>Daily Spending Limit BY meta</th>
										<th>Daily Spending User</th>
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
											{{$adAccount->daily_limit}} 
											<a href="#" style="text-decoration: underline; margin-left: 8px;"  data-bs-toggle="modal"
	                                        data-bs-target="#daily_limit{{$adAccount->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-pencil-fill"></i></a> 
										</td>
										
										
										<td>
											{{$adAccount->daily_spending_user}}
											<a href="#" style="text-decoration: underline; margin-left: 8px;"  data-bs-toggle="modal"
	                                        data-bs-target="#daily_spending_user{{$adAccount->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-pencil-fill"></i></a> 
										</td>
										
									</tr>

									<!-- daily_limit Modal -->
									<div class="modal fade" id="daily_limit{{$adAccount->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
									        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									      </div>

									      <form action="{{route('google-update-account-data',$adAccount->id)}}" method="post">
            							  @csrf
									      <div class="modal-body">
					                        <div class="col">
					                            <div class="mb-3">
					                                <label class="form-label">Daily Spending Limit BY meta</label>
					                                <input type="text" class="form-control" value="{{$adAccount->daily_limit}}" name="daily_limit" required>
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

									<!-- daily_spending_user Modal -->
									<div class="modal fade" id="daily_spending_user{{$adAccount->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
									        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									      </div>

									      <form action="{{route('google-update-account-data',$adAccount->id)}}" method="post">
            							  @csrf
									      <div class="modal-body">

					                        <div class="col">
					                            <div class="mb-3">
					                                <label class="form-label">Daily Spending User</label>
					                                <input type="text" class="form-control" value="{{$adAccount->daily_spending_user}}" name="daily_spending_user">
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


                                    @endif
									@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection