@extends('user.master')
@section('content')
	
	<h1>Edit Tiktok Ad Account Request</h1>

        <form action="{{route('google-ad-account-request-edit-submit',$accountData->id)}}" method="post">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 1</label>
                                <input type="text" class="form-control" name="facebook_page_url_1" value="{{$accountData->facebook_page_url_1}}" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 2 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_2" value="{{$accountData->facebook_page_url_2}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 3 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_3" value="{{$accountData->facebook_page_url_3}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 4 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_4" value="{{$accountData->facebook_page_url_4}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Facebook Page URL 5 (optional) </label>
                                <input type="text" class="form-control" name="facebook_page_url_5" value="{{$accountData->facebook_page_url_5}}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Website or Destination URL</label>
                                <input type="text" class="form-control" name="website_url" required value="{{$accountData->website_url}}" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Business Manager ID</label>
                                <input type="text" class="form-control" name="business_manager_id" required value="{{$accountData->business_manager_id}}" >
                            </div>
                        </div>

                        
                        <div class="col">
                            <button class="btn btn-primary px-4 float-end">Submit</button>
                        </div>
                    
                    </div>
                </div>
            </div>
            
         
        </form>

@endsection