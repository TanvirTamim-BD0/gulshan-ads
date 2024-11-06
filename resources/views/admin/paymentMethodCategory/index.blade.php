@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Payment Method Category List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('payment-method-category.create')}}" class="btn btn-primary">Add Category</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Payment Type</th>
										<th>Payment Method</th>
										<th>Icon</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($paymentMethodCategoryData as $paymentMethod)
									@if(isset($paymentMethod))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>
											{{ $paymentMethod->payment_type }}
										</td>
										<td>{{$paymentMethod->payment_method}}</td>

										<td>
											@if($paymentMethod->icon)
	                                         <img src="{{ asset('/uploads/payment_method_icon/'.$paymentMethod->icon) }}" alt="" style="height: 50px; width: 100px;">
	                                    	</a>
	                                    	@else
	                                    	@endif
	                                    </td>

										
										<td>
				                            <div class="table-actions  fs-6">
											  
											  <form method="POST" action="{{ route('payment-method-category.destroy', $paymentMethod->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

				                              <a href="{{route('payment-method-category.edit',$paymentMethod->id)}}" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-square"></i> Edit</a>

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