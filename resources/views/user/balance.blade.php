@extends('user.master')
@section('content')
	
	<h2>Account Balance</h2>
    <h4>{{$userData->note}}</h4>
            <div class="row row-cols-1 row-cols-lg-4 row-cols-xl-4">
                        <div class="col">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1">Balance</p>
                                        <h4 class="text-pink mb-0">${{$userData->balance}}</h4>
                                    </div>
                                    <div class="ms-auto widget-icon bg-success text-white">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
            <!--end row-->

            <div class="row">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="card-title">
                                <h5 class="mb-0">Payment Method Details</h5>
                            </div>
                            <hr />
                            <div class="row row-cols-auto g-3">

                                
                                <div class="col">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                                        data-bs-target="#bank_details">Bank Details</button>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#mobile_banking_details">Mobile Banking Details</button>
                                    
                                    <!-- bank_details -->
                                    <div class="modal fade" id="bank_details" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Bank Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            
                                                            @foreach($paymentMethodBank as $paymentMethod)
                                                            @if(isset($paymentMethod))
                                                            <h6><b>Payment Method : </b> {{$paymentMethod->paymentMethodCategoryData->payment_method}}</h6>
                                                            <h6><b>Account Number : </b> {{$paymentMethod->ac_number}} </h6> <br>
                                                            @endif
                                                            @endforeach
                                                             
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


                                    <!-- bank_details -->
                                    <div class="modal fade" id="mobile_banking_details" tabindex="-1"
                                        aria-labelledby="usd_detailsLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="usd_detailsLabel">Mobile Banking Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">

                                                            @foreach($paymentMethodMobile as $paymentMethod)
                                                            @if(isset($paymentMethod))
                                                            <h6><b>Payment Method : </b> {{$paymentMethod->paymentMethodCategoryData->payment_method}}</h6>
                                                            <h6><b>Account Number : {{$paymentMethod->ac_number}}</b> </h6> <br>
                                                            @endif
                                                            @endforeach

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
                                </div>


                                
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header py-3 bg-transparent">
                            <h5 class="mb-0">Balance Top-Up Form</h5>
                        </div>
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <form action="{{route('balance-top-up')}}" class="row g-3 balance-top-up-form" method="post" enctype="multipart/form-data">
                                @csrf

                                    <div class="col-12">
                                        <h6>Select Payment Type</h6>
                                        <select class="single-select" id="paymentType" onchange="getPaymentMethod(value)" required>
                                          <option selected disabled>Select Payment Type</option>
                                          <option value="Bank">Bank</option>  
                                          <option value="Mobile Banking">Mobile Banking</option>         
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <h6>Select Payment Method</h6>
                                        <select class="single-select" id="payment_category_id" required onchange="getPaymentAccount(value)">
                                          <option selected disabled>Select Payment Method</option>
                                                    
                                        </select>

                                        @error('payment_method_id')
                                        <span class=text-danger>{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <h6>Select Bank Account</h6>
                                        <select class="single-select" name="payment_method_id" id="payment_method_id" required>
                                          <option selected disabled>Select Bank Account</option>
                                                    
                                        </select>

                                        @error('payment_method_id')
                                        <span class=text-danger>{{$message}}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-12">
                                        <h6>USD</h6>
                                        <input type="text" class="form-control" id="usd" name="usd" placeholder="USD" onchange="getBDTPrice()" required />

                                        @error('usd')
                                        <span class=text-danger>{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- <div class="col-12">
                                        <h6>BDT</h6>
                                        <input type="text" class="form-control" id="bdt" name="bdt" placeholder="BDT"  />

                                        @error('bdt')
                                        <span class=text-danger>{{$message}}</span>
                                        @enderror
                                    </div> -->

                                    <div class="col-12">
                                        <h6>Screenshot of Confirmation</h6>
                                        <input class="form-control" onchange="readURL(this);" type="file" name="confirmation_screenshot" required />

                                        <br>

                                        <img id="blah" />

                                        @error('confirmation_screenshot')
                                        <span class=text-danger>{{$message}}</span>
                                        @enderror
                                    </div>


                                    <input type="hidden" id="dollaRate" value="{{$dollarRate->rate}}">


                                    

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" required checked type="checkbox" value=""
                                                id="flexCheckDefault1" />
                                            <label class="form-check-label" for="flexCheckDefault1">
                                                I confirm payment has been made and has left my account.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" required checked type="checkbox" value=""
                                                id="flexCheckDefault2" />
                                            <label class="form-check-label" for="flexCheckDefault2">
                                                I understand the balance on my account can only be updated after the
                                                funds are received by Aurora.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" required checked type="checkbox" value=""
                                                id="flexCheckDefault3" />
                                            <label class="form-check-label" for="flexCheckDefault3">
                                                If making a transfer, I have checked the payment details and confirm I
                                                sent the funds to the correct bank details.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" required checked type="checkbox" value=""
                                                id="flexCheckDefault4" />
                                            <label class="form-check-label" for="flexCheckDefault4">
                                                I have read and agree to the Terms and Conditions.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary px-4 float-end">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
	
@endsection

<script>

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result).width(150).height(150);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function getPaymentMethod (value) {
  
        var paymentType = value;
        var url = "{{ route('get-payment-type-wise-payment-method') }}";
        if (paymentType != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    paymentType: paymentType
                },
                success: function (data) {
                    //For Section...
                    $("#payment_category_id").empty();
                    $("#payment_category_id").append('<option value="" selected disabled>Select Payment Method </option>');

                    $.each(data.sectionData, function(key,value){
                        $("#payment_category_id").append('<option value="'+value.id+'">'+value.payment_method+'</option>');
                    });

                }

            });
        }
    };
  </script>

  <script>
    function getPaymentAccount (value) {
  
        var paymentMethod = value;
        var url = "{{ route('get-payment-account') }}";
        if (paymentMethod != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    paymentMethod: paymentMethod
                },
                success: function (data) {
                    //For Section...
                    $("#payment_method_id").empty();
                    $("#payment_method_id").append('<option value="" selected disabled>Select Payment Account </option>');

                    $.each(data.sectionData, function(key,value){
                        $("#payment_method_id").append('<option value="'+value.id+'">'+value.ac_number + '</option>');
                    });

                }

            });
        }
    }

    function getBDTPrice()
    {
        let usd = parseFloat($("#usd").val());
        let dollaRate = parseFloat($("#dollaRate").val());

        if (usd >= 0) {
            let finalAmount = usd * dollaRate;
            $("#bdt").val(finalAmount);
        }else{
            $("#bdt").val(0);
        }

    }

  </script>