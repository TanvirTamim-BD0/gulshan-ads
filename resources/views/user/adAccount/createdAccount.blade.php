@extends('user.master')
@section('content')

    <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="mb-0">Ad Accounts Created</h5>
                                <hr />

                                @foreach($accountData as $data)
                                @if(isset($data))
                                <div class="card shadow-none border">
                                    <div class="card-header">
                                        <h6 class="mb-0">❖ {{$data->ad_name}} ({{$data->ad_account_number}})</h6>
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-3">
                                          <div class="col-12">
                                            <label class="form-label">Status</label> <br>

                                            @if($data->status == 'Created')
                                            <button type="button" class="btn btn-success text-white">{{$data->status}}</button>
                                            @elseif($data->status == 'Reject')
                                            <button type="button" class="btn btn-danger text-white">{{$data->status}}</button>
                                            @else
                                            <button type="button" class="btn btn-warning text-white">{{$data->status}}</button>
                                            @endif

                                            <a href="{{route('ad-account-edit',$data->id)}}" class="btn btn-primary">Edit</a>

                                          </div>

                                          <div class="col-12">
                                            <label class="form-label">Current Balance</label>
                                            <input type="text" class="form-control" value="{{$data->balance}}" disabled />
                                          </div>

                                          <div class="col-12">
                                            <label class="form-label">Daily Spending Limit</label>
                                            <input type="text" class="form-control" value="{{$data->daily_limit}}" disabled />
                                          </div>

                                          <div class="col-12">
                                            <label class="form-label">Facebook Page URL 1</label>
                                            <input type="text" class="form-control" value="{{$data->facebook_page_url_1}}" disabled />
                                          </div>

                                          @if(isset($data->facebook_page_url_2))
                                          <div class="col-6">
                                            <label class="form-label">Facebook Page URL 2</label>
                                            <input type="text" class="form-control" value="{{$data->facebook_page_url_2}}" disabled />
                                          </div>
                                          @endif

                                          @if(isset($data->facebook_page_url_3))
                                          <div class="col-6">
                                            <label class="form-label">Facebook Page URL 3</label>
                                            <input type="text" class="form-control" value="{{$data->facebook_page_url_2}}" disabled />
                                          </div>
                                          @endif

                                          @if(isset($data->facebook_page_url_4))
                                          <div class="col-6">
                                            <label class="form-label">Facebook Page URL 4</label>
                                            <input type="text" class="form-control" value="{{$data->facebook_page_url_4}}" disabled />
                                          </div>
                                          @endif

                                          @if(isset($data->facebook_page_url_5))
                                          <div class="col-6">
                                            <label class="form-label">Facebook Page URL 5</label>
                                            <input type="text" class="form-control" value="{{$data->facebook_page_url_5}}" disabled />
                                          </div>
                                          @endif

                                          <div class="col-12">
                                            <label class="form-label">Website or Destination URL</label>
                                            <input type="text" class="form-control" value="{{$data->website_url}}" disabled />
                                          </div>

                                           <div class="col-12">
                                            <label class="form-label">Website or Destination URL 2</label>
                                            <input type="text" class="form-control" value="{{$data->website_url_2}}" disabled />
                                          </div>

                                          <div class="col-12">
                                            <label class="form-label">Add Account Type</label>
                                            <input type="text" class="form-control" value="{{$data->add_account_type}}" disabled />
                                          </div>

                                          <div class="col-12">
                                            <label class="form-label">Business Manager ID</label>
                                            <input type="text" class="form-control" value="{{$data->business_manager_id}}" disabled />
                                          </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>

@endsection