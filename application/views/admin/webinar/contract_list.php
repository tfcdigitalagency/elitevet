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
            <h4><span class="font-weight-semibold">Manage Contracts</span></h4>
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
                <table class="table table-bordered table-hover" id="contract_datatable" width="100%">
                </table>
                <button type="button" class="btn alpha-blue text-blue-800 border-blue-600" onclick="add_contract()"><i class="icon-plus-circle2"></i> Add New Contract</button>
            </div>
        </div>
    </div>
    <!-- /basic modals -->    
</div>
<!-- /content area -->


<script>

    var $contract_datatable = $('#contract_datatable');

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        var datatableInit = function () {

            // format function for row details
            $contract_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/webinar/get_Contract",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
                {
                    "targets": [3],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if (!rowData.thumbnail || rowData.thumbnail == null || rowData.thumbnail == "") {
                            $(td).html("");
                        }else{
                            $(td).html("<img style='height: 2.5em; width: 3em;' src='"+base_url+rowData.thumbnail+"'>");
                        }
                    }
                },
                {
                    "targets": [4],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if (!rowData.second_thumbnail || rowData.second_thumbnail == null || rowData.second_thumbnail == "") {
                            $(td).html("");
                        }else{
                            $(td).html("<img style='height: 2.5em; width: 3em;' src='"+base_url+rowData.second_thumbnail+"'>");
                        }
                    }
                },
                {
                    orderable: false,
                    "targets": [5],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        var html = '';
                        if (cellData != null && cellData.length > 25){

                            html = '<span data-popup="tooltip" title="'+cellData+'" data-placement="bottom">' + cellData.substr(0, 25) + '...' + '</span>';
                        }
                        else
                            html = '<span>'+cellData+'</span>';
                        $(td).html(html);
                    }
                },
                {
                    "targets": [7],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        var html = '';
                        html +=
                            '<a style="color: deepskyblue;" title="Detail"><i class="icon-menu7"></i>Detail</a>&nbsp&nbsp'+
                            '<a style="color: deepskyblue;" title="Edit"><i class="icon-pencil7"></i>Edit</a>&nbsp&nbsp'+
                            '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';
                        $(td).html(html);
                    }
                }],
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Contract title", "data": "title", "class": "text-center", "width": "20%"},
                    {"title": "Sponsor", "data": "sponsor", "class": "text-center", "width": "5%"},
                    {"title": "thumbnail", "data": "thumbnail", "class": "text-center", "width": "5%"},
                    {"title": "second_thumbnail", "data": "thumbnail", "class": "text-center", "width": "5%"},
                    {"title": "Details", "data": "details", "class": "text-center", "width": "20%"},
                    {"title": "Status", "data": "status", "class": "text-center", "width": "20%",
                        mRender: function(data, type, row) {
                            if (data == 'available')
                                return '<span class="badge-pill badge-info">available</span>';
                            else 
                                return '<span class="badge-pill badge-warning">not available</span>';
                    }},
                    {"title": "Action", "data": "id", "class": "text-center", "width": "10%"},
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

            $('#contract_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $contract_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/webinar/contract_edit?id='+data.id;
            });

            $('#contract_datatable tbody').on('click', 'a[title="Detail"]', function () {
                var data = $contract_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/webinar/contract_edit?id='+data.id;

            });

            $('#contract_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $contract_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/webinar/del_Contract',
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
                                    $contract_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function add_contract(){
        location.href = base_url+'admin/webinar/add';
    }

</script>