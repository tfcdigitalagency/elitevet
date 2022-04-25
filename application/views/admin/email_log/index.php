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
            <h4><span class="font-weight-semibold">Manage Email Logs</span></h4>
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
                <button type="button" class="btn bg-teal-400" onclick="Download()"><i class="icon-download"></i> Download</button>
            </div>
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
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/email/get_Logs",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                }, 
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Page Name", "data": "page_name", "class": "text-center", "width": "10%"},
                    {"title": "IP", "data": "ip_address", "class": "text-center", "width": "10%"},
                    {"title": "Time", "data": "total_time_sec", "class": "text-center", "width": "10%"},
                    {"title": "Date", "data": "date", "class": "text-center", "width": "10%"},
                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "Type", "data": "type", "class": "text-center", "width": "10%"},
                    {"title": "Phone", "data": "phone", "class": "text-center", "width": "10%"},
                    {"title": "Email", "data": "email", "class": "text-center", "width": "5%"},
                    {"title": "To Email", "data": "to_email", "class": "text-center", "width": "5%"},
                    {"title": "Email subject", "data": "email_subject", "class": "text-center", "width": "5%"},
                    {"title": "Counter", "data": "counter", "class": "text-center", "width": "10%"},
                    {"title": "Email Open", "data": "email_open", "class": "text-center", "width": "10%"},
                    {"title": "Special Activity", "data": "special_activity", "class": "text-center", "width": "10%"},
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
             
        });

    });

    function Download() {
        location.href = base_url + 'admin/email/export_Logs';
    }
 
</script>