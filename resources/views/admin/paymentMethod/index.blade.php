@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Payment Method List</h6>
				<hr/>

				<div align="right">
					<a href="{{route('payment-method.create')}}" class="btn btn-primary">Add Payment Method</a>
				</div><br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Payment Mathod</th>
										<th>Ac Number</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($paymentMethodData as $paymentMethod)
									@if(isset($paymentMethod))
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{$paymentMethod->paymentMethodCategoryData->payment_method}}</td>
										<td>{{$paymentMethod->ac_number}}</td>
										
										<td>
				                            <div class="table-actions  fs-6">
											  
											  <form method="POST" action="{{ route('payment-method.destroy', $paymentMethod->id) }}"
                                               >
                                              @csrf
                                              @method('delete')
				                          
				                              <button type="submit" title="delete" id="show_confirm" class="bg-transparent border-0 text-danger" style="margin-left: -8px;"> <span><i class="bi bi-trash"></i> Delete</span>
                                           	  </button> <br>
				                              </form>

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