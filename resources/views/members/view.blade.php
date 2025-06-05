<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Member : {{$member->fullname}}</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('member.edit', $member->id) }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
            </div>
        </div> 
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Personal Details</h2>
                    <div class="clearfix"></div>
                </div>
            
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table show-member">
                            <tbody>
                            <tr>                                 
                                <td colspan="2">
                                    <div class="profile-pic">                                         
                                        @if(!empty($member->profile_photo))
                                        <img src="{{ asset('/storage/profile_photos/' . $member->profile_photo) }}" class="img-circle profile_img" alt="{{$member->fullname}}">
                                        @else
                                        <img src="{{ asset('build/images/profile.png') }}" class="img-circle profile_img" alt="No Image">
                                        @endif
                                    </div>    
                                </td>
                            </tr>
                            <tr>
                                <th style="width:50%">Gender:</th>
                                <td>{{ ucfirst($member->gender)}}</td>
                            </tr>
                            <tr>
                                <th style="width:50%">First Name:</th>
                                <td>{{$member->first_name}}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{$member->last_name}}</td>
                            </tr>                            
                            <tr>
                                <th>Date of Birth:</th>
                                <td>{{$member->date_of_birth}}</td>
                            </tr>                            
                            <tr>
                                <th>Email:</th>
                                <td>{{$member->email}}</td>
                            </tr>
                            <tr>
                                <th>Phone Number:</th>
                                <td>{{$member->phone}}</td>
                            </tr>
                            <tr>
                                <th>Emergency Contact Number:</th>
                                <td>{{$member->emergency_contact_number ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{$member->address}}</td>
                            </tr>                            
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Services & Fee Details</h2>
                    <div class="clearfix"></div>
                </div>
            
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table show-member">
                            <tbody>
                            <tr>
                                <th>Registration Date:</th>
                                <td>{{$member->registration_date}}</td>
                            </tr>
                            <tr>
                                <th>Medical Condition:</th>
                                <td>{{$member->medical_conditions}}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><span class="{{ $member->status_badge_class }}">{{ ucfirst($member->status)}}</span></td>
                            </tr>                            
                            @if($member->need_trainer)
                            <tr>
                                <th style="width:50%">Trainer:</th>
                                <td>{{ $member->trainer->first_name}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th style="width:50%">Plan:</th>
                                <td>{{ ucfirst($member->plan)}}</td>
                            </tr>
                            <tr>
                                <th style="width:50%">Services:</th>
                                <td>
                                    @foreach($services as $service)
                                        <span class="badge badge-primary">{{ $service->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Fee</th>
                                <td>{{config('app.currency')}}{{$member->fee}}</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>{{config('app.currency')}}{{$member->memberFees?->discount_amount}}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{{config('app.currency')}}{{$member->memberFees?->final_amount}}</td>
                            </tr>
                            <tr>
                                <th>Payment Status:</th>
                                <td>
                                @php
                                    $payment_status = $member->memberFees?->payment_status ?? 'N/A';
                                    $badgeClass = match ($payment_status) {
                                        'paid' => 'badge badge-success',
                                        'unpaid' => 'badge badge-danger',
                                        'pending' => 'badge badge-warning',
                                        default => 'badge badge-secondary',
                                    };
                                @endphp      
                                <span class="{{$badgeClass}}">{{ ucfirst($payment_status ?? 'N/A') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Date:</th>
                                <td>{{$member->memberFees?->payment_date}}</td>
                            </tr>
                            <!-- <tr>
                                <th>Profice Photo:</th>
                                <td>
                                <div class="profile_pic">
                                    <img src="{{ asset('/storage/profile_photos/' . $member->profile_photo) }}" class="img-circle profile_img" alt="{{$member->fullname}}">
                                </div>    
                                </td>
                            </tr> -->
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>