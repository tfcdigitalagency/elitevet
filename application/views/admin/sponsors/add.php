<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">New Sponsor</span></h4>
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
            <form id="sponsor_form" class="form-validate-jquery" method="post" target="_other">
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $data[0]['id']; ?>" hidden>                
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Sponsor Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="company" name="company" placeholder="Please Input Sponsor Name" >
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" >
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Email</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" >
                    </div>
                </div>	
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Phone</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" >
                    </div>
                </div>	
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">URL</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL" >
                    </div>
                </div>	
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Icon</label>
                    <div class="col-lg-6" id="image_">
                        <input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Status</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="status" name="status">
						<option value="0">Hide</option>
						<option value="1">Show</option>
						</select>
                    </div>
                </div>
                <div class="form-group row" style="float: right;"> 
                    <button type="button" class="btn btn-warning" onclick="backList()">&nbsp&nbspBack&nbsp&nbsp</button>&nbsp&nbsp                 
                    <button type="button" class="btn btn-primary" onclick="save_Sponsors()">&nbsp&nbspSave&nbsp&nbsp</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>
    var validator;
    var previewZoomButtonClasses;
    var previewZoomButtonIcons;
    var fileActionSettings;

    jQuery(document).ready(function() {

        $('#image_').empty();
        $('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');
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

    function save_Sponsors() {
        
        var check = validator.checkForm();
        if (!check)
            validator.showErrors();
        else{
            var file = $("#image")[0].files[0];
            var A = new FormData($('#sponsor_form')[0]);
            
            if (file) {
                A.append("icon", file);
            }           
            var C = new XMLHttpRequest();
            C.open("POST", base_url + 'admin/sponsors/insert_Sponsors');            
            C.onload = function() {              

                setTimeout(function () {
                    
                    new PNotify({
                        title: 'SUCCESS!',
                        text: 'The Operation is correct.',
                        icon: 'icon-checkmark3',
                        type: 'success'
                    });

                }, 1000)
                //location.href = base_url+'admin/sponsors/index';
                return;
            };
            C.send(A);
        }
    }

    function backList() {

        location.href = base_url+'admin/sponsors/index';
    }

</script>
<iframe name="_other" id="_other" hidden></iframe>