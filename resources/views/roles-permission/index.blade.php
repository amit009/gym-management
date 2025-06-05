<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Roles and Permission</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
            <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    Permissions
                </div>
            
                <div class="x_content">
                    <div id="users-table" class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action users-table">
                        <thead>
                            <tr>
                                <th class="column-title">ID</th>                                
                                <th class="column-title">Role Name</th>
                                <th class="column-title">Permission</th> 
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                               @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>                                        
                                        @if ($role->name === 'admin')
                                            <span class="badge badge-danger ">{{ __('All Permissions') }}*</span>
                                        @else
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-primary text-light">{{ $permission->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="last action-btns">
                                        @if ($role->name != 'admin')
                                            <a href="{{route('role.edit', $role->id)}}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit role"><i class="fa fa-pencil"></i></a>
                                                <form action="{{route('role.delete', $role->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-round btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete role" onclick="return confirm('Are you sure you want to delete this role?');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach                                                
                        </tbody>
                    </table>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 