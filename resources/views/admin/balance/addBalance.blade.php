@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Balance</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Balance</h6>
                <hr/>

                <form class="row g-3" action="{{route('user-balance-add')}}" method="post">
                @csrf

                  <div class="col-12">
									<label class="form-label">User</label>
										<select class="single-select" name="user_id" required>
											<option selected disabled>Select User</option>
											@foreach($userData as $user)
										  @if(isset($user))
											<option value="{{$user->id}}">{{$user->name}} ({{$user->userID}})</option>
											@endif
											@endforeach						
										</select>
								  </div>

                  <div class="col-12">
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" required>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Balance</button>
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