@extends('admin.master')
@section('content')
	 <h6 class="mb-0 text-uppercase">Ads</h6>
	<hr/>
	<div class="row">
		<div class="col-xl-10 mx-auto">		
			<div class="card">
              <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Ads</h6>
                <hr/>

                <form class="row g-3" action="{{route('ads.update',$ads->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')


                  <div class="col-12">
                    <label class="form-label">Headline Text</label>
                    <textarea class="form-control" name="headline_text" id="description">{{$ads->headline_text}}</textarea>
                  </div>

                  <hr>


                <div class="row mt-5">
                      <div class="col-md-6">    
                        <label class="form-label">Ads 1</label><br>
                        <input class="form-control" type="file" name="ads_1" /><br>
                        @if(isset($ads->ads_1))
                            <embed src="{{ asset('/uploads/ads_1/'.$ads->ads_1) }}" height="150">
                        @endif
                          <?php
                          $image_1 = 'ads_1';
                          ?>
                         <a href="{{route('ad-image-remove',$image_1)}}" class="btn btn-sm btn-danger">Remove</a>
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Ads Link 1</label>
                          <input type="text" class="form-control" value="{{$ads->ads_link_1}}" name="ads_link_1">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Ads Text 1</label>
                          <input type="text" class="form-control" value="{{$ads->ads_text_1}}" name="ads_text_1">
                      </div>
                  </div>

                  <hr>


                  <div class="row mt-5">
                      <div class="col-md-6"> 
                        <label class="form-label">Ads 2</label><br>
                        <input class="form-control" type="file" name="ads_2" /><br>   
                        @if(isset($ads->ads_2))
                            <embed src="{{ asset('/uploads/ads_2/'.$ads->ads_2) }}" height="150">
                        @endif

                        <?php
                          $image_2 = 'ads_2';
                          ?>
                         <a href="{{route('ad-image-remove',$image_2)}}" class="btn btn-sm btn-danger">Remove</a>
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Ads Link 2</label>
                          <input type="text" class="form-control" value="{{$ads->ads_link_2}}" name="ads_link_2">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Ads Text 2</label>
                          <input type="text" class="form-control" value="{{$ads->ads_text_2}}" name="ads_text_2">
                      </div>
                  </div>

                  <hr>

                  <div class="row mt-5">
                      <div class="col-md-6">    
                        <label class="form-label">Ads 3</label><br>
                        <input class="form-control" type="file" name="ads_3" /><br>
                        @if(isset($ads->ads_3))
                            <embed src="{{ asset('/uploads/ads_3/'.$ads->ads_3) }}" height="150">
                        @endif

                        <?php
                          $image_3 = 'ads_3';
                          ?>
                         <a href="{{route('ad-image-remove',$image_3)}}" class="btn btn-sm btn-danger">Remove</a>
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Ads Link 3</label>
                          <input type="text" class="form-control" value="{{$ads->ads_link_3}}" name="ads_link_3">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Ads Text 3</label>
                          <input type="text" class="form-control" value="{{$ads->ads_text_3}}" name="ads_text_3">
                      </div>
                  </div>

                  <hr>

                  <div class="row mt-5">
                      <div class="col-md-6">    
                        <label class="form-label">Ads 4</label><br>
                        <input class="form-control" type="file" name="ads_4" /><br>
                        @if(isset($ads->ads_4))
                            <embed src="{{ asset('/uploads/ads_4/'.$ads->ads_4) }}" height="150">
                        @endif

                        <?php
                          $image_4 = 'ads_4';
                          ?>
                         <a href="{{route('ad-image-remove',$image_4)}}" class="btn btn-sm btn-danger">Remove</a>
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Ads Link 4</label>
                          <input type="text" class="form-control" value="{{$ads->ads_link_4}}" name="ads_link_4">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Ads Text 4</label>
                          <input type="text" class="form-control" value="{{$ads->ads_text_4}}" name="ads_text_4">
                      </div>
                  </div>

                  <hr>

                  <div class="row mt-5">
                      <div class="col-md-6">
                        <label class="form-label">Ads 5</label><br>
                        <input class="form-control" type="file" name="ads_5" /><br>   
                        @if(isset($ads->ads_5))
                            <embed src="{{ asset('/uploads/ads_5/'.$ads->ads_5) }}" height="150">
                        @endif

                        <?php
                          $image_5 = 'ads_5';
                          ?>
                         <a href="{{route('ad-image-remove',$image_5)}}" class="btn btn-sm btn-danger">Remove</a>
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Ads Link 5</label>
                          <input type="text" class="form-control" value="{{$ads->ads_link_5}}" name="ads_link_5">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Ads Text 5</label>
                          <input type="text" class="form-control" value="{{$ads->ads_text_5}}" name="ads_text_5">
                      </div>
                  </div>

                  <hr>

                  <div class="row mt-5">
                      <div class="col-md-6"> 
                        <label class="form-label">Ads 6</label><br>
                        <input class="form-control" type="file" name="ads_6" /><br>   
                        @if(isset($ads->ads_6))
                            <embed src="{{ asset('/uploads/ads_6/'.$ads->ads_6) }}" height="150">
                        @endif

                        <?php
                          $image_6 = 'ads_6';
                          ?>
                         <a href="{{route('ad-image-remove',$image_6)}}" class="btn btn-sm btn-danger">Remove</a>
                      </div>

                      <div class="col-md-6">
                          <label class="form-label">Ads Link 6</label>
                          <input type="text" class="form-control" value="{{$ads->ads_link_6}}" name="ads_link_6">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Ads Text 6</label>
                          <input type="text" class="form-control" value="{{$ads->ads_text_6}}" name="ads_text_6">
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