<style type="text/css">
    .table-bordered>thead {
        background-color: #51a79b;
        color: white;
    }
</style>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Total Events Attended by User "<?php echo $user[0]['name']; ?>"</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic modals -->
    <div class="card">        
        <div class="card-body">
            <div class="col-md-12">
                <table class="table table-bordered" id="event_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<!-- Success modal -->
<div id="modal_video" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Video Player</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>           
            <div class="modal-body">
                <video id="my_video" width="100%" height="240" controls>
                  <source src="movie.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                             
            </div>           
        </div>
    </div>
</div>
<!-- /success modal -->

<script>
    
    var $event_datatable = $('#event_datatable');   
    var user_id=<?php echo $user_id; ?>;

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        var datatableInit = function () {

            // format function for row details
            $event_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "sAjaxSource":base_url + "admin/user/get_attend_History",
                "fnServerData": function ( sSource, aoData, fnCallback ) {
                    aoData.push( { "name": "user_id","value": user_id});
                    $.ajax({
                        "dataType": 'json',
                        "type": "POST",
                        "url": sSource,
                        "data": aoData,
                        "success": fnCallback
                    })
                },
                "columnDefs": [
                    
                    
                ],
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Username", "data": "user_name", "class": "text-center", "width": "10%"},
                    {"title": "Event Name", "data": "event_name", "class": "text-center", "width": "10%"},
                    {"title": "Ticket Count", "data": "ticket_count", "class": "text-center", "width": "10%"},
                    {"title": "Total Cost", "data": "total_cost", "class": "text-center", "width": "10%"},
                    {"title": "Payment Gateway", "data": "payment_gateway", "class": "text-center", "width": "10%"},
                    {"title": "Transaction Number", "data": "transaction_number", "class": "text-center", "width": "10%"},
                    {"title": "Attended Date", "data": "attended_at", "class": "text-center", "width": "5%"},
                    
                ],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                "scrollX": true,
                "scrollCollapse": true,
                "jQueryUI": true,
                "paging": true,
                "pagingType": "full_numbers",
                bProcessing: true,
                autoWidth: true,
            });
        };

        $(function () {
            datatableInit();

            $('#event_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $event_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/event/edit?id='+data.id;
            });

            $('#event_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $event_datatable.fnGetData($(this).parents('tr')[0]);

                swal({
                    title: '<b>Delete！</b>',
                    text: "Are you sure?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(
                    function (dismiss) {
                        if (dismiss.value) {

                            $.ajax({
                                url: base_url+'admin/event/del_Event',
                                type : 'POST',
                                data : {
                                    id: data.id
                                },
                                cache: false,
                                success: function(result) {
                                    swal(
                                        'Success!',
                                        'Your operation successfully!',
                                        'success'
                                    );
                                    $event_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function Download() {
        location.href = base_url + 'admin/event/export_Event';
    }
</script>