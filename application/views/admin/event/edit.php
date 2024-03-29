<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Edit Event</span></h4>
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
        	<form class="form-validate-jquery" method="post" target="_other">
        		<input type="text" class="form-control" id="event_id" name="event_id" value="<?php echo $data[0]['id']; ?>" hidden>
	            <div class="form-group row">
					<label class="col-form-label col-lg-2">Title<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="name" value="<?php echo $data[0]['name']; ?>" required>
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Status</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="status">
                            <option value="upcoming" <?=$data[0]['status']=='upcoming'?'selected':''?>>Upcoming</option>
                            <option value="completed" <?=$data[0]['status']=='completed'?'selected':''?>>Completed</option>
                        </select>
                        <p><em>* You can only have 1 UPCOMING webinar</em></p>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Homepage</label>
                    <div class="col-lg-6">
                        <input name="homepage" id="homepage"  value="1" type="checkbox" <?=$data[0]['homepage']?'checked':''?>/> Show
                        <p><em>* Show it on Homepage</em></p>
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="description" placeholder="Please Input Description" ><?php echo $data[0]['description']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Location<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="location" value="<?php echo $data[0]['location']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Seats</label>
					<div class="col-lg-5">
						<input type="text" class="form-control" id="seats" value="<?php echo $data[0]['seats']; ?>">
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Start time</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-calendar3"></i></span>
                            </span>
                            <input type="text" class="form-control" id="start_time" value="<?php echo $data[0]['start_time']; ?>">
                            <span style="display: inline-block; vertical-align: middle; margin-left: 10px; line-height: 36px">PT</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">End time</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-calendar3"></i></span>
                            </span>
                            <input type="text" class="form-control" id="end_time" value="<?php echo $data[0]['end_time']; ?>">
                            <span style="display: inline-block; vertical-align: middle; margin-left: 10px; line-height: 36px">PT</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Register Link</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="link" value="<?php echo $data[0]['link']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Thumbnail</label>
                    <div class="col-lg-6" id="image_">
                        <input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Second thumbnail</label>
                    <div class="col-lg-6" id="second_image_">
                        <input type="file" class="file-input-overwrite" name="second_image" id="second_image"  data-fouc>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Auto remind</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="remind_to">
                            <option value="all" <?=$data[0]['remind_to']=='all'?'selected':''?>>All</option>
                            <option value="admin_only" <?=$data[0]['remind_to']=='admin_only'?'selected':''?>>Admin only</option>
                            <option value="membership_only" <?=$data[0]['remind_to']=='membership_only'?'selected':''?>>Membership only</option>
                            <option value="none" <?=$data[0]['remind_to']=='none'?'selected':''?>>None</option>
                        </select>
                    </div>
                </div>
				<div class="form-group row" style="float: right;">
					<button type="button" class="btn btn-warning" onclick="backList()">&nbsp&nbspBack&nbsp&nbsp</button>&nbsp&nbsp
					<button type="button" class="btn btn-primary" onclick="save_Event()">&nbsp&nbspSave&nbsp&nbsp</button>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>

    var base_url = '<?= base_url() ?>';
    var validator;
    var thumbnail='<?php echo $data[0]['thumbnail']; ?>';
    var second_thumbnail='<?php echo $data[0]['second_thumbnail']; ?>';
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
        modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header align-items-center">\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

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

        $('#image').fileinput({
            browseLabel: 'Search',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
        });

        $('#second_image').fileinput({
            browseLabel: 'Search',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
        });
    };

    jQuery(document).ready(function() {

        if(thumbnail==''){
            $('#image_').empty();
            $('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');
            _componentFileUpload();

        }else{
            $('#image_').empty();
            $('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');

            var image_path = base_url + thumbnail;

            $('#image').fileinput({
                browseLabel: 'Search',
                browseIcon: '<i class="icon-file-plus mr-2"></i>',
                uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
                removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate
                },
                initialPreview: [
                    image_path
                ],
                initialPreviewConfig: [
                    {caption: 'Image', size: 930321, key: 1, url: image_path, showDrag: false},
                ],
                initialPreviewAsData: true,
                overwriteInitial: true,
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons,
                fileActionSettings: fileActionSettings
            });

            var html = '<img src="' + image_path + '" style="width:auto;height:auto;max-width:100%;max-height:100%;" class="file-preview-image kv-preview-data">';
            $('.kv-file-content').html(html);
        }

        if(second_thumbnail==''){
            $('#second_image_').empty();
            $('#second_image_').append('<input type="file" class="file-input-overwrite" name="second_image" id="second_image"  data-fouc>');
            _componentFileUpload();

        }else{
            $('#second_image_').empty();
            $('#second_image_').append('<input type="file" class="file-input-overwrite" name="second_image" id="second_image"  data-fouc>');

            var second_image_path = base_url + second_thumbnail;

            $('#second_image').fileinput({
                browseLabel: 'Search',
                browseIcon: '<i class="icon-file-plus mr-2"></i>',
                uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
                removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate
                },
                initialPreview: [
                    second_image_path
                ],
                initialPreviewConfig: [
                    {caption: 'Image', size: 930321, key: 1, url: second_image_path, showDrag: false},
                ],
                initialPreviewAsData: true,
                overwriteInitial: true,
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons,
                fileActionSettings: fileActionSettings
            });

            var html = '<img src="' + second_image_path + '" style="width:auto;height:auto;max-width:100%;max-height:100%;" class="file-preview-image kv-preview-data">';
           // $('.kv-file-content').html(html);
           $('#second_image').find('.kv-file-content').html(html);
        }


    });

    var FormValidation = function(){
        // Validation config
        var _componentValidation = function() {
            if (!$().validate) {
                console.warn('Warning - validate.min.js is not loaded.');
                return;
            }

            // Initialize
            validator = $('.form-validate-jquery').validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-invalid-label',
                successClass: 'validation-valid-label',
                validClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                success: function(label) {
                    label.addClass('validation-valid-label').text('Success'); // remove to hide Success message
                },

                // Different components require proper error label placement
                errorPlacement: function(error, element) {

                    // Unstyled checkboxes, radios
                    if (element.parents().hasClass('form-check')) {
                        error.appendTo( element.parents('.form-check').parent() );
                    }

                    // Input with icons and Select2
                    else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                        error.appendTo( element.parent() );
                    }

                    // Input group, styled file input
                    else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                        error.appendTo( element.parent().parent() );
                    }

                    // Other elements
                    else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    name:{
                        maxlength: 50
                    },
                    description:{
                        maxlength: 512
                    },
                },
                messages: {
                    name: {
                        required: 'This field is required.'
                    },
                }
            });

            // Reset form
            $('#reset').on('click', function() {
                validator.resetForm();
            });
        };

        return {
            init: function() {
                _componentValidation();
            }
        }
    }();

    document.addEventListener('DOMContentLoaded', function() {
        FormValidation.init();
    });


    function save_Event() {

        var check = validator.checkForm();
        if (!check)
            validator.showErrors();
        else{
            var file = $("#image")[0].files[0];
            var second_file=$("#second_image")[0].files[0];
            var A = new FormData();
            A.append("id", $("#event_id").val());
            A.append("title", $("#name").val());
            A.append("status", $("#status").val());
            A.append("description", $("#description").val());
            A.append("location", $("#location").val());
            A.append("seats", $("#seats").val());
            A.append("link", $("#link").val());
            A.append("start_time", $("#start_time").val());
            A.append("end_time", $("#end_time").val());
            A.append("remind_to", $("#remind_to").val());
            A.append("homepage", $("#homepage").is(':checked')?1:0);
            if (file) {
                A.append("image", file);
            }
            if (second_file) {
                A.append("second_image", second_file);
            }
            var C = new XMLHttpRequest();
            C.open("POST", base_url + 'admin/event/insert_Event');
			C.onreadystatechange = function () {
				if (C.readyState == 4) {
					if (C.status == 200) {
						new PNotify({
							title: 'SUCCESS!',
							text: 'The Operation is correct.',
							icon: 'icon-checkmark3',
							type: 'success'
						});
					}else{
						new PNotify({
							title: 'ERROR!',
							text: 'Canot send request correct.',
							icon: 'icon-checkmark3',
							type: 'error'
						});
					}
				}
			};
            C.onload = function() {  
                location.href = base_url+'admin/event/view';
                return;
            };

            C.send(A);

        }
    }

     function backList() {
        location.href = base_url+'admin/event/view';
     }

</script>
<iframe name="_other" id="_other" hidden></iframe>




