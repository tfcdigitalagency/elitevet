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
            <h4><span class="font-weight-semibold">Manage Contracts</span></h4>
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
				<div>
				<button type="button" class="btn alpha-blue text-blue-800 border-blue-600" onclick="add_contract()"><i class="icon-plus-circle2"></i> Add New</button>
				&nbsp; &nbsp; <button type="button" class="btn btn-warning" onclick="scrap()" id="btn_demand"><i class="icon-plus-circle2"></i> Scrap Demandstar</button>
				&nbsp; &nbsp; <button type="button" class="btn btn-warning" onclick="show_scrap2()"><i class="icon-plus-circle2"></i> Scrap Bidsync</button>
				&nbsp; &nbsp; <button type="button" class="btn btn-primary" onclick="download()"><i class="icon-download"></i> Download CSV</button>
				<!--button style="float:right;" type="button" class="btn btn-success" onclick="show_token()"><i class="icon-plus-circle2"></i> Update Token</button-->
				
				</div>
				<!--button type="button" class="btn alpha-blue text-blue-800 border-blue-600" onclick="create_link()"><i class="icon-color-sampler"></i> Create Add Link</button-->
				
                <table class="table table-bordered table-hover" id="contract_datatable" width="100%">
                </table>
                
            </div>
        </div>
    </div>
    <!-- /basic modals -->
</div>
<!-- /content area -->

<!-- Broadcasting modal -->


<div id="modal_token" class="modal modal-lg fade" tabindex="-1" style="margin: 50px auto">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Update API Token</h1>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				 <form id="frm_token">
				 <input type="hidden" name="code" value="TOKEN1"/>
					<h6 class="modal-title">Update Scrap Token demandstar.com</h6>
					<div style="color:red">Notice: Because the Token always to be expired within 2 days, so you need get new token from site demandstar.com</div>
					
					<?php $detail = json_decode($token['detail'],true);?>
					<textarea rows="7" style="width:100%" name="detail"><?php echo $detail['value']?></textarea>
					
					
					<h6 class="modal-title" style="border-top:2px solid #ccc; margin-top:20px;">Update Scrap Token bidsync.com</h6>
					<div style="color:red">Notice: Because the Token always to be expired within 2 days, so you need get new token from site bidsync.com</div>
					 
					<?php $detail = json_decode($token['detail'],true);?>
					<textarea rows="7" style="width:100%" name="detail2"><?php echo $detail['value2']?></textarea>
					
					<input type="submit" value="Update" class="btn btn-success" name="cmd"/>
					<div>Last updated: <?php echo $detail['last_updated2']?></div>
					<!--div style="text-align:right"><a target="_blank" href="<?php echo site_url('/admin/webinar/guide');?>">Guide how to get Token?</a></div-->
				 </form>
			</div>
		</div>
	</div>
</div>
<!-- /success modal -->

<div id="modal_bidsync" class="modal modal-lg fade" tabindex="-1" style="margin: 50px auto">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Scrap Bidsync</h1>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				 <form id="frm_bidsync">
					  <div class="form-group row">
						<label class="col-form-label col-lg-3">Positive<span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="positive" name="positive" value="nor cal elite,disable" required>
							<div style="font-size:0.9em; color:#ccc">Input multiple values by comma</div>
						</div>
					</div>
					<!--div class="form-group row">
						<label class="col-form-label col-lg-3">Filter Out Expired Bids</label>
						<div class="col-lg-9">
							<input type="checkbox" id="filter_expired" name="filter_expired" value="1" checked /> Yes
						</div>
					</div-->
					<div class="form-group row" style="float: right;">
						<button type="button" class="btn btn-warning" onclick="scrap2()" id="btn_bids">&nbsp;Scrap Data &nbsp; </button>&nbsp&nbsp						
					</div>
					
				 </form>
			</div>
		</div>
	</div>
</div>
<!-- /success modal -->
<script>

    var $contract_datatable = $('#contract_datatable');

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        var datatableInit = function () {

            // format function for row details
            $contract_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/webinar/get_Contract",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
				{
                    "targets": [1],
                    orderable: true,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).html("<div style='width:250px; overflow:hidden!important; text-overflow: ellipsis; text-align:left'>"+rowData.title+"</div>");
                    }
                },
                {
                    "targets": [4],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if (!rowData.thumbnail || rowData.thumbnail == null || rowData.thumbnail == "") {
                            $(td).html("");
                        }else{
                            $(td).html("<img style='height: 2.5em; width: 3em;' src='"+base_url+rowData.thumbnail+"'>");
                        }
                    }
                },
                {
                    "targets": [5],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        if (parseInt(rowData.type) == 0 ) {
                            $(td).html("Link Ads");
                        }else{
                            $(td).html("Opportunities");
                        }
                    }
                },
                 
				{
                    "targets": [8],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).html("<div style='width:250px; overflow:hidden!important; text-overflow: ellipsis; text-align:left'>"+rowData.details+"</div>");
                    }
                },
                {
                    "targets": [10],
                    orderable: false,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        var html = '';
                        html +=
                            '<a style="color: deepskyblue;" title="Detail"><i class="icon-menu7"></i>Detail</a>&nbsp&nbsp'+
                            '<a style="color: deepskyblue;" title="Edit"><i class="icon-pencil7"></i>Edit</a>&nbsp&nbsp'+
                            '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';
                        $(td).html(html);
                    }
                }],
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Contract title", "data": "title", "class": "text-center", "width": "20%"},
                    {"title": "Sponsor", "data": "sponsor", "class": "text-center", "width": "5%"},
                    {"title": "Company Type", "data": "company_type_name", "class": "text-center", "width": "5%"},
                    {"title": "thumbnail", "data": "thumbnail", "class": "text-center", "width": "5%"},
                    {"title": "Content Type", "data": "thumbnail", "class": "text-center", "width": "5%"},
                    {"title": "Start Date", "data": "start_date", "class": "text-center", "width": "5%"},
                    {"title": "End Date", "data": "end_date", "class": "text-center", "width": "5%"},
                    {"title": "Details", "data": "details", "class": "text-center", "width": "20%"},
                    {"title": "Status", "data": "status", "class": "text-center", "width": "20%",
                        mRender: function(data, type, row) {
                            if (data == 'available')
                                return '<span class="badge-pill badge-info">Available</span>';
                            else
                                return '<span class="badge-pill badge-warning">Not available</span>';
                    }},
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

            $('#contract_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $contract_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/webinar/contract_edit?id='+data.id;
            });

            $('#contract_datatable tbody').on('click', 'a[title="Detail"]', function () {
                var data = $contract_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/webinar/contract_edit?id='+data.id;

            });

            $('#contract_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $contract_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/webinar/del_Contract',
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
                                    $contract_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function add_contract(){
        location.href = base_url+'admin/webinar/add';
    }
	
	var creating = 0;
	function create_link(){
		if(creating==0){
			creating = 1;
			 $.ajax({
				url: base_url+'admin/webinar/create_link',
				type : 'POST',
				data : {},
				cache: false,
				success: function(result) {
					swal(
						'Success!',
						'New link was copied in clipboard!',
						'success'
					);
					var obj = $.parseJSON(result);
					copyToClipboard(obj.url);
					creating = 0;
				}
			});
		}
	}
	
	function copyToClipboard(text) {
		if (window.clipboardData && window.clipboardData.setData) {
			// Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
			return window.clipboardData.setData("Text", text);

		}
		else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
			var textarea = document.createElement("textarea");
			textarea.textContent = text;
			textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
			document.body.appendChild(textarea);
			textarea.select();
			try {
				return document.execCommand("copy");  // Security exception may be thrown by some browsers.
			}
			catch (ex) {
				console.warn("Copy to clipboard failed.", ex);
				return prompt("Copy to clipboard: Ctrl+C, Enter", text);
			}
			finally {
				document.body.removeChild(textarea);
			}
		}
	} 
	function scrap(){
		if(creating==0){
			creating = 1;
			$('#btn_demand').text('Srawling...');
			var msg  = '';
			 $.ajax({
				url: base_url+'/cronjob/scrap',
				type : 'POST',
				data : {},
				dataType : 'json',
				cache: false,
				success: function(result) {
					creating = 0;
					$('#btn_demand').text('Scrap Demandstar');
					if(result.status ){
						if(result.status >0 ){
							msg = result.total + ' items has beed added to Database.';
						}else{
							msg = 'No new item.';
						}
						swal(
							'Success!',
							msg,
							'success'
						);
					}else{
						msg = 'Token was expired.';
						swal(
							'Error!',
							msg,
							'error'
						);
					}
										 					 
				}
			});
		}
	}
	
	function scrap2(){
		if(creating==0){
			$('#btn_bids').text('Srawling...');
			creating = 1;
			var msg  = '';
			var filter_exp = 0;
			if($('#filter_expired').is(":checked")){
				filter_exp = 1;
			}
			 $.ajax({
				url: base_url+'/cronjob/scrap_bidsync?positive='+$('#positive').val(),//+'&filter_exp='+filter_exp,
				type : 'POST',
				data : {},
				dataType : 'json',
				cache: false,
				success: function(result) {
					creating = 0;
					$('#btn_bids').text('Scrap Data');
					if(result.status ){
						if(result.status >0 ){
							msg = result.total + ' items has beed added to Database.';
						}else{
							msg = 'No new item.';
						}
						swal(
							'Success!',
							msg,
							'success'
						);
					}else{
						msg = 'Token was expired.';
						swal(
							'Error!',
							msg,
							'error'
						);
					}
										 					 
				}
			});
		}
	}
	
	function download(){
		document.location = '<?php echo site_url('/admin/webinar/download_bids')?>';
	}
	
	function show_token(){
		$("#modal_token").modal("show"); 
	}
	
	function show_scrap2(){
		$("#modal_bidsync").modal("show"); 
	}
	
	$('#frm_token').submit(function(e){
		e.preventDefault();
		$.ajax({
				url: base_url+'/admin/webinar/update_token',
				type : 'POST',
				data : $('#frm_token').serialize(),
				dataType : 'json',
				cache: false,
				success: function(result) {
					$("#modal_token").modal("hide"); 
					swal(
						'Success!',
						'Update successfully!',
						'success'
					);						
				}
			});
	});

</script>
