<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Services</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
            <a href="{{ route('service.create') }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-plus"></i> New</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">                    
                    <!-- <div class="nav navbar-left  ">
                        <form action="" class="form-label-left input_mask">
                            <div class="input-group has-feedback">
                                <input type="search" id="search-phone" class="form-control has-feedback-right" placeholder="Search service...">
                                <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>   
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div> -->
                </div>
            
                <div class="x_content">
                    <div id="services-table" class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action services-table">
                        <thead>
                            <tr>
                                <th class="column-title">ID</th>                                
                                <th class="column-title">Name</th>
                                <th class="column-title">Fee</th>
                                <th class="column-title">Create date</th>
                                <th class="column-title">Update Date</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($services->count() == 0)
                                <tr>
                                    <td colspan="7" class="text-center">No services found with record matches: {{$search}}</td>
                                </tr>
                            @else 
                                @foreach($services as $service)
                                    <tr>
                                        <td scope="row">{{$service->id}}</td>                    
                                        <td><a href=" ">{{ $service->name }}</a></td>                                        
                                        <td><a href=" ">{{ config('app.currency') }}{{ $service->fee }}</a></td>                                        
                                        <td><a href=" ">{{ $service->created_at }}</a></td>                                        
                                        <td><a href=" ">{{ $service->updated_at }}</a></td>                                        
                                         
                                        <td class="last action-btns">
                                            <a href="{{ route('service.view', $service->id) }}" class="btn btn-round btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View service"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('service.edit', $service->id) }}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit service"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('service.delete', $service->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-round btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete service" onclick="return confirm('Are you sure you want to delete this service?');">
                                                <i class="fa fa-trash"></i>
                                                </button>
                                            </form>                                             
                                        </td>
                                    </tr> 
                                @endforeach    
                            @endif                                                    
                        </tbody>
                    </table>

                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 
<script>
    $(document).ready(function () {
        
    });
</script>
 