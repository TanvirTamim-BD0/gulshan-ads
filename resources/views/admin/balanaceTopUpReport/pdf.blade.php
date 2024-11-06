<style>
table, th, td {
  border: 1px solid;
}

table {
  width: 100%;
}
</style>

<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<h3>Balance TopUp History</h3>

							<h5>Name : {{$userData->name}}</h5>
							<h5>Email : {{$userData->email}}</h5><br>
							<table style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Date</th>
										<th>Old Balance</th>
										<th>Update Balance</th>
										<th>Recharge Amount</th>
										<!-- <th>BDT</th> -->
									</tr>


									@foreach($balanceData as $balanace)
									@if(isset($balanace))
									<tr>
										<td style="text-align: center;">{{ $loop->iteration }}</td>


										<td style="text-align: center;">{{$balanace->confirmed_date}}</td>

										<td style="text-align: center;">{{$balanace->userData->balance - $balanace->usd}}</td>

										<td style="text-align: center;">{{$balanace->userData->balance}}</td>

										<td style="text-align: center;">{{$balanace->usd}}</td>
										<!-- <td style="text-align: center;">{{$balanace->bdt}}</td> -->
									</tr>
									@endif
									@endforeach

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td style="text-align: center;"><b>Total : </b></td>
										<td style="text-align: center;"><b>{{$totalUsdBalanace}}</b></td>
										<!-- <td style="text-align: center;"><b>{{$totalBdtBalanace}}</b></td> -->
									</tr>
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>