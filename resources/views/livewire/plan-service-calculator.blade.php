<div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="plan">Plan <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 ">
            <select wire:model="plan" id="plan" name="plan" class="form-control"> 
                <option value="monthly" data-month="1">Monthly</option> 
                <option value="quarterly" data-month="3">Quarterly</option> 
                <option value="half-yearly" data-month="6">Half Yearly</option> 
                <option value="yearly" data-month="12">Yearly</option> 
            </select> 
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="category">Service <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">            
            @foreach($services as $key => $service)
            <div class="checkbox">
                <label>
                    <input wire:model="service" type="checkbox" name="service_id" class="flat" value="{{ $key }}" data-amount="{{$service}}"> {{ $key }} - <small>{{env('CURRENCY')}}{{$service}}/month</small>
                </label>
            </div>
            @endforeach
            
        </div>
    </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Amount</label>
        <div class="col-md-6 col-sm-6 ">
            <input type="text" name="amount" class="form-control" readonly="readonly">
            <span class="fa fa-inr form-control-feedback left" aria-hidden="true"></span>
        </div>
    </div>
</div>
