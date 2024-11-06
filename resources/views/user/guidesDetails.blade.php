@extends('user.master')
@section('content')
	
	<div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Guide Details</h6>
                        <div class="my-3 border-top"></div>
                        <div class="card-group">
          
                                    <div class="card border-end">
                                        <img src="{{ asset('/uploads/guides_image/'.$data->image) }}" class="card-img-top" alt="..." width="250" />
                                        <div class="card-body">
                                            <h5 class="card-title">{{$data->title}}</h5>
                                            <p class="card-text">{!! $data->description !!}</p>
                                        </div>
                                    </div>
                            
                        </div>
                    </div>
                </div>
                

@endsection