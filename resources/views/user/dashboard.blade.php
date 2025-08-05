@extends('user.master')
@section('content')

                    @php
                    $ads = App\Models\Ads::first();
                    @endphp
    
    <div class="row">
        <div class="col-md-3">
            @if(isset($ads->ads_3))
                <a href="{{$ads->ads_link_3}}" target="_blank"><embed src="{{ asset('/uploads/ads_3/'.$ads->ads_3) }}" height="180" width="270"></a>
                <h6 style="text-align: center;" >{{$ads->ads_text_3}}</h6>
            @endif
        </div>
        <div class="col-md-3">
            @if(isset($ads->ads_4))
                <a href="{{$ads->ads_link_4}}" target="_blank"><embed src="{{ asset('/uploads/ads_4/'.$ads->ads_4) }}" height="180"  width="270"></a>
                <h6 style="text-align: center;" >{{$ads->ads_text_4}}</h6>
            @endif
        </div>

        <div class="col-md-3">
            @if(isset($ads->ads_5))
                <a href="{{$ads->ads_link_5}}" target="_blank"><embed src="{{ asset('/uploads/ads_5/'.$ads->ads_5) }}" height="180"  width="270"></a>
                <h6 style="text-align: center;" >{{$ads->ads_text_5}}</h6>
            @endif
        </div>

        <div class="col-md-3">
            @if(isset($ads->ads_6))
                <a href="{{$ads->ads_link_6}}" target="_blank"><embed src="{{ asset('/uploads/ads_6/'.$ads->ads_6) }}" height="180"  width="270"></a>
                <h6 style="text-align: center;" >{{$ads->ads_text_6}}</h6>
            @endif
        </div>
    </div>

    <br>
    <marquee>{!! $ads->headline_text !!}</marquee>
    <br>

	
	<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1">Agency Ad Accounts</p>
                                        <h4 class="mb-0">{{$totalAdAccount}}</h4>
                                    </div>
                                    <div class="ms-auto widget-icon bg-primary text-white">
                                        <i class="bi bi-basket2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1">Balance</p>
                                        <h4 class="text-pink mb-0">${{$userData->balance}}</h4>
                                    </div>
                                    <div class="ms-auto  bg-success text-white">
                                        <a href="{{route('balance')}}" class="btn btn-success px-4 ">Balance TopUp + </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <!--end row-->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Balance Top-Ups</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="example" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th class="text-center">Method</th>
                                        <th >USD</th>
                                        <th >BDT</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($balanceTopUpData as $balanceTopUp)
                                  @if(isset($balanceTopUp))
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td> {{ $balanceTopUp->created_at->format('d M Y')}} </td>

                                      @if($balanceTopUp->manual_payment ==  null)
                                      <td>{{$balanceTopUp->paymentMethodData->paymentMethodCategoryData->payment_method}} ({{$balanceTopUp->paymentMethodData->ac_number}}) </td>
                                      @else
                                        <td>{{$balanceTopUp->manual_payment}}</td>
                                      @endif

                                      <td>${{$balanceTopUp->usd}}</td>
                                      <td>{{$balanceTopUp->bdt}}</td>

                                
                                      <td>
                                        @if($balanceTopUp->status == 'Confirmed')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$balanceTopUp->status}} {{ \Carbon\Carbon::parse($balanceTopUp->confirmed_date) }} </span>
                                        @elseif($balanceTopUp->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details1{{$balanceTopUp->id}}" style="padding: 10px;">{{$balanceTopUp->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$balanceTopUp->status}}</span>
                                        @endif
                                      </td>
                                  </tr>

                                    <!--Rejected Text Modal -->
                                     <div class="modal fade" id="usd_details1{{$balanceTopUp->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$balanceTopUp->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

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
                          <h5 class="mb-0">Ad Account Top-Ups</h5>
                      </div>
                      <div class="table-responsive mt-3">
                          <table id="example1" class="table align-middle mb-0">
                              <thead class="table-light">
                                  <tr>
                                      <th>SL</th>
                                      <th>Ad Account Name</th>
                                      <th>Date</th>
                                      <th>Top-Up Amount</th>
                                      <th>Note</th>
                                      <th class="text-center">Status</th>
                                  </tr>
                              </thead>
                              <tbody>

                                @foreach($adAccountTopUpData as $adAccountTopUp)
                                @if(isset($adAccountTopUp))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$adAccountTopUp->adAccountData->ad_name}} ({{$adAccountTopUp->adAccountData->ad_account_number}})</td>
                                    <td> {{ $adAccountTopUp->created_at->format('d M Y')}} </td>
                                    <td>{{$adAccountTopUp->amount}}</td>
                                    <td>{{$adAccountTopUp->note}}</td>
                                    
                                    <td>
                                        @if($adAccountTopUp->status == 'Complete')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$adAccountTopUp->status}} {{ \Carbon\Carbon::parse($adAccountTopUp->confirmed_date) }} </span>
                                        @elseif($adAccountTopUp->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details2{{$adAccountTopUp->id}}" style="padding: 10px;">{{$adAccountTopUp->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$adAccountTopUp->status}}</span>
                                        @endif
                                      </td>
                                </tr>


                                    <!--Rejected Text Modal -->
                                    <div class="modal fade" id="usd_details2{{$adAccountTopUp->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$adAccountTopUp->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

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
                        <h5 class="mb-0">Agency Ad Accounts Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example5" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Facebook Page1</th>
                                    <th>Website</th>
                                    <th>Business Manager Id</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($accountRequestData as $account)
                              @if(isset($account))
                              <tr>  
                                
                                  <td>{{$account->facebook_page_url_1}}</td>
                                  <td>{{$account->website_url}}</td>
                                  <td>{{$account->business_manager_id}}</td>
                                  
                                  <td>
                                        @if($account->status == 'Created')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$account->status}} {{ \Carbon\Carbon::parse($account->confirmed_date)->diffForHumans() }}</span>
                                        @elseif($account->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details3{{$account->id}}" style="padding: 10px;">{{$account->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$account->status}}</span>
                                        @endif
                                      </td>
                              </tr>


                                    <!--Rejected Text Modal -->
                                    <div class="modal fade" id="usd_details3{{$account->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$account->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

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
                        <h5 class="mb-0">Ad Accounts Trasnfer Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example6" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ad Account</th>
                                    <th>Business Manager Id</th>
                                    <th>Transfer Or Share</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($accountTransferData as $account)
                              @if(isset($account))
                              <tr>  
                                
                                    <td>{{$account->adAccountData->ad_name ?? ''}}</td>
                                    <td>{{$account->business_manager_id}}</td>
                                    <td>{{$account->transfer_or_share}}</td>
                                  
                                  <td>
                                        @if($account->status == 'Complete')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$account->status}} {{ \Carbon\Carbon::parse($account->confirmed_date) }}</span>
                                        @elseif($account->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details4{{$account->id}}" style="padding: 10px;">{{$account->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$account->status}}</span>
                                        @endif
                                      </td>
                              </tr>


                                    <!--Rejected Text Modal -->
                                    <div class="modal fade" id="usd_details4{{$account->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$account->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

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
                        <h5 class="mb-0">Ad Accounts Disabled Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example7" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ad Account</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($accountAppealData as $account)
                              @if(isset($account))
                              <tr>  
                                
                                  <td>{{$account->adAccountData->ad_name}}</td>
                                  
                                  <td>
                                        
                                        @if($account->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details5{{$account->id}}" style="padding: 10px;">Rejected</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">Under Review </span>
                                        @endif
                                      </td>
                              </tr>


                                    <!--Rejected Text Modal -->
                                    <div class="modal fade" id="usd_details5{{$account->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$account->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

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
                        <h5 class="mb-0">Ad Accounts Replace Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example8" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ad Account</th>
                                    <th>Business Manager Id</th>
                                    <th class="text-center">Screenshot Of Rejected Appeal</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($accountReplaceData as $account)
                              @if(isset($account))
                              <tr>  
                                
                                  <td>{{$account->adAccountData->ad_name}}</td>
                                  <td>{{$account->business_manager_id}}</td>
                                  <td class="text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#imageShowReplace{{$account->id}}" ><img src="{{ asset('/uploads/screenshot_of_rejected_appeal/'.$account->screenshot_of_rejected_appeal) }}" width="65" height="55" alt="">
                                    </a>
                                    </td>
                                  
                                  <td>
                                        @if($account->status == 'Complete')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$account->status}} {{ \Carbon\Carbon::parse($account->confirmed_date) }}</span>
                                        @elseif($account->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details6{{$account->id}}" style="padding: 10px;">{{$account->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$account->status}}</span>
                                        @endif
                                      </td>
                              </tr>


                                    <!--Rejected Text Modal -->
                                    <div class="modal fade" id="usd_details6{{$account->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$account->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 


                                    <!-- Image Show -->
                                    <div class="modal fade" id="imageShowReplace{{$account->id}}" tabindex="-1"
                                        aria-labelledby="imageShowReplace" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                
                                                <div class="modal-body text-center">
                                                    
                                                    <img src="{{ asset('/uploads/screenshot_of_rejected_appeal/'.$account->screenshot_of_rejected_appeal) }}" alt="" style="height: 250px; width: 250px;">

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


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
                        <h5 class="mb-0">Ad Accounts BM Link Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example8" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                   <th>BM Name</th>
                                   <th>Reply</th>
                                   <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($adAccountBMLinkData as $account)
                              @if(isset($account))
                              <tr>  
                                  <td>{{$account->bm_name}}</td>
                                  <td>{{$account->reply}}</td>

                                  <td>
                                        @if($account->status == 'Complete')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$account->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$account->status}}</span>
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

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Ad Accounts Refund Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example8" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                   <th>Ad Account</th>
                                    <th>Amount</th>
                                   <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($refundData as $account)
                              @if(isset($account))
                              <tr>  
                                  <td>{{$account->adAccountData->ad_name}}</td>
                                  <td>{{$account->amount}}</td>

                                  <td>
                                        @if($account->status == 'Complete')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$account->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$account->status}}</span>
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


            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Service Buy Request</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example9" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Service</th>
                                    <th>Service Amount</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($buyServiceData as $buyService)
                              @if(isset($buyService))
                              <tr>  
                                
                                  <td>{{$buyService->serviceData->name}}</td>
                                  <td>{{$buyService->serviceData->price}}</td>
                                  
                                  <td>
                                        @if($buyService->status == 'Confirmed')
                                        <span class="badge bg-success text-white w-100" style="padding: 10px;">{{$buyService->status}} {{ \Carbon\Carbon::parse($buyService->confirmed_date) }}</span>
                                        @elseif($buyService->status == 'Reject')
                                        <span class="badge bg-danger text-white w-100" data-bs-toggle="modal"
                                        data-bs-target="#usd_details7{{$buyService->id}}" style="padding: 10px;">{{$buyService->status}}</span>
                                        @else
                                        <span class="badge bg-warning text-white w-100" style="padding: 10px;">{{$buyService->status}}</span>
                                        @endif
                                      </td>
                              </tr>


                                    <!--Rejected Text Modal -->
                                    <div class="modal fade" id="usd_details7{{$buyService->id}}" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Rejected Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                                <textarea class="form-control" cols="20" rows="5" disabled>{{$buyService->rejected_text}}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                              @endif
                              @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



@endsection