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
            <h4><span class="font-weight-semibold">User Import</span></h4>
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
            <div class="col-md-4">              
                   <form action="<?php echo site_url('marketing/user/import')?>" method="post" enctype="multipart/form-data">
				   
				   <h3>
				   Please upload user excel file. <br>You can <a href="/assets/user_marketing_import.xls">Download</a> template file here
				   </h3>
				<div class="form-group mb-3">
					<div class="mb-3">
						<input type="file" name="userfile" class="form-control" id="userfile">
					</div>					   
				</div>
				<div class="d-grid mb-3">
					<input type="submit" name="submit" value="Upload" class="btn btn-dark" />
				</div>
				<div>
					<div style="color:red"><?php echo $this->session->flashdata('error');?></div>
				    <div style="color:blue"><?php echo $this->session->flashdata('message');?></div>
				</div>
					</form>
            </div>  
        </div>
    </div>
    <!-- /basic modals -->    
</div>
<!-- /content area -->

