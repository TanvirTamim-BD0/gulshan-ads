@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Admin List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('admins.create')}}" class="btn btn-primary">Add Admin</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($adminData as $admin)
									@if(isset($admin))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$admin->name}}</td>
										<td>{{$admin->email}}</td>

										<td>
										@foreach ($admin->roles as $role)
										<span class="badge mt-2" style="background-color: #0d6efd; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">
											{{ $role->name }}
										</span>
										@endforeach
									</td>

										<td>
											@if(Auth::guard('admin')->user()->email == 'khaledhasanit@gmail.com')
				                            <div class="table-actions  fs-6">
											  
											  <form method="POST" action="{{ route('admins.destroy', $admin->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>
				                            

				                              <a href="{{route('admins.edit',$admin->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>

				                            </div>
				                            @else
				                            @endif
				                         </td>

									</tr>
									@endif
									@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection