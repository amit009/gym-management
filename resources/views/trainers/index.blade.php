<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Trainers</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
            <a href="{{ route('trainer.create') }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-plus"></i> New</a>
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
                                <input type="search" id="search-phone" class="form-control has-feedback-right" placeholder="Search trainer...">
                                <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>   
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div> -->
                </div>
            
                <div class="x_content">
                    <div id="trainers-table" class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action trainers-table">
                        <thead>
                            <tr>
                                <th class="column-title">ID</th>                                
                                <th class="column-title">Name</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">Phone</th>
                                <th class="column-title">Status</th>
                                <th class="column-title">Create date</th>
                                <th class="column-title">Update Date</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($trainers->count() == 0)
                                <tr>
                                    <td colspan="7" class="text-center">No trainers found with record matches: {{$search}}</td>
                                </tr>
                            @else 
                                @foreach($trainers as $trainer)
                                    <tr class="@if($trainer->deleted_at) bg-danger @endif">
                                        <td scope="row">{{$trainer->id}}</td>                    
                                        <td>{{ $trainer->fullname }}</td>
                                        <td>{{ $trainer->email }}</td>
                                        <td>{{ $trainer->phone }}</td>
                                        <td><span class="{{ $trainer->status_badge_class }}">{{ $trainer->status}}</span></td>
                                        <td>{{ $trainer->created_at }}</td>
                                        <td>{{ $trainer->updated_at }}</td>
                                         
                                        <td class="last action-btns">
                                            <a href="{{ route('trainer.view', $trainer->id) }}" class="btn btn-round btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View trainer"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('trainer.edit', $trainer->id) }}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit trainer"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('trainer.delete', $trainer->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-round btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete trainer" onclick="return confirm('Are you sure you want to delete this trainer?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            @if($trainer->deleted_at)                                             
                                            <a href="{{ route('trainer.restore', $trainer->id) }}" class="btn btn-round btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Restore trainer"><i class="fa fa-undo"></i></a>
                                            @endif
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
 