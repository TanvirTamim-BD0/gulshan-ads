@extends('admin.master')
@section('content')
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>

    <script>$.fn.poshytip={defaults:null}</script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
    
    <h6 class="mb-0 text-uppercase">User List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('users.create')}}" class="btn btn-primary">Add User</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th>SL</th>
										<th>ID</th>
										<th>Name</th>
										<th>Company Name</th>
										<th>Doller Rate</th>
										<th>Whatsapp Number</th>
										<th>Email</th>
										<th>Balance</th>
										<th>Note</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($userData as $user)
									@if(isset($user))
									<tr>
										<td>
											<form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i></span>
                                           	  </button> 
				                              </form>
										</td>
										<td>{{ $loop->iteration }}</td>
										<td>{{$user->userID}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->company_name}}</td>

										<td>
	                                        <a href=""
											class="update_doller_rate" data-name="doller_rate" data-type="text" data-pk="{{ $user->id }}" data-title="Doller Rate" >{{$user->doller_rate}}</a> 

										</td>

										<td>{{$user->whatsapp_number}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->balance}}</td>
										<td>{{$user->note}}</td>
										<td>
				                            <div class="table-actions  fs-6">
											  
											  

				                              <a href="{{route('users.edit',$user->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>

				                            </div>
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
    $('.update_doller_rate').editable({
           url: "{{ route('update-doller-rate') }}",
           type: 'text',
           pk: 1,
           name: 'doller_rate',
           title: 'Doller Rate'
    });

</script>

s
@endsection