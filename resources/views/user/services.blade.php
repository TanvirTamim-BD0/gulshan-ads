@extends('user.master')
@section('content')
	
	<div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Services</h6> <br>
                         
                         <form action="{{route('services.search')}}" method="post">
                         @csrf
                         <div class="row">
                                 <div class="col-md-8">
                                    <input type="text" class="form-control" name="serach_text" placeholder="Search Service ..">
                                 </div>
                                 <div class="col-md-1" style="margin-left: 5px;">
                                      <button class="btn btn-primary px-4 float-end">Search</button>
                                 </div>
                          </div>
                          </form>

                          <br>


                        <div class="my-3 border-top"></div>

                        @foreach($serviceCategoryData as $category)
                        @if(isset($category))
                        <a href="{{route('service-filter',$category->id)}}" class="btn btn-add" style="border: 1px solid black; margin-left: 5px;">{{$category->category_name}}</a>
                        @endif
                        @endforeach

                        <br><br>

                        <div class="card-group">
                            <div class="row">

                                @foreach($serviceData as $data)
                                @if($data)
                                <div class="col-md-4" style="width: 400px;">
                                    <div class="card border-end">
                                    <img src="{{ asset('/uploads/service_image/'.$data->image) }}" class="card-img-top" alt="..." style="height: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$data->name}}</h5>
                                        <h6>{{$data->serviceCategoryData->category_name}}</h6>
                                        
                                        <h5>${{$data->price}}</h5>
                                        <a href="{{route('buy-service',$data->id)}}" class="btn btn-success">Buy Now</a>
                                        <a href="{{route('service-details',$data->id)}}" class="btn btn-primary">Read More...</a>
                                    </div>
                                </div>
                                </div>
                                @endif
                                @endforeach

                            </div>

                            
                        </div>
                    </div>
                </div>

                 <nav class="float-end mt-4" aria-label="Page navigation">
                  <ul class="pagination">

                    {{ $serviceData->links('user.paginate') }}


                  </ul>
                </nav>
                
@endsection