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
            <h4><span class="font-weight-semibold">Transactions History</span></h4>
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
                <table class="table table-bordered" id="article_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->


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
                    "url": base_url + "marketing/transaction/get_data",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
					{
						"targets": [5],
						orderable: false,
						"createdCell": function (td, cellData, rowData, row, col) {

							$(td).html(cellData!= null?cellData+'$':'');
						}
					}
                ],
                "columns": [
                    {"title": "No", "data": "id", "class": "text-center", "width": "5%"},
                    {"title": "Transaction", "data": "txn_id", "class": "text-left", "width": "20%"},
                    {"title": "Package", "data": "product_name", "class": "text-left", "width": "20%"},
                    {"title": "Buyer name", "data": "buyer_name", "class": "text-left", "width": "20%"},
                    {"title": "Buyer email", "data": "buyer_email", "class": "text-center", "width": "10%"},
                    {"title": "Paid_amount", "data": "paid_amount", "class": "text-center", "width": "10%"},
                    {"title": "Status", "data": "payment_status", "class": "text-center", "width": "10%"},
                    {"title": "Created", "data": "created", "class": "text-center", "width": "10%"}

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

                location.href = base_url+'marketing/transaction/edit?id='+data.id;
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
                                url: base_url+'marketing/transaction/delete',
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
