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
            <h4><span class="font-weight-semibold">Manage Queue Logs</span></h4>
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
				<div>
				<div style="display:flex; margin-bottom:-40px;position:relative; z-index:50">
					<div style="padding:7px 10px 7px 0px">Filter: </div>
					<div><input type="text" id="q" name="q" class="form-control"/></div>
					<div><select id="status" name="status" class="form-control">
					<option value="">All</option>
					<option value="0">Waiting to be sent</option>
					<option value="1">Sent</option>
					<option value="-1">Failed</option>
					</select></div>
					<div><button class="form-control" style="margin:0px 10px; cursor:pointer;" id="btnApply">Apply</button></div>
				</div>
				</div>
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
	var newq = '';
	var newstatus='';

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
		
		$('#btnApply').click(function(){
			
			$event_datatable.DataTable().ajax.reload();
		})

        var datatableInit = function () {

            // format function for row details
            $event_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": false,
                "ajax": {
                    "type": "GET",
                    "async": true,
                    "url": base_url + "admin/email/get_queue",
                    "data": function(d){
							newq = $('#q').val();
							newstatus = $('#status').val();
			
							d.q = newq
							d.status = newstatus
						},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Subject", "data": "subject", "class": "text-left", "width": "10%"},
                    {"title": "To Email", "data": "email", "class": "text-left", "width": "10%"},
                    {"title": "Schedule", "data": "schedule", "class": "text-center", "width": "5%"},
                    {"title": "Status", "data": "status_label", "class": "text-center", "width": "10%"},
                    {"title": "Created", "data": "created", "class": "text-center", "width": "10%"},
                    {"title": "Sent", "data": "updated", "class": "text-center", "width": "10%"},
                    {"title": "Log", "data": "log", "class": "text-center", "width": "5%"}
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
