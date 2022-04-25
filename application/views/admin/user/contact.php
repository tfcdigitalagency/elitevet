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
            <h4><span class="font-weight-semibold">User Details</span></h4>
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
                <div class="form-group row">
                    <label class="col-form-label col-lg-4">Select User</label>
                    <div class="col-lg-8">
                        <select class="form-control" onchange="filter_User()" id="sel_user">
                            <option value="-1" <?=($sel_id=='-1')?'selected':''?>>All</option>
                            <?php for($k=0;$k<count($user);$k++){?>
                                <option value="<?=$user[$k]['id']?>" <?=($user[$k]['id']==$sel_id)?'selected':''?>><?php echo $user[$k]['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>                    
            </div>
            <div class="col-md-12">               
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th> 
                                <th>Title</th>
                                <th>Attended</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($k=0;$k<count($contact);$k++){?>

                                <tr>
                                    <td><?=$k+1?></td>
                                    <td><?=$contact[$k]['first_name']?></td>
                                    <td><?=$contact[$k]['last_name']?></td>
                                    <td><?=$contact[$k]['email']?></td>
                                    <td><?=$contact[$k]['phone_number']?></td>                                    
                                    <td><?=$contact[$k]['company']?></td>
                                    <td><?=$contact[$k]['title']?></td>
                                    <td></td>
                                </tr>

                            <?php } ?>                                                                                
                        </tbody>
                    </table>
                </div>
                            
            </div>
        </div>
    </div>
    <!-- /basic modals -->    
</div>
<!-- /content area -->


<script>

    function filter_User(){
        //alert($('#sel_user').val());
        //$('#sel_user').val(2).trigger("change");
        location.href = base_url+'admin/user/get_Contact?id='+$('#sel_user').val();
    }

</script>