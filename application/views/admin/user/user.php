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

            <h4><span class="font-weight-semibold">Manage Users</span></h4>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

        </div>

    </div>

</div>

<!-- /page header -->



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



<!-- Content area -->

<div class="content">



    <div class="card">

        <div class="card-body">

            Check user:

            <select id="check-user" class="form-control" style="width: auto; display: inline-block; vertical-align: middle;">

                <optgroup label="Check user">

                    <option value="check-all">Check all users</option>

                    <option value="check-coporate">Check Coporate users only</option>

                    <option value="check-veteran">Check Veteran users only</option>

                    <option value="check-disable">Check Disable Vet users only</option>

                    <option value="check-other">Check Other users only</option>

                    <option value="check-membership">Check membership users only</option>

                </optgroup>

                <optgroup label="Uncheck user">

                    <option value="uncheck-all">Uncheck all users</option>

                    <option value="uncheck-coporate">Uncheck Coporate users only</option>

                    <option value="uncheck-veteran">Uncheck Veteran users only</option>

                    <option value="uncheck-disable">Uncheck Disable Vet users only</option>

                    <option value="uncheck-other">Uncheck Other users only</option>

                    <option value="uncheck-membership">Uncheck membership users only</option>

                </optgroup>

            </select>

            <button class="btn btn-primary" id="set-check-user">&nbsp&nbsp SET &nbsp&nbsp <i class="icon-spinner spinning hide loading"></i></button>

        </div>

    </div>



    <!-- Basic modals -->

    <div class="card">

        <div class="card-body">

            <div class="col-md-12">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_user">&nbsp&nbsp NEW USER &nbsp&nbsp</button>

				&nbsp;&nbsp;<a class="btn btn-warning" href="<?php echo site_url('/admin/user/import');?>">Import Users</a>

                <table class="table table-bordered table-hover" id="user_datatable" width="100%">

                </table>

            </div>

        </div>

    </div>

    <!-- /basic modals -->

</div>

<!-- /content area -->



<!-- Primary modal -->

<div id="modal_theme_primary" class="modal fade">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h6 class="modal-title"></h6>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>



            <form class="form-validate-jquery" method="post">

                <div class="modal-body">

                    <input type="text" class="form-control" id="id" name="id" hidden>

                    <div class="form-group row">

                        <div class="col-sm-6">

                            <label>Name:</label>

                            <input type="text" id="name" name="name" placeholder="Name" class="form-control" required>

                        </div>

                        <div class="col-sm-6">

                            <label>Phone Number:</label>

                            <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">

                            <label>E-mail:</label>

                            <input type="text" id="email" name="email" placeholder="E-mail" class="form-control" required>

                        </div>

                        <div class="col-sm-6">

                            <label>Role:</label>
							<select id="is_admin" name="is_admin" class="form-control">

								<option class="role_0" value="0">User</option>
								<option class="role_1" value="1">Admin</option>
								<option class="role_2" value="2">Host</option>
								<option class="role_3" value="3">Email admin</option>

							</select>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">

                            <label>Title:</label>

                            <select id="title" name="title" class="form-control">

                            	<option value="Corporate">Corporate</option>

                            	<option value="Veteran">Veteran</option>

                            	<option value="Disabled Vet">Disabled Vet</option>

                            	<option value="Other">Other</option>

                            </select>

                        </div>

                        <div class="col-sm-6">

                            <label>Company:</label>

                            <input type="text" id="company" name="company" placeholder="Company" class="form-control">

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-sm-12">

                            <label>Membership:</label>

                            <select class="form-control" id="membership_id">

                                <?php for($k=0;$k<count($membership);$k++){?>

                                    <option value="<?=$membership[$k]['id']?>"><?php echo $membership[$k]['name']?></option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <!-- <div class="form-group row">

                        <div class="col-sm-6">

                            <label>Registered Webinars:</label>

                            <input type="text" id="registered_webinars" name="registered_webinars" placeholder="Registered Webinars" class="form-control">

                        </div>

                        <div class="col-sm-6">

                            <label>Attended Webinars:</label>

                            <input type="text" id="attended_webinars" name="attended_webinars" placeholder="Attended Webinars" class="form-control">

                        </div>

                    </div> -->

                    <!-- <div class="form-group row">

                        <div class="col-sm-6">

                            <label>Password:</label>

                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>

                        </div>

                        <div class="col-sm-6">

                            <label>Confirm Password:</label>

                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>

                        </div>

                    </div> -->

                </div>



                <div class="modal-footer">

                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

                    <button type="button" class="btn bg-primary" onclick="save_User()">Save</button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- /primary modal -->



<!-- Add user modal -->

<div id="modal_add_user" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h6 class="modal-title">Add new user</h6>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>





            <div class="modal-body">



                <div class="form-group">

                    <label>Email <span style="color: red">*</span></label>

                    <input type="text" id="add_email" class="form-control">

                </div>



                <div class="form-group">

                    <label>Password <span style="color: red">*</span></label>

                    <input type="password" id="add_password" class="form-control">

                </div>



                <div class="form-group">

                    <label>Name <span style="color: red">*</span></label>

                    <input type="text" id="add_name" class="form-control">

                </div>



                <div class="form-group">

                    <label>Phone number</label>

                    <input type="text" id="add_phonenumber" class="form-control">

                </div>



                <div class="form-group">

                    <label>Title</label>

                    <select id="add_title" class="form-control">

                        <option value="Corporate">Corporate</option>

                        <option value="Veteran">Veteran</option>

                        <option value="Disabled Vet">Disabled Vet</option>

                        <option value="Other">Other</option>

                    </select>

                </div>



                <div class="form-group">

                    <label>Company</label>

                    <input type="text" id="add_company" class="form-control">

                </div>



                <div class="form-group">

                    <label>Role</label>

                    <select id="add_admin" class="form-control">
						<option class="role_0" value="0">User</option>
						<option class="role_1" value="1">Admin</option>
						<option class="role_2" value="2">Host</option>
						<option class="role_3" value="3">Email admin</option>
                    </select>

                </div>



                <p style="color: red" id="add_error"></p>



            </div>



            <div class="modal-footer">

                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

                <button type="button" class="btn bg-primary" id="add_user" >Add <i class="icon-spinner spinning hide add-loading"></i></button>

            </div>



        </div>

    </div>

</div>

<!-- /Add user modal -->



<script>



    var $user_datatable = $('#user_datatable');



    function isEmail(email) {

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        return regex.test(email);

    }



    jQuery(document).ready(function() {

        $('.pickadate-year').pickadate({

            format : 'yyyy-mm-dd'

        });



        $('#set-check-user').click(function(){

            var select = $('#check-user').val();

            $('.loading').removeClass('hide');

                $.ajax({

                url: base_url+'admin/user/check_user',

                type : 'POST',

                data : {

                  select: select

                },

                dataType: 'json',

                success: function(result) {

                    if(result.status == 'success'){

                        new PNotify({

                          title: 'Success!',

                          icon: 'icon-checkmark3',

                          type: 'success'

                        });

                        setTimeout(function() {

                            location.href = base_url+'admin/user/user';

                        },2000);

                    }else{

                        new PNotify({

                          title: 'Error!',

                          text: 'Something wrong with backend!',

                          icon: 'icon-notification2',

                          type: 'danger'

                        });

                    }

                },

                complete: function(){

                  $('.loading').addClass('hide');

                }

            });



        });



        $('#add_user').click(function(){



            var email = $('#add_email').val();

            var password = $('#add_password').val();

            var name = $('#add_name').val();

            var phonenumber = $('#add_phonenumber').val();

            var title = $('#add_title').val();

            var company = $('#add_company').val();

            var admin = $('#add_admin').val();



            $('#add_error').html('');



            var error = '';



            if(email == '' | !isEmail(email)){

                error += "Your email is invalid</br>";

            }

            if(password == ''){

                error += "Your password should not be empty</br>";

            }

            if(name == ''){

                error += "Your name should not be empty</br>";

            }



            if(error != ''){

                $('#add_error').html(error);

                return;

            }



            $('.add-loading').removeClass('hide');



            $.ajax({

                url: base_url+'admin/user/add_user',

                type : 'POST',

                data : {

                    email: email,

                    password: password,

                    name: name,

                    phonenumber: phonenumber,

                    title: title,

                    company: company,

                    admin: admin

                },

                dataType: 'json',

                success: function(result) {

                    if(result.status == 'success'){

                        new PNotify({

                          title: 'Success!',

                          icon: 'icon-checkmark3',

                          type: 'success'

                        });

                        $('#modal_add_user').modal('hide');

                        setTimeout(function() {

                            location.href = base_url+'admin/user/user';

                        },2000);

                    }else if(result.status == 'error'){

                        new PNotify({

                          title: 'Error!',

                          text: result.error,

                          icon: 'icon-notification2',

                          type: 'danger'

                        });

                    }else{

                        new PNotify({

                          title: 'Error!',

                          text: 'Something wrong with backend!',

                          icon: 'icon-notification2',

                          type: 'danger'

                        });

                    }

                },

                error: function(){

                    new PNotify({

                        title: 'Error!',

                        text: 'Something wrong with backend!',

                        icon: 'icon-notification2',

                        type: 'danger'

                    });

                },

                complete: function(){

                  $('.add-loading').addClass('hide');

                }

            });



        });



        var datatableInit = function () {



            // format function for row details

            $user_datatable.dataTable({

                "ordering": true,

                "info": true,

                "searching": true,

                "ajax": {

                    "type": "POST",

                    "async": true,

                    "url": base_url + "admin/user/get_User",

                    "data": {},

                    "dataSrc": "data",

                    "dataType": "json",

                    "cache": false,

                },

                "columnDefs": [

                {

                    orderable: true,

                    "targets": [3],

                    "createdCell": function (td, cellData, rowData, row, col) {

                        var html = '';

                        if (rowData.membership_id == 0 | rowData.membership_id == null){



                            html = 'non-member';

                        }

                        else{

                            html = rowData.membership;

                        }

                        $(td).html(html);

                    }

                },

                {

                    orderable: false,

                    "targets": [7],

                    "createdCell": function (td, cellData, rowData, row, col) {

                        var html = '';

                        if (rowData.is_checked == 0){



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

						"targets": [8],

						"createdCell": function (td, cellData, rowData, row, col) {

							var html = '';

							if (rowData.subscribe == 0){



								html = '<a onclick="update_Check(1,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input">No</label></div></a>';

							}

							else{

								html = '<a onclick="update_Check(0,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" checked="">Yes</label></div></a>';

							}

							$(td).html(html);

						}

					},
                {

                    "targets": [9],

                    orderable: false,

                    "createdCell": function (td, cellData, rowData, row, col) {

                        var html = '';

                        if (cellData == null || cellData == ''){

                            var pdf_link = '';

                        }else{

                            var pdf_link = base_url +'assets/uploads/pdf/'+ cellData;

							html += '<a target="_blank" href="'+pdf_link+'"  style="color: deepskyblue;text-decoration:underline">Click here to see</a>';

                        }



                        $(td).html(html);

                    }

                },

                {

                    "targets": [10],

                    orderable: false,

                    "createdCell": function (td, cellData, rowData, row, col) {

                        var html = '';

                        html +=

                            '<a href="'+base_url+'admin/user/display_reg_History?id='+rowData.id+'" style="color: deepskyblue;text-decoration:underline">'+cellData+'</a>';

                        $(td).html(html);

                    }

                },

                {

                    "targets": [11],

                    orderable: false,

                    "createdCell": function (td, cellData, rowData, row, col) {

                        var html = '';

                        html +=

                            '<a href="'+base_url+'admin/user/display_attend_History?id='+rowData.id+'" style="color: deepskyblue;text-decoration:underline">'+cellData+'</a>';

                        $(td).html(html);

                    }

                },

                {

                    "targets": [12],

                    orderable: false,

                    "createdCell": function (td, cellData, rowData, row, col) {

                        var html = '';

                        html +=

                            '<a style="color: deepskyblue;" title="Edit"><i class="icon-pencil7"></i>Edit</a>&nbsp&nbsp'+

                            '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';

                        $(td).html(html);

                    }

                }],

                "columns": [

                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},

                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},

                    {"title": "Email", "data": "email", "class": "text-center", "width": "10%"},

                    {"title": "Membership", "data": "membership", "class": "text-center", "width": "10%"},

                    {"title": "Phone Number", "data": "phone_number", "class": "text-center", "width": "10%"},

                    {"title": "Title", "data": "title", "class": "text-center", "width": "10%"},

                    {"title": "Company", "data": "company", "class": "text-center", "width": "10%"},

                    {"title": "Select User", "data": "is_checked", "class": "text-center", "width": "10%"},
                    {"title": "Subscribe", "data": "subscribe", "class": "text-center", "width": "10%"},

                    {"title": "Capability Statement Pdf", "data": "capability_statement_pdf", "class": "text-center", "width": "10%"},

                    {"title": "Registered webinars", "data": "real_register", "class": "text-center", "width": "5%"},

                    {"title": "Attended Webinars", "data": "real_attend", "class": "text-center", "width": "5%"},

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



            $('#user_datatable tbody').on('click', 'a[title="Edit"]', function () {

                var data = $user_datatable.fnGetData($(this).parents('tr')[0]);



                $('#id').val(data.id);

                $('#name').val(data.name);

                $('#email').val(data.email);

                $('#phone_number').val(data.phone_number);

                $('#title').val(data.title);

                $('#company').val(data.company);

                $('#membership_id').val(data.membership_id).trigger("change");

                $('#registered_webinars').val(data.registered_webinars);

                $('#attended_webinars').val(data.attended_webinars);

				$('#is_admin').val(data.is_admin);



                // $('#password').val("");

                // $('#confirm_password').val("");



                $('.modal-title').html("Edit User");

                $('#modal_theme_primary').modal();

            });



            $('#user_datatable tbody').on('click', 'a[title="Delete"]', function () {

                var data = $user_datatable.fnGetData($(this).parents('tr')[0]);



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

                                url: base_url+'admin/user/del_User',

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

                                    $user_datatable.DataTable().ajax.reload();

                                }

                            });

                        }

                    }

                );

            });

        });



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

                    confirm_password: {

                        equalTo: '#password'

                    },

                    name:{

                        maxlength: 50

                    },

                },

                messages: {

                    name: {

                        required: 'This field is required.'

                    },

                    phone_number: {

                        required: 'This field is required.'

                    },

                    email: {

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



    function update_Check(state,id) {



        if(state==0){



            $.ajax({

                url: base_url+'admin/user/update_Ischecked',

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



            $.ajax({

                url: base_url+'admin/user/update_Ischecked',

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

                }

            });

        }

        $user_datatable.DataTable().ajax.reload();

       // setTimeout(function(){

       //      location.reload();



       //  }, 2000);

    }



    function save_User() {



        var check = validator.checkForm();

        if (!check)

            validator.showErrors();

        else{

            var A = new FormData();

            A.append("id", $("#id").val());

            A.append("name", $("#name").val());

            A.append("phone_number", $("#phone_number").val());

            A.append("title", $("#title").val());

            A.append("company", $("#company").val());

            A.append("email", $("#email").val());

            A.append("membership_id", $("#membership_id").val());

            A.append("is_admin", $("#is_admin").val());



            var C = new XMLHttpRequest();

            C.open("POST", base_url + 'admin/user/insert_User');
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

                $('#modal_theme_primary').modal('hide');

				$user_datatable.DataTable().ajax.reload();

                return;

            };

            C.send(A);

        }

    }



</script>
