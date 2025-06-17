<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Service : {{$service->fullname}}</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <a href="{{ route('service.edit', $service->id) }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
            </div>
        </div> 
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Services & Fee Details</h2>
                    <div class="clearfix"></div>
                </div>
            
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table show-service">
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td>{{$service->name}}</td>
                            </tr>
                            <tr>
                                <th>Fee:</th>
                                <td>{{ config('app.currency') }}{{$service->fee}}</td>
                            </tr>
                            <tr>
                                <th>Create Date:</th>
                                <td> {{$service->created_at}}</span></td>
                            </tr>
                            <tr>
                                <th>Update Date:</th>
                                <td> {{$service->updated_at}}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>