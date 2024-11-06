@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Detailed Targeting Child List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('detailed-targeting-chiled.create')}}" class="btn btn-primary">Add Child</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Name</th>
										<th>Features</th>
										<th>Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($detailedTargetingChiledData as $detailedTargeting)
									@if(isset($detailedTargeting))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$detailedTargeting->name}}</td>
										<td>{{$detailedTargeting->detailedTargetingData->name}}</td>
										<td>{{$detailedTargeting->detailedTargetingData->type}}</td>
										
										<td>
				                            <div class="table-actions  fs-6">
											  
											  <form method="POST" action="{{ route('detailed-targeting-chiled.destroy', $detailedTargeting->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('detailed-targeting-chiled.edit',$detailedTargeting->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>

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