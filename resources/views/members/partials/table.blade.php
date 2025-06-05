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
            <th class="column-title">Reminder</th>
            <th class="column-title no-link last"><span class="nobr">Action</span></th>
        </tr>
    </thead>
    <tbody>
        @if($members->count() == 0)
            <tr>
                <td colspan="9" class="text-center">No members found with record matches</td>
            </tr>
        @else 
            @foreach($members as $member)
                <tr>
                    <td scope="row">{{$member->id}}</td>                    
                    <td><a href="{{ route('member.view', $member->id) }}">{{ $member->first_name }} {{ $member->last_name }}</a></td>
                    <td>{{ $member->phone }}</td>                                     
                    <td>{{ $member->email }}</td>                                     
                    <td>{{ $member->registration_date }}</td> 
                    <td>                                        
                        <span class="{{ $member->status_badge_class }}">{{ ucfirst($member->status)}}</span>
                    </td>
                    <td>                                  
                    @php
                        $payment_status = $member->memberFees?->payment_status ?? 'N/A';
                        $badgeClass = match ($payment_status) {
                            'paid' => 'badge badge-success',
                            'unpaid' => 'badge badge-danger',
                            'pending' => 'badge badge-warning',
                            default => 'badge badge-secondary',
                        };
                    @endphp      
                        <span class="{{$badgeClass}}">{{ ucfirst($payment_status ?? 'N/A') }}</span>
                    </td>
                    <td>
                    {{ $member->reminder }}
                    </td>
                    <td class="last action-btns">
                        <a href="{{ route('member.view', $member->id) }}" class="btn btn-round btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Member"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-round btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Member"><i class="fa fa-pencil"></i></a>
                        <form action="{{route('member.delete', $member->id)}}" method="POST">
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
                            <a href="#makePaymentModal" class="btn btn-round btn-success btn-sm make-payment" data-member_id="{{$member->id}}" data-amount="{{$member->fee}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Make Payment"><i class="fa fa-money"></i></a>
                            <a href="#" data-member_id="{{$member->id}}" id="send-notification" class="btn btn-round btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Send Reminder"><i class="fa fa-bullhorn"></i></a>
                        @endif
                    </td>
                </tr> 
            @endforeach    
        @endif                                                    
    </tbody>
</table>
<!-- {{ $members->withQueryString()->links() }} -->
{{ $members->links() }}

<div id="makePaymentModal" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="POST" action="{{ route('member.update_fee') }}" class="form-horizontal form-label-left member-fee-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="member-id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">                
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 label-align" for="original_amount">Amount <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="original-amount" name="original_amount" required="required" class="form-control" readonly="readonly" value="0">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 label-align" for="discount-amount">Discount Amount </label>
                        <div class="col-md-6">
                            <input type="number" id="discount-amount" name="discount_amount" class="form-control" placeholder="0.00" value="{{old('discount_amount')}}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 label-align" for="final-amount">Final Amount </label>
                        <div class="col-md-6">
                            <input type="text" id="final-amount" name="final_amount" class="form-control" value="{{old('final_amount')}}" placeholder="0.00"  >
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 label-align" for="payment-status">Payment Status </label>
                        <div class="col-md-6">
                            <select name="payment_status" id="payment-status" class="form-control">
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="partial">Partial</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-4 label-align" for="payment-method">Payment Method </label>
                        <div class="col-md-6">
                            <select name="payment_method" id="payment-method" class="form-control">
                                <option value="cash">Cash</option>
                                <option value="upi">UPI</option>
                                <option value="credit-card">Credit Card</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>