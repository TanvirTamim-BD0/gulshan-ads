@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Add Service</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-8 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Service</h6>
                <hr/>

                <form class="row g-3" action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                  <label class="form-label">Service Category</label>
                    <select class="single-select" name="service_category_id" required>
                      <option selected disabled>Select Service Category</option>
                      @foreach($serviceCategoryData as $category)
                      @if(isset($category))
                      <option value="{{$category->id}}">{{$category->category_name}}</option>
                      @endif
                      @endforeach           
                    </select>
                  </div>

                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                    @error('name')
                      <span class=text-danger>{{$message}}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label class="form-label">Details</label>
                    <textarea class="form-control" name="detals" id="description"></textarea>
                    @error('detals')
                      <span class=text-danger>{{$message}}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{old('price')}}" required>
                    @error('price')
                      <span class=text-danger>{{$message}}</span>
                    @enderror
                  </div>

                  <div class="col-12">    
                    <label class="form-label">Image</label>  
                    <input class="form-control" type="file" name="image" required />
                    @error('image')
                      <span class=text-danger>{{$message}}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <div class="">
                      <button type="submit" class="btn btn-primary">Add Service</button>
                    </div>
                  </div>

                </form>

              </div>
              </div>
            </div>

		</div>
	</div>
	<!--end row-->

  <script src="{{ asset('admin') }}/assets/js/tinymce.min.js"></script>

        <script>
                var editor_config = {
                    path_absolute: "/",
                    selector: "textarea",
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor colorpicker textpattern"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                    relative_urls: false,
                    file_browser_callback: function(field_name, url, type, win) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                            'body')[0].clientWidth;
                        var y = window.innerHeight || document.documentElement.clientHeight || document
                            .getElementsByTagName('body')[0].clientHeight;

                        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                        if (type == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.open({
                            file: cmsURL,
                            title: 'Filemanager',
                            width: x * 0.8,
                            height: y * 0.8,
                            resizable: "yes",
                            close_previous: "no"
                        });
                    }
                };

                tinymce.init(editor_config);
            </script>



@endsection
