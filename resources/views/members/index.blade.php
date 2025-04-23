<x-app-layout>
    <div class="page-title">
        <div class="title_left">
            <h3>Members</h3>
        </div>

        <!-- <div class="title_right">
            <div class="col-md-5 col-sm-5 form-group pull-right top_search">
            <form action="{{route('member.search')}}" method="get">
                <div class="input-group">
                    <input type="search" name="q" class="form-control" placeholder="Search by phone..." value="{{@$search}}">                     
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                    </div>
                </div>
            </form>
        </div> -->
    </div>

    <div class="clearfix"></div>

    <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    <a href="{{ route('member.create') }}" class="btn btn-round btn-primary btn-sm"><i class="fa fa-plus"></i> New Member</a>
                    <!-- <div class="panel-box">
                    </div> -->
                    <div class="nav navbar-right panel_toolbox">
                        <form action="" class="form-label-left input_mask">
                            <div class="input-group has-feedback pull-right top_search">
                                <input type="search" id="search-phone" class="form-control has-feedback-right" placeholder="Search member...">
                                <span class="fa fa-search form-control-feedback right" aria-hidden="true"></span>   
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
            }
        });
    }

    $(document).on('keyup', '#search-phone', function () {         
        let query = $(this).val();
        fetchMembers(1, query);
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
    });
</script>
 