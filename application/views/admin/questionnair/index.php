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
            <h4><span class="font-weight-semibold">Questionnaire Logs</span></h4>
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
                    "url": base_url + "admin/questionnair/get_Logs",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Email", "data": "email", "class": "text-left", "width": "10%"},
                    {"title": "Name", "data": "name", "class": "text-left", "width": "10%"},
                    {"title": "Answer", "data": "answer_html", "class": "text-left", "width": "65%"},                    
                    {"title": "Created", "data": "created_at", "class": "text-center", "width": "10%"},
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
 

</script>
