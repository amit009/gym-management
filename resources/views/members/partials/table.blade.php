<table class="table table-striped jambo_table bulk_action members-table">
    <thead>
        <tr>
            <th class="column-title">ID</th>
            <th class="column-title">Name</th>
            <th class="column-title">Phone</th>
            <th class="column-title">Email</th>
            <th class="column-title">Registration Date</th>
            <th class="column-title">Status</th>
            <th class="column-title">Fee Status</th>
            <th class="column-title no-link last"><span class="nobr">Action</span></th>
        </tr>
    </thead>
    <tbody>
        @if($members->count() == 0)
            <tr>
                <td colspan="7" class="text-center">No members found with record matches: {{$search}}</td>
            </tr>
        @else 
            @foreach($members as $member)
                <tr>
                    <td scope="row">{{$member->id}}</td>
                    <td><a href=" ">{{ $member->first_name }} {{ $member->last_name }}</a></td>
                    <td>{{ $member->phone }}</td>                                     
                    <td>{{ $member->email }}</td>                                     
                    <td>{{ $member->registration_date }}</td> 
                    <td>                                        
                        <span class="{{ $member->status_badge_class }}">{{ ucfirst($member->status)}}</span>
                    </td>
                    <td>                                  
                    @php
                        $status = $member->memberFees?->payment_status ?? 'N/A';
                        $badgeClass = match ($status) {
                            'paid' => 'badge badge-success',
                            'unpaid' => 'badge badge-danger',
                            'pending' => 'badge badge-warning',
                            default => 'badge badge-secondary',
                        };
                    @endphp      
                        <span class="{{$badgeClass}}">{{ ucfirst($status ?? 'N/A') }}</span>
                    </td>
                    <td class="last action-btns">
                        <a href="" class="btn btn-round btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Member"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Member"><i class="fa fa-pencil"></i></a>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-round btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Member" onclick="return confirm('Are you sure you want to delete this member?');">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        @php
                            $payment_status = $member->memberFees?->payment_status ?? 'N/A';                         
                        @endphp 
                        @if($payment_status == 'unpaid')
                            <a href="#makePaymentModal" class="btn btn-round btn-success btn-sm make-payment"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Make Payment"><i class="fa fa-money"></i></a>
                            <a href="" class="btn btn-round btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Send Reminder"><i class="fa fa-bullhorn"></i></a>
                        @endif
                    </td>
                </tr> 
            @endforeach    
        @endif                                                    
    </tbody>
</table>
<!-- {{ $members->withQueryString()->links() }} -->
{{ $members->links() }}

<div id="makePaymentModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <h4>Text in a modal</h4>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>

        </div>
    </div>
</div> 