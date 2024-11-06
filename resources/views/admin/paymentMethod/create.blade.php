@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Payment Method</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Payment Method</h6>
                <hr/>

                <form class="row g-3" action="{{route('payment-method.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                    <label class="form-label">Payment Type</label>
                    <select class="single-select" name="payment_type" id="paymentType" onchange="getPaymentMethod(value)" required>
                      <option selected disabled>Select Payment Type</option>
                      <option value="Bank">Bank</option>  
                      <option value="Mobile Banking">Mobile Banking</option>         
                    </select>
                  </div>

                <div class="col-12">
                  <label class="form-label">Payment Method</label>
                    <select class="single-select" name="payment_category_id" id="payment_category_id" required>
                      <option selected disabled>Select Payment Method</option>
                                
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Ac Number</label>
                    <input type="text" class="form-control" name="ac_number" required>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Payment Method</button>
                    </div>
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
    function getPaymentMethod (value) {
  
        var paymentType = value;
        var url = "{{ route('get-payment-type-wise-payment-data') }}";
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
