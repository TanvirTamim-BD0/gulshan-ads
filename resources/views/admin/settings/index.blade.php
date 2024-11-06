@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Settings</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-10 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Settings</h6>
                <hr/>

                <form class="row g-3" action="{{route('settings.update',$setting->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')


                <div class="row mt-3">
                      <div class="col-md-12">    
                        <label class="form-label">Site Logo</label><br>
                        <input class="form-control" type="file" name="site_logo" /><br>
                        @if(isset($setting->site_logo))
                            <img src="{{ asset('/uploads/site_logo/'.$setting->site_logo) }}" height="50" width="100">
                        @endif
                      </div>
                </div>

                  <div class="row mt-4">
                      <div class="col-md-12">
                          <label class="form-label">Site Name</label>
                          <input type="text" class="form-control" value="{{$setting->site_name}}" name="site_name">
                      </div>

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

    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
   <style>.ck-editor__editable_inline {height: 200px;}</style>
  <script>
            ClassicEditor.create( document.querySelector( '#description' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>


@endsection