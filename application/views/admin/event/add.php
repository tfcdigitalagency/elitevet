<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">New Event</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <?php
        $today = new DateTime();
        $tomorrow = $today->modify('+1 day');
    ?>

    <!-- Basic modals -->
    <div class="card">        
        <div class="card-body">
        	<form class="form-validate-jquery" method="post" target="_other">
        		<input type="text" class="form-control" id="event_id" name="event_id" value="<?php echo $data[0]['id']; ?>" hidden>
	            <div class="form-group row">
					<label class="col-form-label col-lg-2">Title<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="title" " required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="description" placeholder="Please Input Description" ></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Location<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="location"  required>
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Start time</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-calendar3"></i></span>
                            </span>
                            <input type="text" class="form-control" id="start_time" value="<?=$tomorrow->format('Y-m-d 10:00')?>">
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
                            <input type="text" class="form-control" id="end_time" value="">
                            <span style="display: inline-block; vertical-align: middle; margin-left: 10px; line-height: 36px">PT</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Register Link</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="link" value="">
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
                    <div class="col-lg-6" id="image_">
                        <input type="file" class="file-input-overwrite" name="second_image" id="second_image"  data-fouc>
                    </div> 
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Auto remind</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="remind_to">
                        	<option value="all">All</option>
                        	<option value="admin_only">Admin only</option>
                        	<option value="membership_only">Membership only</option>
                        	<option value="none">None</option>
                        </select>
                    </div> 
                </div>
				<div class="form-group row" style="float: right;">					
					<button type="button" class="btn btn-primary" onclick="save_Event()">&nbsp&nbspSave&nbsp&nbsp <i class="icon-spinner spinning hide loading"></i></button>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<style>
.spinning{
    animation: fa-spin 2s linear infinite;
}
@-webkit-keyframes fa-spin {
 0% {
  -webkit-transform:rotate(0deg);
  transform:rotate(0deg)
 }
 to {
  -webkit-transform:rotate(1turn);
  transform:rotate(1turn)
 }
}
.hide{
    display:  none;
}
</style>

<script>
    var validator;
    var previewZoomButtonClasses;
    var previewZoomButtonIcons;
    var fileActionSettings;

    $('#start_time').AnyTime_picker({
        format: '%Z-%m-%d %H:%i',
        earliest: new Date()
    });

    $('#end_time').AnyTime_picker({
        format: '%Z-%m-%d %H:%i',
        earliest: new Date()
    });

    jQuery(document).ready(function() {

        $('#image_').empty();
        $('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');

        $('#second_image_').empty();
        $('#second_image_').append('<input type="file" class="file-input-overwrite" name="second_image" id="second_image"  data-fouc>');
        _componentFileUpload();

    });

    

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

    var FormValidation = function() {
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
                    location: {
                        required: 'This field is required.'
                    }                   
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
            $('.loading').removeClass('hide');
            var file = $("#image")[0].files[0];
            var second_file=$("#second_image")[0].files[0];
            console.log(file);
            var A = new FormData();
            A.append("id", $("#event_id").val());
            A.append("title", $("#title").val());
            A.append("description", $("#description").val());
            A.append("location", $("#location").val());
            A.append("link", $("#link").val());
            A.append("start_time", $("#start_time").val());
            A.append("end_time", $("#end_time").val());
            A.append("remind_to", $("#remind_to").val());
            if (file) {
                A.append("image", file);
            } 
            if (second_file) {
                A.append("second_image", second_file);
            }            
            var C = new XMLHttpRequest();
            C.open("POST", base_url + 'admin/event/insert_Event');            
            C.onload = function() {              

                setTimeout(function () {
                    
                    new PNotify({
                        title: 'SUCCESS!',
                        text: 'The Operation is correct.',
                        icon: 'icon-checkmark3',
                        type: 'success'
                    });

                }, 1000)
                $('.loading').addClass('hide');
                location.href = base_url+'admin/event/view';
                return;
            };
            C.send(A);
        }
    }

</script>
<iframe name="_other" id="_other" hidden></iframe>