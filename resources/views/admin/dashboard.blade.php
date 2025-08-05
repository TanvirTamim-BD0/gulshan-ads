@extends('admin.master')
@section('content')

<!-- <div class="row">
            <div class="col-5">
                <div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Today Dollar Rate</h6>
                <hr/>

                <form class="row g-3" action="{{route('dollar-rate-update',$rate->id)}}" method="post">
                @csrf
                  <div class="col-12">
                    <label class="form-label">Rate</label>
                    <input type="number" class="form-control" name="rate" value="{{$rate->rate}}" required>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>

                </form>

              </div>
              </div>
            </div>
            </div>
        </div> -->
        
        
    <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Balance TopUp Request</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Method</th>
                                        <th>USD</th>
                                        <th>BDT</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($balanceTopUpData as $balanceTopUp)
                                  @if(isset($balanceTopUp))
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td> {{ $balanceTopUp->created_at->format('d M Y')}} </td>
                                      <td>{{$balanceTopUp->userData->name}} ({{$balanceTopUp->userData->userID}})</td>

                                      @if($balanceTopUp->manual_payment ==  null)
                                      <td>{{$balanceTopUp->paymentMethodData->paymentMethodCategoryData->payment_method}} ({{$balanceTopUp->paymentMethodData->ac_number}}) </td>
                                      @else
                                        <td>{{$balanceTopUp->manual_payment}}</td>
                                      @endif

                                      <td>${{$balanceTopUp->usd}}</td>
                                      <td>{{$balanceTopUp->bdt}}</td>

                                
                                      <td>
                                        
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$balanceTopUp->status}}</span>
                                      </td>
                                  </tr>

                                  @endif
                                  @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Ad Account Request</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Website</th>
                                        <th>Business Manager Id</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($adAccountRequestData as $adAccount)
                                    @if(isset($adAccount))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>
                                        <td>{{$adAccount->website_url}}</td>
                                        <td>{{$adAccount->business_manager_id}}</td>

                                        <td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
                                        
                                    </tr>

                                    @endif
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Ad Account Balance TopUp Request</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Ad Account</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($adAccountTopUpData as $adAccount)
                                    @if(isset($adAccount))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$adAccount->userData->name}} ({{$adAccount->userData->userID}})</td>
                                        <td>{{$adAccount->adAccountData->ad_name}} ({{$adAccount->adAccountData->ad_account_number}}) </td>
                                        <td>{{$adAccount->amount}}</td>
                                        <td>{{$adAccount->note}}</td>

                                        <td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
                                    </tr>

                                    @endif
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Ad Account Fund Transfer Request</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>From Ad Account</th>
                                        <th>Transfer Ad Account</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($adAccountFoundTransferData as $adAccountFoundTransfer)
                                    @if(isset($adAccountFoundTransfer))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$adAccountFoundTransfer->userData->name}} ({{$adAccountFoundTransfer->userData->userID}})</td>

                                        <td>{{$adAccountFoundTransfer->fromAdAccountData->ad_name}} ({{$adAccountFoundTransfer->fromAdAccountData->ad_account_number}})</td>

                                        <td>{{$adAccountFoundTransfer->transferAdAccountData->ad_name}} ({{$adAccountFoundTransfer->transferAdAccountData->ad_account_number}})</td>
                                        <td>{{$adAccountFoundTransfer->transfer_amount}}</td>

                                        <td class="text-center"><span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span></td>
                                    </tr>

                                    @endif
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Service Buy Request</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Service</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($buyServiceData as $buyService)
                                    @if(isset($buyService))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$buyService->userData->name}} ({{$buyService->userData->userID}})</td>
                                        <td>{{$buyService->serviceData->name}}</td>

                                        <td class="text-center">
                                            <span class="badge bg-warning text-white" style="padding: 10px;"> Pending </span>
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