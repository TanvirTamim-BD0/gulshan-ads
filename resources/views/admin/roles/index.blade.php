@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">User List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('role.create')}}" class="btn btn-primary">Add Role</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Name</th>
										<th>Permissions</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($roles as $role)
									@if(isset($role))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$role->name}}</td>
										<td>
									        @foreach ($role->permissions as $perm)
									            <span class="badge mt-2" style="background-color: #0d6efd; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">
									                {{ $perm->name }}
									            </span>
									        @endforeach
										</td>
										<td>
				                            <div class="table-actions  fs-6">
											  
											  <form method="POST" action="{{ route('role.destroy', $role->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('role.edit',$role->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>

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

@endsection