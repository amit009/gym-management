<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Members</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
            <a href="{{ route('member.create') }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-plus"></i> New</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    <!-- <a href="{{ route('member.create') }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-plus"></i> New Member</a> -->
                    <!-- <div class="panel-box">
                    </div> -->
                    <div class="nav navbar-left filters">
                        <form action="" class="form-label-left input_mask">
                            <div class="col-md-6 col-sm-6 form-group has-feedback">
                                <input type="search" id="search-phone" class="form-control has-feedback-right" placeholder="Search member...">
                                <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>   
                            </div>
                            <div class="col-md-6 col-sm-6  form-group has-feedback">
                                <select class="form-control" id="member-status" name="status">
                                    <option value="">Choose member status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            
                <div class="x_content">
                    <div id="members-table" class="table-responsive">
                        @include('members.partials.table', ['members' => $members])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 
<script>
    function fetchMembers(page = 1, query = '') {
        $.ajax({
            url: "{{ route('member.search') }}",
            data: { q: query, page: page },
            success: function (data) {
                $('#members-table').html(data);

                if(query && $('.clear-filter').length == 0) {
                    $('.filters').append('<a href="#" class="clear-filter"><i class="fa fa-close"></i> Clear Filter</i>');
                }

                if (!query) {
                    $('.clear-filter').remove();
                    $('#member-status')[0].selectedIndex = 0;
                }
            }
        });
    }

    $(document).on('keyup', '#search-phone', function () {         
        let query = $(this).val();
        fetchMembers(1, query);
    });

    $(document).on('click', '.clear-filter', function (e) {
        e.preventDefault();
        $('#search-phone').val('');
        fetchMembers(1, '');
    });

    $(document).on('change', '#member-status', function () {         
        let status = $(this).val();
        fetchMembers(1, status);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search-phone').val();
        fetchMembers(page, query);
    });
    $(document).on('click', '.action-btns .make-payment', function (e) {
        e.preventDefault();
        $('#makePaymentModal').modal('show');
        
        let member_id = $(this).attr('data-member_id');
        let member_fee = $(this).attr('data-amount'); 
         
        $('.member-fee-form').find('input[name=id]').val(member_id);
        $('.member-fee-form').find('input[name=original_amount]').val(member_fee);
        $('.member-fee-form').find('input[name=final_amount]').val(member_fee);
    });

    $(document).ready(function () {
        $(document).on('keyup change', '.member-fee-form #discount-amount', function () {
            console.log('Discount amount changed...');
            calculateMemberFee();
        });

        function calculateMemberFee() {
            console.log('Calculating member fee...');       
            let original_fee = parseInt($('#original-amount').val());
            let discount_amount = parseInt($('#discount-amount').val()) || 0;

            if(discount_amount > original_fee) {
                discount_amount = original_fee; // Ensure discount does not exceed original fee
                $('#discount-amount').val(discount_amount);
            }
            
            let final_amount = original_fee - discount_amount;
            $('#final-amount').val(final_amount.toFixed(2));
        }



        $(document).on('click', '#send-notification', function (e) {
            e.preventDefault();
            if(confirm('Are you sure you want to send Reminder?')){
                console.log('Sending notification...');
                let member_id = $(this).attr('data-member_id');
                console.log('Member ID:', member_id);
                $.ajax({
                    url: "{{ route('member.send_notification') }}",
                    type: 'POST',
                    data: {
                        member_id: member_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if(response.status == true) {
                            console.log('response:', response.message);
                            alert(response.message);
                            return;
                        } else {
                            console.error('response:', response.message);
                            alert(response.message);
                            return;
                        } 
                    },
                    error: function (xhr, status, error) {
                        console.error('Error sending notification:', error);
                        alert('Failed to send notification. Please try again.');
                    }
                });
            }             
        });
    });
</script>
 