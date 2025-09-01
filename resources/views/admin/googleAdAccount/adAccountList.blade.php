@extends('admin.master')
@section('content')


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>

    <script>$.fn.poshytip={defaults:null}</script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>

    <h6 class="mb-0 text-uppercase">Google Ad Account List</h6>
				<hr/>

			
				<div align="right">
					<a href="{{route('google-create-ad-account')}}" class="btn btn-primary">Create Ad Account</a>
				</div>
				<br>


				<div class="card">
					<div class="card-body">
						<div class="table-responsive">

							 <div align="right">
								<!-- <a href="{{route('ad-account-status-filter','Created')}}" class="btn btn-success">Created</a> -->

								<a href="{{route('google-ad-account-status-filter','Reject')}}" class="btn btn-info text-white">Reject Filter</a>

								<!-- <a href="{{route('ad-account-status-filter','Pending')}}" class="btn btn-warning">Pending</a> -->
							</div><br>

							<form action="{{route('google-ad-account-multiple-reject')}}" method="post">
                                @csrf

							<button type="submit" class="btn btn-danger mb-2">Multiple Reject</button>

							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th>SL</th>
										<th>User</th>
										<th>Ad Account</th>
										<th>Remaining Amount</th>
										<!-- <th>Monthly Billing Date</th> -->
										<th class="text-center">Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adAccountData as $adAccount)
									@if(isset($adAccount))
									<tr>
										<td><input type="checkbox" name="adAccountIds[{{$adAccount->id}}]" value="{{$adAccount->id}}"></td>

										<td>{{ $loop->iteration }}</td>
										<td>
											{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})
										</td>

										<td>
											
											<a href=""
											class="update_name" data-name="ad_name" data-type="text" data-pk="{{ $adAccount->id }}" data-title="Account Name" >{{$adAccount->ad_name}}</a> ({{$adAccount->ad_account_number}})  

										</td>
										
										<td>
											
											<a href=""  class="update_balance" data-name="balance" data-type="number" data-pk="{{ $adAccount->id }}" data-title="Balance">{{$adAccount->balance}}</a> 
										</td>
	
										 @if($adAccount->status == 'Created')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Active </span></td>
										@elseif($adAccount->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@endif 
										
									  <td>
				                            <div class="table-actions  fs-6">
				                             <a href="{{route('google-edit-ad-account',$adAccount->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Account"><i class="bi bi-pencil-square"></i> Edit </a><br> 
				                            @if($adAccount->status == 'Reject')
				                            <a href="{{route('google-ad-account-status-complete',$adAccount->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Active"><i class="bi bi-check-circle"></i> Active</a><br>
				                            @else
				                            <a href="javascript:;" data-bs-toggle="modal"
	                                        data-bs-target="#rejectedData{{$adAccount->id}}"  class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject"><i class="bi bi-file-earmark-x"></i> Reject</a>
	                                        @endif

				                            </div>
				                         </td> 
				                        
									</tr>


									 <!-- Rejected Text -->
                                    <div class="modal fade" id="rejectedData{{$adAccount->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('google-ad-account-status-reject')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="ad_account_id" value="{{$adAccount->id}}">
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
						</form>
						</div>
					</div>
				</div>


<script type="text/javascript">

    $.fn.editable.defaults.mode = 'inline';
    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }

    }); 
    $('.update_name').editable({
           url: "{{ route('google-update-account-data') }}",
           type: 'text',
           pk: 1,
           name: 'ad_name',
           title: 'Account Name'
    });

    $('.update_balance').editable({
           url: "{{ route('google-update-ad-account-balance') }}",
           type: 'number',
           pk: 1,
           name: 'balance',
           title: 'Balance'
    });

</script>


@endsection