@extends('admin.master')
@section('content')

<h1>Create Tiktok Ad Account</h1>

        <form action="{{route('tiktok-manual-create-ad-account')}}" method="post">
            @csrf
            <div class="card rounded-4 p-5">
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">  

                        <div class="col">
                            <div class="mb-3">
                            <label class="form-label">User</label>
                                        <select class="single-select" name="user_id" required>
                                            <option selected disabled>Select User</option>
                                            @foreach($userData as $user)
                                            @if(isset($user))
                                            <option value="{{$user->id}}">{{$user->name}} ({{$user->userID}})</option>
                                            @endif
                                            @endforeach                     
                                        </select>
                            </div>
                        </div>

                         <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Ad Account Number</label>
                                <input type="number" class="form-control" value="" name="ad_account_number" required>
                                @error('ad_account_number')
                                    <span class=text-danger>{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    	<div class="col">
                            <div class="mb-2">
                                <label class="form-label">Ad Account Name</label>
                                <input type="text" class="form-control" name="ad_name" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Business Manager ID</label>
                                <input type="text" class="form-control" name="business_manager_id" required>
                            </div>
                        </div>

                        <div class="col mt-2">
                            <button class="btn btn-primary px-4 ">Submit</button>
                        </div>

                    
                    </div>
                </div>
            </div>
            
            
        </form>
   @endsection