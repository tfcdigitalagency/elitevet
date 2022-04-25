<style type="text/css">
    .table-bordered>thead {
        background-color: cornflowerblue;
    }
</style>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Manage Ads Image</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic setup -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Manage Ads Image</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <?php if (!empty($images)):?>
                    <?php foreach ($images as $item):?>
                        <div class="col-sm-6 col-lg-1">
                            <div class="card">
                                <div class="header-elements">
                                    <a class="list-icons-item" onclick="del_Image('<?=$item['id']?>')" style="float: right"><i class="icon-close2"></i></a>
                                </div>
                                <div class="card-img-actions m-1">
                                    <img class="card-img img-fluid" src="<?=base_url().$item['thumbnail']?>" alt="">
                                    <div class="card-img-actions-overlay card-img">
                                        <a href="<?=base_url().$item['thumbnail']?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                            <i class="icon-plus3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
                <div class="col-sm-6 col-lg-2" style="text-align: center">
                    <div class="card">
                        <div class="card-img-actions m-1">
                            <button type="button" class="btn btn-primary" onclick="add_Image()"><i class="icon-plus-circle2 mr-2"></i> Add More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->

    <!-- Basic setup -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Set Background Handout</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">current handout:</label>
                        <div class="col-lg-9">
<!--                            <label class="col-form-label">--><?//=!empty($handout)?$handout:'';?><!--</label>-->
                            <a target="_blank" href="<?=!empty($handout)?base_url($handout):'';?>" >Click here to see</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"></label>
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-outline-primary" style="width: 120px">select handout:</button>
                                </div>
                                <div class="col-lg-8">
                                    <input type="file" class="file-input" id="handout" name="handout" data-show-preview="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"></label>
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-outline-primary" style="width: 120px" onclick="save_Handout()">set handout:</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->

</div>
<!-- /content area -->

<!-- Success modal -->
<div id="modal_theme_primary" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add Image</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="id" name="id" hidden>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">Image file upload:</label>
                    <div class="col-lg-9" id="image_">
                        <input type="file" class="file-input" id="thumbnail" name="thumbnail" data-fouc>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary" onclick="save_Image()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /success modal -->

<script>
    var modalTemplate;
    var previewZoomButtonClasses;
    var previewZoomButtonIcons;
    var fileActionSettings;

    // Bootstrap file upload
    var _componentFileUpload = function() {
        if (!$().fileinput) {
            console.warn('Warning - fileinput.min.js is not loaded.');
            return;
        }

        //
        // Define variables
        //

        // Modal template
        modalTemplate = '<div class="modal-dialog modal-lg" role="document">' +
            '  <div class="modal-content">' +
            '    <div class="modal-header align-items-center">' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>' +
            '    </div>' +
            '    <div class="modal-body">' +
            '      <div class="floating-buttons btn-group"></div>' +
            '      <div class="kv-zoom-body file-zoom-content"></div>' + '{prev} {next}' +
            '    </div>' +
            '  </div>' +
            '</div>';

        // Buttons inside zoom modal
        previewZoomButtonClasses = {
            toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
            fullscreen: 'btn btn-light btn-icon btn-sm',
            borderless: 'btn btn-light btn-icon btn-sm',
            close: 'btn btn-light btn-icon btn-sm'
        };

        // Icons inside zoom modal classes
        previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        };

        // File actions
        fileActionSettings = {
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };
    };

    function del_Image(id) {
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
                        url: base_url+'admin/webinar/del_Image',
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

    function add_Image() {
        $("#id").val(0);
        $('#image_').empty();
        $('#image_').html('<input type="file" class="file-input" name="thumbnail" id="thumbnail"  data-fouc>');
        $('.file-input').fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });
        _componentFileUpload();

        $('.modal-title').html("Add New Ads Image");
        $('#modal_theme_primary').modal();
    }

    function save_Image() {
        var thumbnail = $("#thumbnail")[0].files[0];
        var A = new FormData();

        A.append("id", $("#id").val());

        if (thumbnail) {
            A.append("thumbnail", thumbnail);
        }

        var C = new XMLHttpRequest();
        C.open("POST", base_url + 'admin/webinar/save_Image');
        C.onload = function() {
            $("#modal_theme_primary").modal("hide");
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

    function save_Handout() {
        var handout = $("#handout")[0].files[0];
        var A = new FormData();

        A.append("id", $("#id").val());

        if (handout) {
            A.append("handout", handout);
        }

        var C = new XMLHttpRequest();
        C.open("POST", base_url + 'admin/webinar/save_Handout');
        C.onload = function() {
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

    jQuery(document).ready(function() {
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    });
</script>