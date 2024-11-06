@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Update Payment Method Category</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Update Payment Method Category</h6>
                <hr/>

                <form class="row g-3" action="{{route('payment-method-category.update',$paymentMethodCategoryData->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="col-12">
                    <label class="form-label">Payment Type</label>
                    <select class="single-select" name="payment_type" required>
                      <option selected disabled>Select Payment Type</option>
                      <option value="Bank" {{ $paymentMethodCategoryData->payment_type == 'Bank' ? 'selected' : '' }}>Bank</option>  
                      <option value="Mobile Banking" {{ $paymentMethodCategoryData->payment_type == 'Mobile Banking' ? 'selected' : '' }}>Mobile Banking</option>         
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Payment Method</label>
                    <input type="text" name="payment_method" class="form-control" value="{{$paymentMethodCategoryData->payment_method}}">
                  </div>

                  <div class="col-md-12">    
                        <label class="form-label">Icon</label><br>
                        <input class="form-control" type="file" name="icon" /><br>
                        @if(isset($paymentMethodCategoryData->icon))
                            <img src="{{ asset('/uploads/payment_method_icon/'.$paymentMethodCategoryData->icon) }}" height="50" width="100">
                        @endif
                      </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update Payment Method</button>
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