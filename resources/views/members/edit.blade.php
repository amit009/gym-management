<x-app-layout>    
    <div class="page-title">
        <div class="title_left">
            <h3>{{ __('Edit Member') }} : {{$member->fullname}}</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('members') }}" class="btn btn-round btn-info btn-sm">All Members</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
   
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">                    
                    @include('shared.notifications')                     
                    <!-- Smart Wizard -->
                    <form action="{{ route('member.update', $member->id) }}" method="POST" class="form-horizontal form-label-left step-1-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        <div id="wizard" class="form_wizard wizard_horizontal">
                            <ul class="wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no">1</span>
                                        <span class="step_descr">Step 1<br /><small>Personal Details</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                        <span class="step_descr"> Step 2<br /><small>Contact Details</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                        <span class="step_descr">Step 3<br /><small>Service Details</small></span>
                                    </a>
                                </li>                         
                            </ul>
                            <div id="step-1">                            
                                <div class="row form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Gender <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="genders-wrapper">
                                            <div class="genders">
                                                <label for="genderM">Male:</label> <input type="radio" class="flat" name="gender" id="genderM" value="male" @checked(old('male', $member->gender) == 'male') required />
                                            </div>    
                                            <div class="genders">
                                                <label for="genderF">Female:</label> <input type="radio" class="flat" name="gender" id="genderF" value="female" @checked(old('female', $member->gender) == 'female') />
                                            </div>    
                                            <div class="genders">
                                                <label for="genderO">Other:</label> <input type="radio" class="flat" name="gender" id="genderO" value="other" @checked(old('other', $member->gender) == 'other') />
                                            </div>
                                            @error('gender')<span class="error">{{$message}}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                        First Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="first-name" name="first_name" required="required" class="form-control @error('first_name')required-field @enderror" value="{{ old('first_name', $member->first_name) }}">
                                        @error('first_name')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="last-name" name="last_name" required="required" class="form-control @error('last_name')required-field @enderror" value="{{ old('last_name', $member->last_name) }}">
                                        @error('last_name')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Registration Date <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="registration_date" class="form-control @error('registration_date')required-field @enderror" onclick="this.showPicker()" value="{{ old('registration_date', $member->registration_date) }}">
                                        @error('registration_date')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Date of Birth</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="date" name="date_of_birth" class="form-control" onclick="this.showPicker()" value="{{ old('date_of_birth', $member->date_of_birth) }}">
                                        @error('date_of_birth')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="med-con">Medical Conditions</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea name="medical_conditions" id="med-con" class="form-control">{{ old('medical_conditions', $member->medical_conditions) }}</textarea>
                                    </div>
                                </div>                                
                            </div>
                            <div id="step-2">                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}">
                                        @error('email')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone Number <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="tel" name="phone" class="form-control @error('phone')required-field @enderror" value="{{ old('phone', $member->phone) }}" required="required">
                                        @error('phone')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Emergency Contact Number</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="tel" name="emergency_contact_number" class="form-control" value="{{ old('emergency_contact_number', $member->emergency_contact_number) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Address <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea name="address" id="address" class="form-control">{{ old('address', $member->address) }}</textarea>
                                    </div>
                                </div>                                
                                <div class="row form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id="status" name="status" class="form-control"> 
                                            <option value="active" data-month="1" @if($member->status == 'active') selected="" @endif>Active</option> 
                                            <option value="inactive" data-month="3" @if($member->status == 'inactive') selected="" @endif>Inactive</option> 
                                            <option value="expired" data-month="6" @if($member->status == 'expired') selected="" @endif>Expired</option>
                                        </select>
                                        @error('plan')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="upload-pic">Upload Profile Photo </label>
                                    <div class="col-md-3 col-sm-3 ">
                                        <input type="file" name="profile_photo" id="upload-pic" accept="image/*">                                        
                                    </div>
                                    <div class="col-md-3 col-sm-3 ">
                                        <!-- <input type="file" name="profile_photo" id="upload-pic" accept="image/*">  -->
                                        @if(!empty($member->profile_photo))
                                        <div class="thumb-pic">
                                            <img src="{{ asset('/storage/profile_photos/' . $member->profile_photo) }}" class="img-circle profile_img" alt="{{$member->fullname}}">
                                        </div>
                                        @else
                                        <div class="thumb-pic">
                                            <img src="{{ asset('build/images/profile.png') }}" class="img-circle profile_img" alt="No Image">
                                        </div>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                            <div id="step-3">         
                                <div class="row form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="plan">Plan <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id="plan" name="plan" class="form-control"> 
                                            <option value="monthly" data-month="1" @if($member->plan == 'monthly') selected="" @endif>Monthly</option> 
                                            <option value="quarterly" data-month="3" @if($member->plan == 'quarterly') selected="" @endif>Quarterly</option> 
                                            <option value="half-yearly" data-month="6" @if($member->plan == 'half-yearly') selected="" @endif>Half Yearly</option> 
                                            <option value="yearly" data-month="12" @if($member->plan == 'yearly') selected="" @endif>Yearly</option> 
                                        </select>
                                        @error('plan')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="category">Service <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <!-- <select id="service" name="service_id" class="select2_multiple form-control" multiple="multiple">
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }} - <small>{{$service->fee}}</small> </option>
                                            @endforeach
                                        </select> -->
                                        @foreach($services as $service)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="services[]" class="flat services" value="{{ $service->id }}" data-amount="{{$service->fee}}" @if(in_array($service->id, $member->service_ids)) checked="" @endif> {{ $service->name }} - <small>{{config('app.currency')}}{{$service->fee}}/month</small>
                                            </label>
                                        </div>
                                        @endforeach
                                        @error('service_id')<span class="error">{{$message}}</span>@enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Amount</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="amount" class="form-control has-feedback-left" readonly="readonly" value="{{ old('fee', $member->fee) }}">
                                        <span class="fa fa-inr form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Need Personal Trainer?</label>
                                    <div class="col-md-6 col-sm-6 ">                                         
                                        <label>
                                            <input type="checkbox" name="need_trainer" id="needTrainer" class="js-switch" value="1" {{ $member->need_trainer == 1 ? 'checked' : '' }}/> 
                                        </label>                                         
                                    </div>
                                </div>

                                <div class="row form-group" id="trainerSelectWrapper" style="margin-top: 10px; display: {{ $member->need_trainer == 1 ? 'block' : 'none' }};">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="trainer">Trainer</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select id="trainer" name="trainer_id" class="form-control" {{ $member->need_trainer == 1 ? '' : 'disabled' }}> 
                                            @foreach($trainers as $trainer)    
                                                <option value="{{$trainer->id}}" {{$trainer->id == $member->trainer_id ? 'selected' : ''}}>{{$trainer->FullName}}</option>
                                            @endforeach      
                                        </select> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </form>
                    <!-- End SmartWizard Content -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 

<script>
$(document).ready(function() {
    $('#needTrainer').on('change', function () {
        let isChecked = $(this).is(':checked');

        // Show/hide the select field
        if (isChecked) {
            $('#trainerSelectWrapper').slideDown();
            $('#trainer').attr('disabled', false);
        } else {
            $('#trainerSelectWrapper').slideUp();
            $('#trainer').attr('disabled', true);
        }        
    });
   

    // Recalculate on service checkbox change
    $('input[name="services[]"]').on('ifChanged', function () {
        calculateTotal();
    });

    // Recalculate on plan change
    $('#plan').on('change', function () {
        calculateTotal();
    });
    
    // Calculation function
    function calculateTotal() {
        console.log('Calculating total...');
        let baseTotal = 0;
        let planMultiplier = parseInt($('#plan option:selected').data('month')) || 1;

        $('input[name="services[]"]:checked').each(function () {
            let amount = parseFloat($(this).data('amount'));
            if (!isNaN(amount)) {
                baseTotal += amount;
            }
        });

        console.log('basse total...', baseTotal);

        let finalTotal = baseTotal * planMultiplier;
        $('input[name="amount"]').val(finalTotal.toFixed(2));
    }
});
</script>
