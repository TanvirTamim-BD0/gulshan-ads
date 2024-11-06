@extends('user.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Balance TopUp History</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Payment Method</th>
										<th>USD</th>
										<th>BDT</th>
										<th>Date</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($balanceTopUpData as $balanace)
									@if(isset($balanace))
									<tr>
										<td>{{ $loop->iteration }}</td>

										@if($balanace->manual_payment ==  null)
										<td>{{$balanace->paymentMethodData->paymentMethodCategoryData->payment_method}} ({{$balanace->paymentMethodData->ac_number}}) </td>
										@else
                                        <td>{{$balanace->manual_payment}}</td>
                                      	@endif

										<td>${{$balanace->usd}}</td>
										<td>{{$balanace->bdt}}</td>
										<td>{{ $balanace->created_at }}</td>

										@if($balanace->status == 'Confirmed')
										<td class="text-center"><span class="badge bg-success text-white" style="padding: 10px;"> Confirmed </span></td>
										@elseif($balanace->status == 'Reject')
										<td class="text-center"><span class="badge bg-danger text-white" style="padding: 10px;"> Reject </span></td>
										@else
										<td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
										@endif
									
									</tr>

									@endif
									@endforeach
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection