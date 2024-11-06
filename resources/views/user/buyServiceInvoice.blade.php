@extends('user.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Service Buy Report</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Invoice No</th>
										<th>Service</th>
										<th>Amount</th>
										<th>Buying Date</th>
										<th>Confirmed Text</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>

									@foreach($buyServiceData as $buyService)
									@if(isset($buyService))
									<tr>
										<td>{{ $buyService->invoice_no }}</td>
										<td>{{$buyService->serviceData->name}}</td>
										<td>{{$buyService->serviceData->price}}</td>
										<td>{{ $buyService->created_at->toDateString() }}</td>
										<td>{{$buyService->confirmed_text}}</td>

										<td class="text-center">
										@if($buyService->status == 'Pending')
										<span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span>
										@else
										<span class="badge bg-success text-white" style="padding: 10px;"> Paid </span>
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