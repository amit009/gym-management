<x-app-layout>    
    <div class="page-title">
        <div class="title_left">
            <h3>{{ __('Create User') }}</h3>
        </div>

        <div class="title_right">
            <div class=" pull-right  ">
                <a href="{{ route('users') }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> List Users</a>
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
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="name" class="form-control @error('name')required-field @enderror">
                                @error('name')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="email" name="email" class="form-control">
                                @error('email')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" name="password" class="form-control @error('password')required-field @enderror">
                                @error('password')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Confirm Password <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')required-field @enderror">
                                @error('password_confirmation')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>                         

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="role">Role</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select id="role" name="role" class="form-control"> 
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
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