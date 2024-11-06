@extends('admin.master')
@section('content')
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>

    <script>$.fn.poshytip={defaults:null}</script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>

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
										<th>Business Manager Id</th>
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
	                                        <a href=""
											class="update_bmI" data-name="business_manager_id" data-type="text" data-pk="{{ $adAccount->id }}" data-title="Business Manager Id" >{{$adAccount->business_manager_id}}</a> 

										</td>
									</tr>

                                    @endif
									@endforeach

								</tbody>
								
							</table>
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
    $('.update_bmI').editable({
           url: "{{ route('update-account-bmi') }}",
           type: 'text',
           pk: 1,
           name: 'ad_name',
           title: 'Account Name'
    });

</script>

@endsection