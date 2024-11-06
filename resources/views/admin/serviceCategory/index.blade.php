@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Service Category List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('service-category.create')}}" class="btn btn-primary">Add Service Category</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($serviceCategoryData as $service)
									@if(isset($service))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$service->category_name}}</td>
										<td>
				                            <div class="table-actions  fs-6">

				                            
				                              <form method="POST" action="{{ route('service-category.destroy', $service->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" id="show_confirm" title="delete" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('service-category.edit',$service->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>
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