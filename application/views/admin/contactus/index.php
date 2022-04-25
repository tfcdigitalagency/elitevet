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
            <h4><span class="font-weight-semibold">Manage Contact Us</span></h4>
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
                <table class="table table-bordered" id="contactus_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>
    
    var $contactus_datatable = $('#contactus_datatable');   

    jQuery(document).ready(function() {
        
        var datatableInit = function () {

            // format function for row details
            $contactus_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/contactus/get_Contactus",
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
                            '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';
                        $(td).html(html)
                    }
                }
                ],
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "Email", "data": "email", "class": "text-center", "width": "10%"},
                    {"title": "Phone", "data": "phone", "class": "text-center", "width": "10%"},
                    {"title": "Content", "data": "content", "class": "text-center", "width": "10%"},
                    {"title": "Read", "data": "is_read", "class": "text-center", "width": "15%",
                        mRender: function(data, type, row) {
                            if (data == 0)
                                return '<span class="badge-pill badge-warning" onclick="update_read(' + row.id + ')">Unaccept</span>';                           
                            else 
                                return '<span class="badge-pill badge-primary">accepted</span>';

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
            
            $('#contactus_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $contactus_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/contactus/del_Contactus',
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
                                    $contactus_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });
    
    function update_read(id){
        alert(id);
        $.ajax({
            url: base_url+'admin/contactus/update_Read',
            type : 'POST',
            data : {
                id: id
            },
            cache: false,
            success: function() {
                swal(
                    'Success!',
                    'Your operation successfully!',
                    'success'
                );
              
            }
        });

        $contactus_datatable.DataTable().ajax.reload();
    }
    
</script>