<x-app-layout>    
    <div class="page-title">
        <div class="title_left">
            <h3>{{ __('Edit Role and Permissions') }}</h3>
        </div>

        <div class="title_right">
            <div class=" pull-right  ">
                <a href="{{ route('roles') }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i> List Roles</a>
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
                    <form action="{{ route('role.update', $role->id) }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Role Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="role" class="form-control" value="{{old('name', $role->name)}}">
                                @error('role')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        
                        <hr>
                        @foreach ($permissions as $groupName => $premission)
                            <div class="item form-group">
                                <h6 class="text-primary">{{ $groupName }}</h6>
                                <div class="row">
                                    @foreach ($premission as $item)
                                        <div class="col-md-2">
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" class="js-switch" name="permissions[]" value="{{ $item->name }}" {{ in_array($item->name, $rolesPermissions) ? 'checked' : '' }} />                                             
                                                {{ $item->name }} 
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach                         
                         
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">{{__('Update')}}</button>
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