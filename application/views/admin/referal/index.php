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
            <h4><span class="font-weight-semibold">Referral Logs</span></h4>
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
                    "url": base_url + "admin/referral/get_Logs",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Name", "data": "from", "class": "text-center", "width": "10%"},
                    {"title": "To Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "To Email", "data": "email", "class": "text-center", "width": "10%"},
                    {"title": "Viewed", "data": "viewed", "class": "text-center", "width": "10%"},
                    {"title": "Created", "data": "created", "class": "text-center", "width": "10%"},                    
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
        location.href = base_url + 'admin/referral/export_Logs';
    }

</script>
