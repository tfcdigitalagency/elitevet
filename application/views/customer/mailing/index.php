
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">

                    <!-- Layout 1 -->
                    <div class="mb-3">

                        <h1 class="mb-0 font-weight-semibold" style="color:red">
                            EliteNCDVeterans
                        </h1> 
						
                    </div>
                    <div class="row">
						<div class="col-md-12">



						</div>
					</div>
                    <div class="row">
						<div class="col-md-12">

							<!-- Blog layout #1 with video -->
							<div class="card">
								<div class="card-body">
									<div>
										<button type="button" class="btn btn-outline-primary">Add Contact</button>&nbsp&nbsp&nbsp
										<button type="button" class="btn btn-outline-primary">Send SMS</button>&nbsp&nbsp&nbsp
										<button type="button" class="btn btn-outline-primary">Send Email</button>&nbsp&nbsp&nbsp
										<button type="button" class="btn btn-outline-primary">Email templates</button>&nbsp&nbsp&nbsp
										<button type="button" class="btn btn-outline-primary">Set Schedule</button>
									</div>

								</div>

								<div class="card-footer bg-transparent d-sm-flex justify-content-sm-between align-items-sm-center border-top-0 pt-0 pb-3">
									<div class="card" style="width: 100%;">
										<div class="card-header header-elements-inline" style="background-color: cornflowerblue;">
											<h5 class="card-title">Panel</h5>											
										</div>

										<div class="card-body">
											<div class="table-responsive">
			                                    <table class="table table-bordered" id="mailing_datatable">
			                                    </table>
			                                </div>
										</div>
									</div>
								</div>
							</div>
							<!-- /blog layout #1 with video -->

						</div>
					</div>

                    
                    <!-- /layout 1 -->
                   	
                    <p style="height: 30px;"></p>
                    <div class="mb-3">
                        <h1 class="mb-0 font-weight-semibold" style="color:red">
                            EliteNCDVeterans
                        </h1>
                    </div>

                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>
</div>

<script>
    
    var $mailing_datatable = $('#mailing_datatable');  

    jQuery(document).ready(function() {        

        var datatableInit = function () {

            // format function for row details
            $mailing_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "customer/mailing/get_Mailing",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
                {
                    orderable: false,
                    "targets": [5]
                }],
                "columns": [
                    {"title": "$.No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "First Name", "data": "first_name", "class": "text-center", "width": "10%"},
                    {"title": "Last Name", "data": "last_name", "class": "text-center", "width": "10%"},
                    {"title": "Email", "data": "email", "class": "text-center", "width": "10%"},
                    {"title": "Phone", "data": "phone_number", "class": "text-center", "width": "10%"},
                    {"title": "Selected", "data": "id", "class": "text-center", "width": "10%"},
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
        });

    });

</script>
