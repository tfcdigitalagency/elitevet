<style type="text/css">
    .table-bordered>thead {
        background-color: #51a79b;
        color: white;
    }
	.action a{
		cursor:pointer;
	}
</style>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Manage Survey</span></h4> 
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
                <a href="<?php echo site_url('admin/survey/add');?>" class="btn bg-teal-400"><i class="icon-plus-circle2 mr-2"></i> Add New</a> 
				<a style="margin-left:10px;" href="<?php echo site_url('admin/survey/email');?>" class="btn bg-teal-400"> Send Survey By Email</a>
				<a style="margin-left:10px;" href="<?php echo site_url('/survey/capstas/');?>" class="btn btn-warning"><i class="icon-download"></i> Download All Cap-Stas</a>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered" id="survey_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->
 

<script>
    
    var $survey_datatable = $('#survey_datatable');   

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        var datatableInit = function () {

            // format function for row details
            $survey_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/survey/get_data",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [ 
					{
                        "targets": [2],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var html = '';
							 
                            switch(parseInt(cellData)){
								case 1:
									html = 'Pick One';
									break;
								case 2:
									html = 'Pick Multiple';
									break;
								case 3:
									html = 'Rate';
									break;	
							}
                            $(td).html(html);
						}
					},
                    {
                        "targets": [4],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var html = '';
                            html +=                           
                                '<a style="color: deepskyblue;" title="Edit"><i class="icon-pencil7"></i>Edit</a>&nbsp&nbsp'+
                                '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';
                            $(td).html(html);
						}
					}
                ],
                "columns": [
                    {"title": "No", "data": "id", "class": "text-center", "width": "5%"},
                    {"title": "Question", "data": "question", "class": "text-left", "width": "10%"},
                    {"title": "Type", "data": "type", "class": "text-left", "width": "10%"},
                    {"title": "Created", "data": "created_at", "class": "text-center", "width": "10%"},                     
                    {"title": "Action", "data": "id", "class": "action text-center", "width": "10%"},
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

            $('#survey_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $survey_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/survey/edit?id='+data.id;
            });

            $('#survey_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $survey_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/survey/delete',
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
                                    $survey_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });
  
</script>