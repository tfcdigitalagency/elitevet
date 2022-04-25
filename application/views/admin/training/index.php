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
            <h4><span class="font-weight-semibold">Manage Training Videos</span></h4>
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
                <table class="table table-bordered table-hover" id="training_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>
    
    var $training_datatable = $('#training_datatable');   
    var checked_user=<?=$checked_user?>;

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        var datatableInit = function () {

            // format function for row details
            $training_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/training/get_Training",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
                {
                    orderable: false,
                    "targets": [3],
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
                    orderable: false,
                    "targets": [5],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        var html = '';
                        if (rowData.show_on_landing_page == 0){

                            html = '<a onclick="update_Check(1,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input">unchecked</label></div></a>';
                        }
                        else{
                            html = '<a onclick="update_Check(0,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" checked="">checked</label></div></a>';
                        }
                        $(td).html(html);
                    }
                },
                {
                    orderable: false,
                    "targets": [6],
                    "createdCell": function (td, cellData, rowData, row, col) {
                        var html = '';
                        if (rowData.show_on_webinar == 0){

                            html = '<a onclick="update_Check_webinar(1,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input">unchecked</label></div></a>';
                        }
                        else{
                            html = '<a onclick="update_Check_webinar(0,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" checked="">checked</label></div></a>';
                        }
                        $(td).html(html);
                    }
                },
                {
                    "targets": [7],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        var html = '';
                        html +=
                            '<a style="color: deepskyblue;" title="Play" target="_blank" href='+rowData.video_link+'><i class="icon-headphones"></i>Play</a>&nbsp&nbsp'+
                            '<a style="color: deepskyblue;" title="Edit"><i class="icon-pencil7"></i>Edit</a>&nbsp&nbsp'+
                            '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';
                        $(td).html(html);
                    }
                }],
                "columns": [
                    {"title": "$.No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Training title", "data": "title", "class": "text-center", "width": "10%"},
                    {"title": "Training type", "data": "training_type", "class": "text-center", "width": "10%"},
                    {"title": "Training details", "data": "details", "class": "text-center", "width": "10%"},
                    {"title": "Training Video Link", "data": "video_link", "class": "text-center", "width": "10%"},
                    {"title": "Show On Langing Page", "data": "show_on_landing_page", "class": "text-center", "width": "10%"},
                    {"title": "Show On Webinar", "data": "show_on_landing_page", "class": "text-center", "width": "10%"},
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

            $('#training_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $training_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/training/edit?id='+data.id;
            });            

            $('#training_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $training_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/training/del_Training',
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
                                    $training_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function Download() {
        location.href = base_url + 'admin/training/export_Training';
    }

    function update_Check(state,id) {
        if(state==0){

            $.ajax({
                url: base_url+'admin/training/update_Landing_Page',
                type : 'POST',
                data : {
                    id: id,
                    state:0
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

        }else{

            if (checked_user<5) {

                 $.ajax({
                    url: base_url+'admin/training/update_Landing_Page',
                    type : 'POST',
                    data : {
                        id: id,
                        state:1
                    },
                    cache: false,
                    success: function() {
                        swal(
                            'Success!',
                            'Your operation successfully!',
                            'success'
                        );
                      //  $training_datatable.DataTable().ajax.reload();
                    }
                });

            }else{//alert(5);
                
                // setTimeout(function(){
                    swal(
                        'warning!',
                        'Selected Rows cannot larger than five!',
                        'warning'
                    );
                // }, 2000);
            }
            // $training_datatable.DataTable().ajax.reload();
        }
        //$training_datatable.DataTable().ajax.reload();
       setTimeout(function(){
            location.reload();
            
        }, 2000);
    }

    function update_Check_webinar(state,id) {

        $.ajax({
            url: base_url+'admin/training/update_Webinar',
            type : 'POST',
            data : {
                id: id,
                state: state
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
    }

</script>