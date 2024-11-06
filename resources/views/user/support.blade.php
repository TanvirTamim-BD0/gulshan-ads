@extends('user.master')
@section('content')
	
	<div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h5 class="mb-0 text-uppercase">Account Support</h5>
                            <hr />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion" id="accordionExample">

                                    @foreach($supportData as $support)
                                    @if(isset($support))
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                {{$support->title}}
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>
                                                    {!! $support->description !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

@endsection