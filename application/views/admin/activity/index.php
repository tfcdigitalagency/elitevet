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
            <h4><span class="font-weight-semibold">Manage Activities</span></h4>
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
                <button type="button" class="btn bg-teal-400" onclick="Add_sponsors()">New Activity</button>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered" id="sponsors_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->
 
</div>
<!-- /content area -->


<script>

    var $sponsors_datatable = $('#sponsors_datatable');

    function add_Gallery() {
        $('#modal_sponsor_image').modal();
    }

    function save_Gallery() {
        var input_sponsor = $("#input_sponsor")[0].files[0];
        var A = new FormData();

        if (input_sponsor) {
            console.log(input_sponsor);
            A.append("input_sponsor", input_sponsor);
        }

        var C = new XMLHttpRequest();
        C.open("POST", base_url + 'admin/activity/save_Gallery');

        C.onload = function() {
            $("#modal_sponsor_image").modal("hide");
            swal({
                title:'Success!',
                text:'Your operation successfully!',
                type:'success',
                confirmButtonClass: 'btn btn-primary',
                confirmButtonText: 'Confirm',
            });

            setTimeout(function () {
                location.reload();
            }, 2000);
        };
        C.send(A);
    }

    function del_Gallery(id) {
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
                        url: base_url+'admin/activity/del_Gallery',
                        type : 'POST',
                        data : {
                            id: id
                        },
                        cache: false,
                        success: function(result) {
                            swal({
                                title:'Success!',
                                text:'Your operation successfully!',
                                type:'success',
                                confirmButtonClass: 'btn btn-primary',
                                confirmButtonText: 'Confirm',
                            });

                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    });
                }
            }
        );
    }

    jQuery(document).ready(function() {

        $('#input_sponsor').fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            initialCaption: "No file selected",
            showUpload: false
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        var datatableInit = function () {

            // format function for row details
            $sponsors_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/activity/getActivity",
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
                    {"title": "Time", "data": "year", "class": "text-center", "width": "10%"},
                    {"title": "Title", "data": "title", "class": "text-center", "width": "10%"},                     
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

            $('#sponsors_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $sponsors_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/activity/edit?id='+data.id;
            });

            $('#sponsors_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $sponsors_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/activity/del_Sponsors',
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
                                    $sponsors_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function Add_sponsors(){

        location.href = base_url+'admin/activity/add';
    }


</script>
