<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Users</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New</a>
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
                                <input type="search" id="search-phone" class="form-control has-feedback-right" placeholder="Search user...">
                                <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>   
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div> -->
                </div>
            
                <div class="x_content">
                    <div id="users-table" class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action users-table">
                        <thead>
                            <tr>
                                <th class="column-title">ID</th>                                
                                <th class="column-title">Name</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">Role</th> 
                                <th class="column-title">Create date</th>
                                <th class="column-title">Update Date</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->count() == 0)
                                <tr>
                                    <td colspan="7" class="text-center">No user found with record matches</td>
                                </tr>
                            @else 
                                @foreach($users as $user)
                                    <tr class="@if($user->deleted_at) bg-danger @endif">
                                        <td scope="row">{{$user->id}}</td>                    
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->roles->isEmpty())
                                                No roles 
                                            @else
                                                @foreach ($user->roles as $role)
                                                    <span class="badge badge-{{$user->getRoleBadgeClass($role->name)}}" style="margin: 2px;">
                                                        {{ ucfirst($role->name) }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                         
                                        <td class="last action-btns">
                                            @if($user->getRoleNames()->first() !== 'admin')
                                                <!-- <a href=" " class="btn btn-round btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View user"><i class="fa fa-eye"></i></a> -->
                                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit user"><i class="fa fa-pencil"></i></a>
                                                <form action="{{route('user.delete', $user->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-round btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete user" onclick="return confirm('Are you sure you want to delete this user?');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                @if($user->deleted_at)                                             
                                                <a href=" " class="btn btn-round btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Restore user"><i class="fa fa-undo"></i></a>
                                                @endif
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
 