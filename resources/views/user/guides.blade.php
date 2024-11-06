@extends('user.master')
@section('content')
	
	<div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Guides</h6>
                        <div class="my-3 border-top"></div>
                        <div class="card-group">
                            <div class="row">

                                @foreach($guidesData as $data)
                                @if($data)
                                <div class="col-md-4" style="width: 400px;">
                                    <div class="card border-end">
                                        <img src="{{ asset('/uploads/guides_image/'.$data->image) }}" width="200"  class="card-img-top" alt="..." style="height: 250px;" >
                                        <div class="card-body">
                                            <h5 class="card-title">{{$data->title}}</h5>
                                           
                                            <a href="{{route('guide-details',$data->id)}}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            
                            </div>                            
                        </div>
                    </div>
                </div>
                

@endsection