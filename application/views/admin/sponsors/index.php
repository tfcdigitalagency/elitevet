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
            <h4><span class="font-weight-semibold">Manage Sponsors</span></h4>
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
                <button type="button" class="btn bg-teal-400" onclick="Add_sponsors()">New Sponsor</button>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered" id="sponsors_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

    <!-- SPONSOR IMAGES -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Sponsor Images</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($sponsor_image as $item):?>
                <div class="col-sm-6 col-lg-1">
                    <div class="card">
                        <div class="header-elements">
                            <a class="list-icons-item" onclick="del_Gallery('<?=$item['id']?>')" style="float: right"><i class="icon-close2"></i></a>
                        </div>
                        <div class="card-img-actions m-1">
                            <img class="card-img img-fluid" src="<?=base_url().$item['link']?>" alt="">
                            <div class="card-img-actions-overlay card-img">
                                <a href="<?=base_url().$item['link']?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                    <i class="icon-plus3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div class="col-sm-6 col-lg-2">
                <button type="button" class="btn btn-primary" onclick="add_Gallery()"><i class="icon-plus-circle2 mr-2"></i> Add More</button>
            </div>
        </div>
    </div>

    <!-- Upload sponsor image modal -->
    <div id="modal_sponsor_image" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add new image</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Image file upload:</label>
                        <div class="col-lg-9" id="image_">
                            <input type="file" class="file-input" name="thumbnail" id="input_sponsor"  data-fouc>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-primary" onclick="save_Gallery()">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // SPONSOR IMAGES -->

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
        C.open("POST", base_url + 'admin/sponsors/save_Gallery');
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
                        url: base_url+'admin/sponsors/del_Gallery',
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
                    "url": base_url + "admin/sponsors/getSponsors",
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
                            if (!cellData || cellData == null || cellData == "") {
                                $(td).html("");
                            }else{
                                var html =
                                    '<div class="card-img-actions m-1"><img class="card-img img-fluid" style="height: 2.5em; width: 3em;" src="'+base_url+rowData.icon+'" alt="">'+'<div class="card-img-actions-overlay card-img">' +'<a href="'+base_url+rowData.icon+'" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">' +'<i class="icon-plus3"></i>' +'</a>' +'</div></div>';
                                $(td).html(html);
                            }
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
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Company", "data": "company", "class": "text-center", "width": "10%"},
                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "Email", "data": "email", "class": "text-center", "width": "10%"},
                    {"title": "Phone", "data": "phone", "class": "text-center", "width": "10%"},
                    {"title": "Link", "data": "url", "class": "text-center", "width": "10%"},
                    {"title": "Icon", "data": "icon", "class": "text-center", "width": "10%"},
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

                location.href = base_url+'admin/sponsors/edit?id='+data.id;
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
                                url: base_url+'admin/sponsors/del_Sponsors',
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

        location.href = base_url+'admin/sponsors/add';
    }

    
</script>