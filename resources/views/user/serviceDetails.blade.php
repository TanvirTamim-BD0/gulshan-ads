@extends('user.master')
@section('content')
	
	<div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Service Details</h6>
                        <div class="my-3 border-top"></div>
                        <div class="card-group">

                            <div class="card border-end">
                                    <img src="{{ asset('/uploads/service_image/'.$data->image) }}" class="card-img-top" alt="..." />
                                    <div class="card-body">
                                        <h5 class="card-title">{{$data->name}}</h5>
                                        <h6>{{$data->serviceCategoryData->category_name}}</h6>
                                        <p class="card-text">{!! $data->detals !!}</p>
                                        <h5>${{$data->price}}</h5>
                                        <a href="{{route('buy-service',$data->id)}}" id="shows_confirm" class="btn btn-success">Buy Now</a>
                                    </div>
                                </div>
 

                            </div>

                            
                        </div>
                    </div>
                </div>
                
@endsection