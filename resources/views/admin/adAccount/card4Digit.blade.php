@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Ad Account List</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Ad Account</th>
										<th>Card 4 Digit</th>
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
											{{$adAccount->card_4_digit}}
											<a href="#" style="text-decoration: underline; margin-left: 8px;"  data-bs-toggle="modal"
	                                        data-bs-target="#card_4_digit{{$adAccount->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-pencil-fill"></i></a> 
										</td>

									</tr>

									<!-- card_4_digit Modal -->
									<div class="modal fade" id="card_4_digit{{$adAccount->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
									        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									      </div>

									      <form action="{{route('update-account-data',$adAccount->id)}}" method="post">
            							  @csrf
									      <div class="modal-body">
					                        <div class="col">
					                            <div class="mb-3">
					                                <label class="form-label">Card 4 Digit</label>
					                                <input type="text" class="form-control" value="{{$adAccount->card_4_digit}}" name="card_4_digit">
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