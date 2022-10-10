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
            <h4><span class="font-weight-semibold">In-Person Registered on <?php  echo $event[0]['name']?></span></h4>
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
         
        var datatableInit = function () {

            // format function for row details
            $event_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/event/get_Event_local/<?php echo $event[0]['id']?>",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [            
                ],
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "Email", "data": "email", "class": "text-center", "width": "10%"},
                    {"title": "Phone", "data": "phone", "class": "text-center", "width": "10%"},
                    {"title": "Title", "data": "title", "class": "text-center", "width": "10%"},
                    {"title": "Company", "data": "company", "class": "text-center", "width": "10%"},
                    {"title": "Registered", "data": "created", "class": "text-center", "width": "10%",
											mRender: function(data, type, row) {
												return data + ' PT';
											}
										},
                    
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
        location.href = base_url + 'admin/event/export_Event_local/<?php echo $event[0]['id']?>';
    }

     
</script>