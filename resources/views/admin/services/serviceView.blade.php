@extends('admin.master')
@section('content')
	
	<div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Service Details</h6>
                        <div class="my-3 border-top"></div>
                        <div class="card-group">

                            <div class="card border-end">
                                    <img src="{{ asset('/uploads/service_image/'.$serviceData->image) }}" class="card-img-top" alt="..." />
                                    <div class="card-body">
                                        <h5 class="card-title">{{$serviceData->name}}</h5>
                                        <h6>{{$serviceData->serviceCategoryData->category_name}}</h6>
                                        <p class="card-text">{!! $serviceData->detals  !!}</p>
                                        <h5>${{$serviceData->price}}</h5>
                                    </div>
                                </div>
 

                            </div>

                            
                        </div>
                    </div>
                </div>
                
@endsection