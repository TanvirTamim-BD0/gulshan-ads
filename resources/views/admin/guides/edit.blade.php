@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Update Guides</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Update Guides</h6>
                <hr/>

                <form class="row g-3" action="{{route('guide.update',$guidesData->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="col-12">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$guidesData->title}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description">{{$guidesData->description}}</textarea>
                  </div>

                  <div class="col-12">    
                    <label class="form-label">Image</label>  
                    <input class="form-control" type="file" name="image" />
                  </div>

                  <div class="col-12">    
                    <td class="text-center"><img src="{{ asset('/uploads/guides_image/'.$guidesData->image) }}" width="65" height="55" alt=""></td>
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Update Guides</button>
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