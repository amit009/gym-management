<x-app-layout>    
    <div class="page-title">
        <div class="title_left">
            <h3>{{ __('Create Trainer') }}</h3>
        </div>

        <div class="title_right">
            <div class=" pull-right  ">
                <a href="{{ route('services') }}" class="btn btn-round btn-info btn-sm">List Trainers</a>
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
                    <br />
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Gender <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="genders-wrapper">
                                    <div class="genders">
                                        <label for="genderM">Male:</label> <input type="radio" class="flat" name="gender" id="genderM" value="male" checked="" required />
                                    </div>    
                                    <div class="genders">
                                        <label for="genderF">Female:</label> <input type="radio" class="flat" name="gender" id="genderF" value="female" />
                                    </div>    
                                    <div class="genders">
                                        <label for="genderO">Other:</label> <input type="radio" class="flat" name="gender" id="genderO" value="other" />
                                    </div>
                                    @error('gender')<span class="error">{{$message}}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">First Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="first_name" class="form-control @error('first_name')required-field @enderror">
                                @error('first_name')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="fee">Last Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="last_name" class="form-control @error('last_name')required-field @enderror">
                                @error('last_name')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Date of Birth</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="date" name="date_of_birth" class="form-control" onclick="this.showPicker()">
                                @error('date_of_birth')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="email" name="email" class="form-control">
                                @error('email')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone Number <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="tel" name="phone" class="form-control @error('phone')required-field @enderror">
                                @error('phone')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group item">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="med-con">Address</label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea name="address" id="med-con" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="specialization">Specialization</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="specialization" class="form-control">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select id="status" name="status" class="form-control"> 
                                    <option value="active" data-month="1">Active</option> 
                                    <option value="inactive" data-month="3">Inactive</option> 
                                    <option value="expired" data-month="6">Expired</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group item">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="upload-pic">Upload Profile Photo </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="profile_photo" id="upload-pic" accept="image/*"> 
                            </div>
                        </div> 
                         
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Create</button>
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>