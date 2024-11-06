@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">TimeZone List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('timeZone.create')}}" class="btn btn-primary">Add TimeZone</a>
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

									@foreach($timeZoneData as $timeZone)
									@if(isset($timeZone))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$timeZone->name}}</td>
										<td>
				                            <div class="table-actions  fs-6">

				                            
				                              <form method="POST" action="{{ route('timeZone.destroy', $timeZone->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" id="show_confirm" title="delete" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('timeZone.edit',$timeZone->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>
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