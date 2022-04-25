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
            <h4><span class="font-weight-semibold">Manage Membership</span></h4>
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
                <button type="button" class="btn bg-teal-400" onclick="Add_membership()">New Membership</button>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered" id="membership_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>
    
    var $membership_datatable = $('#membership_datatable');   

    jQuery(document).ready(function() {
        
        var datatableInit = function () {

            // format function for row details
            $membership_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/membership/get_Membership",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
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
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "Cost", "data": "cost", "class": "text-center", "width": "10%"},
                    {"title": "Details", "data": "details", "class": "text-center", "width": "30%"},
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

            $('#membership_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $membership_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/membership/edit?id='+data.id;
            });

            $('#membership_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $membership_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/membership/del_Membership',
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
                                    $membership_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function Add_membership(){

        location.href = base_url+'admin/membership/add';
    }

    
</script>