<x-app-layout>    
    <div class="page-title">
        <div class="title_left">
            <h3>{{ __('Edit Member') }}</h3>
        </div>

        <div class="title_right">
            <div class=" pull-right  ">
                <a href="{{ route('services') }}" class="btn btn-round btn-info btn-sm">List services</a>
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
                    <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="name" class="form-control @error('name')required-field @enderror" value="{{ old('name', $service->name) }}">
                                @error('name')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="fee">Fee <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="fee" class="form-control @error('fee')required-field @enderror" value="{{ old('fee', $service->fee) }}">
                                @error('fee')<span class="error">{{$message}}</span>@enderror
                            </div>
                        </div>                            
                         
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Update</button>
                                <button class="btn btn-primary" type="button">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>