@extends('admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">Tiktok Ad Account Settings</h6> <br>

    <div class="card rounded-4 p-4">

        <div align="right">
                    <a href="{{route('tiktok-ad-account-list')}}" class="btn btn-primary">Account List</a>
                </div>

                <div class="card-body">
                	<form action="{{route('tiktok-ad-account-settings-submit')}}" method="post" enctype="multipart/form-data">
            		@csrf
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1 ">
                        <hr>
                        
                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="user" value="no">
                                <input type="checkbox" class="form-check-input" name="user" value="yes" {{ $setting->user == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> User </label>
                                
                            </div>
                        </div>

                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="account_name" value="no">
                                <input type="checkbox" class="form-check-input" name="account_name" value="yes" {{ $setting->account_name == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Account Name </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="current_balance" value="no">
                                <input type="checkbox" class="form-check-input" name="current_balance" value="yes" {{ $setting->current_balance == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Current Balance </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                 <input type="hidden" name="daily_limit" value="no">
                                <input type="checkbox" class="form-check-input" name="daily_limit" value="yes" {{ $setting->daily_limit == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Daily Spending Limit BY meta </label>
                               
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="payment_threshold" value="no">
                                <input type="checkbox" class="form-check-input" name="payment_threshold" value="yes" {{ $setting->payment_threshold == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Payment Threshold </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="daily_spending_user" value="no">
                                <input type="checkbox" class="form-check-input" name="daily_spending_user" value="yes" {{ $setting->daily_spending_user == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Daily Spending User </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="monthly_billing_date" value="no">
                                <input type="checkbox" class="form-check-input" name="monthly_billing_date" value="yes" {{ $setting->monthly_billing_date == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Monthly Billing Date </label>
                                
                            </div>
                        </div>
                        <hr>


                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="card_4_digit" value="no">
                                <input type="checkbox" class="form-check-input" name="card_4_digit" value="yes" {{ $setting->card_4_digit == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Card 4 Digit </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="social" value="no">
                                <input type="checkbox" class="form-check-input" name="social" value="yes" {{ $setting->social == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Social </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="business_manager_id" value="no">
                                <input type="checkbox" class="form-check-input" name="business_manager_id" value="yes" {{ $setting->business_manager_id == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Business Manager Id </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="status" value="no">
                                <input type="checkbox" class="form-check-input" name="status" value="yes" {{ $setting->status == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Status </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <div class="mb-3">
                                <input type="hidden" name="action" value="no">
                                <input type="checkbox" class="form-check-input" name="action" value="yes" {{ $setting->action == 'yes' ? 'checked' : '' }}>
                                <label class="form-label" style="margin-left: 10px;"> Action </label>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="col">
                            <button class="btn btn-primary px-4 ">Submit</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
				
@endsection