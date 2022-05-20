<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Edit/Detail Contract</span></h4>
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
				<input type="text" class="form-control" id="contract_id" name="contract_id" value="<?php echo $data[0]['id']; ?>" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Opportunity Title<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="title" name="title" value="<?php echo $data[0]['title']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="description" name="description" placeholder="Please Input Description" ><?php echo $data[0]['details']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Company<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="company" name="company" value="<?php echo $data[0]['company']; ?>" placeholder="Please input company name" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Name<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo $data[0]['name']; ?>" placeholder="Please enter Name" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="email" class="form-control" id="email" name="email" value="<?php echo $data[0]['email']; ?>" placeholder="Please enter Email" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Phone</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data[0]['phone']; ?>" placeholder="Please enter Phone number" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Sponsor</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="sponsor" name="sponsor" value="<?php echo $data[0]['sponsor']; ?>" placeholder="Website Link" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Post Start Date<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control pickadate" value="<?php echo $data[0]['start_date']; ?>"  id="start_date" name="start_date" placeholder="" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Post End Date<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control pickadate" id="end_date" name="end_date" value="<?php echo $data[0]['end_date']; ?>" placeholder="" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Thumbnail</label>
					<div class="col-lg-6" id="image_">
						<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Include attachment (PDF/JPG</label>
					<div class="col-lg-6" id="second_image_">
						<input type="file" class="file-input-overwrite" name="second_image" id="second_image"  data-fouc>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-form-label col-lg-2">Status</label>
					<div class="col-lg-4" style="float: right">
						<select  class="form-control select" id="status" name="status" required data-fouc>
							<option value="available" <?php echo  ($data[0]['status'] == 'available')?"selected":"";?>>available</option>
							<option value="not available" <?php echo  ($data[0]['status'] == 'available')?"":"selected";?>>not available</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Content Type</label>
					<div class="col-lg-4" style="float: right">
						<select  class="form-control select" id="type" name="type" required data-fouc>
							<option value="0" <?php echo (intval($data[0]['type']) == 0)?"selected":"";?>>Link Ads</option>
							<option value="1" <?php echo (intval($data[0]['type']) == 0)?"":"selected";?>>Opportunities</option>
						</select>
					</div>
				</div>
				<div class="form-group row" style="float: right;">
					<button type="button" class="btn btn-warning" onclick="backList()">&nbsp&nbspBack&nbsp&nbsp</button>&nbsp&nbsp
					<button type="button" class="btn btn-primary" onclick="save_Contract()">&nbsp&nbspSave&nbsp&nbsp</button>
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
        //$('#status').val('<?php echo $data[0]['thumbnail']; ?>').trigger("change");
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

            var image_path = base_url + second_thumbnail;

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

			if(checkURLImage(second_thumbnail)){
				var html = '<img src="' + image_path + '" style="width:auto;height:auto;max-width:100%;max-height:100%;" class="file-preview-image kv-preview-data">';
			}else{
				var filename = second_thumbnail.replace(/^.*[\\\/]/, '')
				var html = '<span>'+filename+'</span>';
			}

            //$('.kv-file-content').html(html);
            $('#second_image_').find('.kv-file-content').html(html);
        }

    });

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
                    sponsor: {
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

    function save_Contract() {

        var check = validator.checkForm();
        if (!check)
            validator.showErrors();
        else{
            var file = $("#image")[0].files[0];
            var second_file = $("#second_image")[0].files[0];
            var A = new FormData();
            A.append("id", $("#contract_id").val());
            A.append("title", $("#title").val());
            A.append("details", $("#description").val());
			A.append("company", $("#company").val());
			A.append("name", $("#name").val());
			A.append("email", $("#email").val());
			A.append("phone", $("#phone").val());
			A.append("start_date", $("#start_date").val());
			A.append("end_date", $("#end_date").val());
            A.append("sponsor", $("#sponsor").val());
            A.append("status", $("#status").val());
            A.append("type", $("#type").val());
            if (file) {
                A.append("thumbnail", file);
            }
            if (second_file) {
                A.append("second_thumbnail", second_file);
            }
            var C = new XMLHttpRequest();
            C.open("POST", base_url + 'admin/webinar/insert_Contract');
            C.onload = function() {

                setTimeout(function () {

                    new PNotify({
                        title: 'SUCCESS!',
                        text: 'The Operation is correct.',
                        icon: 'icon-checkmark3',
                        type: 'success'
                    });

                }, 1000)
                location.href = base_url+'admin/webinar/postbids';
                return;
            };

            C.send(A);

        }
    }

     function backList() {
        location.href = base_url+'admin/webinar/postbids';
     }

	function checkURLImage(url) {
		return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>




