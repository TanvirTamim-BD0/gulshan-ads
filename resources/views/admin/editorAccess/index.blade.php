@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Editor Access</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-10 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Editor Access</h6>
                <hr/>

                <form class="row g-3" action="{{route('editor-access.update',$access->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')


                  <div class="col-md-12">
                          <label class="form-label">Editor 1</label>
                          <input type="text" class="form-control" value="{{$access->editor_1}}" name="editor_1">
                  </div>

                  <div class="col-md-12">
                          <label class="form-label">Editor 2</label>
                          <input type="text" class="form-control" value="{{$access->editor_2}}" name="editor_2">
                  </div>

                  <div class="col-md-12">
                          <label class="form-label">Note</label>
                          <textarea class="form-control" name="note" >{{$access->note}}</textarea>
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
	</div>
	<!--end row-->

@endsection