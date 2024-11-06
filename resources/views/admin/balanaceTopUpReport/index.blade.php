@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Balance Report</h6>
				<hr/>

				<form class="row g-3" action="{{route('pdf-account-balance-data')}}" method="post">
                @csrf

                <input type="hidden" name="user_id" value="{{$userID}}">

				<div style="margin-right: 20;">
					<button type="submit" class="btn btn-danger">PDF</button>
				</div>

				</form>
				<br>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Payment Method</th>
										<th>Date</th>
										<th>Old Balance</th>
										<th>Update Balance</th>
										<th>Recharge Amount</th>
										<!-- <th>BDT</th> -->
									</tr>
								</thead>
								<tbody>

									<h5>Name : {{$userData->name}}</h5>
									<h5>Email : {{$userData->email}}</h5><br>

									@foreach($balanceData as $balanace)
									@if(isset($balanace))
									<tr>
										<td>{{ $loop->iteration }}</td>

										@if($balanace->manual_payment ==  null)
										<td>{{$balanace->paymentMethodData->paymentMethodCategoryData->payment_method}} ({{$balanace->paymentMethodData->ac_number}}) </td>
										@else
										<td>{{$balanace->manual_payment}}</td>
										@endif

										<td>{{$balanace->confirmed_date}}</td>

										<td>{{$balanace->userData->balance - $balanace->usd}}</td>

										<td>{{$balanace->userData->balance}}</td>

										<td>{{$balanace->usd}}</td>
										<!-- <td>{{$balanace->bdt}}</td> -->
									</tr>
									@endif
									@endforeach

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>Total : </b></td>
										<td><b>{{$totalUsdBalanace}}</b></td>
										<!-- <td><b>{{$totalBdtBalanace}}</b></td> -->
									</tr>
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection