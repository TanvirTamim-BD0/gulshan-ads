@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Guides List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('guide.create')}}" class="btn btn-primary">Add Guides</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Image</th>
										<th>Title</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($guidesData as $guides)
									@if(isset($guides))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td class="text-center"><img src="{{ asset('/uploads/guides_image/'.$guides->image) }}" width="65" height="55" alt=""></td>
										<td>{{$guides->title}}</td>
										<td>
				                            <div class="table-actions  fs-6">
											  
											  <a href="{{route('guide-view',$guides->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye"></i> View</a><br>

											  <form method="POST" action="{{ route('guide.destroy', $guides->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('guide.edit',$guides->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>

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