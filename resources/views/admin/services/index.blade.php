@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Services List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('service.create')}}" class="btn btn-primary">Add Service</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Image</th>
										<th>Category</th>
										<th>Name</th>
										<th>Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($serviceData as $service)
									@if(isset($service))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td class="text-center"><img src="{{ asset('/uploads/service_image/'.$service->image) }}" width="65" height="55" alt=""></td>
										<td>{{$service->serviceCategoryData->category_name}}</td>
										<td>{{$service->name}}</td>
										<td>{{$service->price}}</td>
										<td>
				                            <div class="table-actions  fs-6">

				                              <a href="{{route('service-view',$service->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye"></i> View</a><br>

				                              <form method="POST" action="{{ route('service.destroy', $service->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" id="show_confirm" title="delete" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('service.edit',$service->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>
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