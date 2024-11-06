@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Payment Method Category</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Payment Method Category</h6>
                <hr/>

                <form class="row g-3" action="{{route('payment-method-category.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                    <label class="form-label">Payment Type</label>
                    <select class="single-select" name="payment_type" required>
                      <option selected disabled>Select Payment Type</option>
                      <option value="Bank">Bank</option>  
                      <option value="Mobile Banking">Mobile Banking</option>         
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Payment Method</label>
                    <input type="text" name="payment_method" class="form-control">
                  </div>

                  <div class="col-12">
                      <h6>Icon</h6>
                      <input class="form-control" onchange="readURL(this);" type="file" name="icon" required />

                      <br>

                      <img id="blah" />

                      @error('icon')
                      <span class=text-danger>{{$message}}</span>
                      @enderror
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

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result).width(150).height(100);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>