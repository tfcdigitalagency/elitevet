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
            <h4><span class="font-weight-semibold">Manage Dig Mag</span></h4>
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
                <a onclick="showModal()" class="btn bg-teal-400">Scrape</a>
				<a style="margin-left:15px;" href="<?php echo site_url('admin/dig/add');?>" class="btn bg-teal-400"><i class="icon-download"></i> Add New</a>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered" id="article_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->
<script>
function showModal(){
	$('#modalsearch').modal('show');
}
</script>
<div class="modal fade" id="modalsearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">       
      <div class="modal-body">
        <form action="<?php echo site_url('admin/dig/scrape')?>" method="GET">
		<div class="input-group">
		  <div class="form-outline" style="width: 80%;">
			<input type="search" id="s" name="s" placeholder="Keyword..." class="form-control" /> 
		  </div>
		  <button type="submit" class="btn btn-primary">
			Search
		  </button>
		</div>
		
		</form>
      </div>       
    </div>
  </div>
</div>
<script>

    var $article_datatable = $('#article_datatable');

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        var datatableInit = function () {

            // format function for row details
            $article_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/dig/get_data",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [					 
                    {
                        "targets": [6],
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
                    {"title": "Image", "data": "photo", "class": "text-left", "width": "10%"},
                    {"title": "Title", "data": "title", "class": "text-left", "width": "10%"},
                    {"title": "Pdf", "data": "pdf", "class": "text-center", "width": "10%"},                     
                    {"title": "Position", "data": "position", "class": "text-center", "width": "10%"},                     
                    {"title": "Clicked", "data": "clicked", "class": "text-center", "width": "10%"},                     
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

            $('#article_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $article_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/dig/edit?id='+data.id;
            });

            $('#article_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $article_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/dig/delete',
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
                                    $article_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

</script>
