<!-- Page header -->
<style>
#files-area {
  
}
.file-block {
  border-radius: 10px;
  background-color: rgba(144, 163, 203, 0.2);
  margin: 5px;
  color: initial;
  display: inline-flex;
}
.file-block > span.name {
  padding-right: 10px;
  width: max-content;
  display: inline-flex;
}
.file-delete {
  display: flex;
  width: 24px;
  color: initial;
  background-color: #6eb4ff00;
  font-size: large;
  justify-content: center;
  margin-right: 3px;
  cursor: pointer;
}
.file-delete:hover {
  background-color: rgba(144, 163, 203, 0.2);
  border-radius: 10px;
}
.file-delete > span {
  transform: rotate(45deg);
}

</style>
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">New Evnt Activity</span></h4>
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
            <form id="sponsor_form" class="form-validate-jquery" method='post' action='<?php echo site_url("admin/activity/insert_Activity")?>' enctype='multipart/form-data'>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $data[0]['id']; ?>" hidden>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Title</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Time</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="year" name="year" placeholder="Year" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Content</label>
                    <div class="col-lg-10">
                        <textarea rows="4" class="form-control" id="content" name="content"></textarea>
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-form-label col-lg-2">Images</label>
                    <div class="col-lg-10">
                       <p class="mt-5">
						<label for="attachment">
							<a class="btn btn-primary text-light" role="button" aria-disabled="false">+ Add Image</a>
							
						</label>
						<input type="file" accept="image/*" name="file[]" id="attachment" style="visibility: hidden; position: absolute;" multiple/>
						
					</p>
					<p id="files-area">
						<span id="filesList">
							<span id="files-names"></span>
						</span>
					</p>
                    </div>
                </div>				 
                <div class="form-group row" style="float: right;">
                    <button type="button" class="btn btn-warning" onclick="backList()">&nbsp&nbspBack&nbsp&nbsp</button>&nbsp&nbsp
                    <button type="submit" class="btn btn-primary">&nbsp&nbspSave&nbsp&nbsp</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>
    var validator;
     
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

    function save_Activity() {

        var check = validator.checkForm();
        if (!check)
            validator.showErrors();
        else{
            
            var C = new XMLHttpRequest();
            C.open("POST", base_url + 'admin/activity/insert_Activity');
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
            C.send(A);
        }
    }

    function backList() {

        location.href = base_url+'admin/activity/index';
    }

</script>
<iframe name="_other" id="_other" hidden></iframe>
<script>
const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

$("#attachment").on('change', function(e){
	for(var i = 0; i < this.files.length; i++){
		let fileBloc = $('<span/>', {class: 'file-block'}),
			 fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
		fileBloc.append('<span class="file-delete"><span>+</span></span>')
			.append(fileName);
		$("#filesList > #files-names").append(fileBloc);
	};
	// Ajout des fichiers dans l'objet DataTransfer
	for (let file of this.files) {
		dt.items.add(file);
	}
	// Mise à jour des fichiers de l'input file après ajout
	this.files = dt.files;

	// EventListener pour le bouton de suppression créé
	$('span.file-delete').click(function(){
		let name = $(this).next('span.name').text();
		// Supprimer l'affichage du nom de fichier
		$(this).parent().remove();
		for(let i = 0; i < dt.items.length; i++){
			// Correspondance du fichier et du nom
			if(name === dt.items[i].getAsFile().name){
				// Suppression du fichier dans l'objet DataTransfer
				dt.items.remove(i);
				continue;
			}
		}
		// Mise à jour des fichiers de l'input file après suppression
		document.getElementById('attachment').files = dt.files;
	});
});
</script>