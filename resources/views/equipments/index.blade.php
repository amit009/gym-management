<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>{{__('Equipments')}}</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
            <a href="{{ route('equipments.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    {{__('Gym Equipments')}} 
                </div>
            
                <div class="x_content">
                    <div id="equipments-table" class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action equipments-table">
                            <thead>
                                <tr>
                                    <th class="column-title">ID</th>                                
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Amount</th>
                                    <th class="column-title">Quantity</th>
                                    <th class="column-title">Brand</th>
                                    <th class="column-title">Type</th>
                                    <th class="column-title">Purchase Date</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($equipments->count() == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">No equipments found</td>
                                    </tr>
                                @else 
                                    @foreach($equipments as $equipment)
                                        <tr>
                                            <td scope="row">{{$equipment->id}}</td>                    
                                            <td><a href=" ">{{ $equipment->name }}</a></td>                                        
                                            <td><a href=" ">{{ config('app.currency') }}{{ $equipment->amount }}</a></td>                                        
                                            <td><a href=" ">{{ $equipment->quantity }}</a></td>                                        
                                            <td><a href=" ">{{ $equipment->brand }}</a></td>                                        
                                            <td><a href=" ">{{ $equipment->equipment_type }}</a></td>                                        
                                            <td><a href=" ">{{ $equipment->purchase_date }}</a></td>                                        
                                            
                                            <td class="last action-btns">
                                                <a href="{{ route('equipments.show', $equipment->id) }}" class="btn btn-round btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View equipment"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('equipments.edit', $equipment->id) }}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit equipment"><i class="fa fa-pencil"></i></a>
                                                <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-round btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete equipment" onclick="return confirm('Are you sure you want to delete this equipment?');">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>                                             
                                            </td>
                                        </tr> 
                                    @endforeach    
                                @endif                                                    
                            </tbody>
                        </table>
                        {{-- Pagination Links --}}
                        <div class="mt-4">
                            {{ $equipments->links() }}
                        </div>                     
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
 