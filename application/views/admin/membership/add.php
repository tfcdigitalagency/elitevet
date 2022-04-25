<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">New Membership</span></h4>
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
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $data[0]['id']; ?>" hidden>                
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Membership Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="name" placeholder="Please Input Membership Name" required>
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Cost</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="cost" placeholder="Please Input Membership Cost" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Details</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="details" placeholder="Please Input Membership Details" >
                    </div>
                </div>
                <div class="form-group row" style="float: right;"> 
                    <button type="button" class="btn btn-warning" onclick="backList()">&nbsp&nbspBack&nbsp&nbsp</button>&nbsp&nbsp                 
                    <button type="button" class="btn btn-primary" onclick="save_Membership()">&nbsp&nbspSave&nbsp&nbsp</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>
    var validator;

    // Bootstrap file upload

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

    function save_Membership() {
        
        var check = validator.checkForm();
        if (!check)
            validator.showErrors();
        else{
            var A = new FormData();
            A.append("id", $("#id").val());
            A.append("name", $("#name").val());
            A.append("cost", $("#cost").val());
            A.append("details", $("#details").val());       
            var C = new XMLHttpRequest();
            C.open("POST", base_url + 'admin/membership/insert_Membership');            
            C.onload = function() {              

                setTimeout(function () {
                    
                    new PNotify({
                        title: 'SUCCESS!',
                        text: 'The Operation is correct.',
                        icon: 'icon-checkmark3',
                        type: 'success'
                    });

                }, 1000)
                location.href = base_url+'admin/membership/index';
                return;
            };
            C.send(A);
        }
    }

    function backList() {

        location.href = base_url+'admin/membership/index';
    }

</script>
<iframe name="_other" id="_other" hidden></iframe>