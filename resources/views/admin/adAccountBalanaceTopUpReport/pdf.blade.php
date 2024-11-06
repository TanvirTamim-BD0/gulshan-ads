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
							<h3>Ad Account Balance TopUp History</h3>
							<h5>Name : {{$userData->name}}</h5>
							<h5>Account Name : {{$accountData->ad_name}}</h5><br>
							<table style="width:100%">
								<thead>
									<tr>
										<th>SL</th>
										<th>Date</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									@foreach($balanceData as $balanace)
									@if(isset($balanace))
									<tr>
										<td style="text-align: center;">{{ $loop->iteration }}</td>
										<td style="text-align: center;">{{$balanace->confirmed_date}}</td>
										<td style="text-align: center;">{{$balanace->amount}}</td>
									</tr>
									@endif
									@endforeach

									<tr>
										<td></td>
										<td></td>
										<td style="text-align: center;"><b>Total : </b> <b>{{$totalBalanace}}</b></td>
									</tr>
									
								</tbody>
								
							</table>
						</div>
					</div>
				</div>