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
            <h4><span class="font-weight-semibold">Email Template Management</span></h4>
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
                <a href="<?php echo site_url('marketing/EmailTemplate/add');?>" class="btn bg-teal-400"><i class="icon-download"></i> Add New</a>
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

	function sendEmail(obj,id){
		if(confirm("Are you sure you want to send?")){
			var t = new Date().getTime();
			$(obj).find('i').show()
			$.ajax({
				url: base_url+'marketing/EmailTemplate/send_EmailNow?t='+t,
				type : 'POST',
				data : {
					id: id,
				},
				dataType: 'json',
				cache: false,
				success: function(result) {
					$(obj).find('i').hide()
					new PNotify({
						title: 'Success!',
						text: result.message,
						icon: 'icon-checkmark3',
						type: 'success'
					});
				},
				error: function(){
					new PNotify({
						title: 'ERROR!',
						text: 'Cannot send request correct.',
						icon: 'icon-checkmark3',
						type: 'error'
					});
					$('.loading').hide();
				}
			});
		}
	}

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
                    "url": base_url + "marketing/EmailTemplate/get_data",
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
								'<a class="btn btn-success text-white" onclick="sendEmail(this,'+cellData+')" title="Send Mail"><i style="display: none" class="icon-spinner icn-spinner hide loading"></i>Send Mail</a>'
							$(td).html(html);
						}
					},
                    {
                        "targets": [7],
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
                    {"title": "Template Name", "data": "template_name", "class": "text-left", "width": "35%"},
                    {"title": "Status", "data": "status", "class": "text-center", "width": "10%"},
                    {"title": "Created", "data": "created_at", "class": "text-center", "width": "10%"},
                    {"title": "Total Sent", "data": "total", "class": "text-center", "width": "10%"},
                    {"title": "Last sent date", "data": "last_sent", "class": "text-center", "width": "10%"},
					{"title": "Send Mail", "data": "id", "class": "text-center", "width": "10%"},
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

                location.href = base_url+'marketing/EmailTemplate/edit?id='+data.id;
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
                                url: base_url+'marketing/EmailTemplate/delete',
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
