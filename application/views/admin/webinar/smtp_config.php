<!-- Page header -->
<div class="page-header page-header-light">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><span class="font-weight-semibold">SMTP Config</span></h4>
    </div>
  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

  <div class="card">        
    <div class="card-body">
      <form class="form-validate-jquery" method="post" target="_other"> 

        <div class="form-group row">
          <label class="col-form-label col-lg-1">SMTP Secure</label>
          <div class="col-lg-11">
            <input type="text" class="form-control" id="smtp_secure" value="<?=$smtp_secure?>" />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-lg-1">SMTP Port</label>
          <div class="col-lg-11">
            <input type="text" class="form-control" id="smtp_port" value="<?=$smtp_port?>" />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-lg-1">SMTP Host</label>
          <div class="col-lg-11">
            <input type="text" class="form-control" id="smtp_host" value="<?=$smtp_host?>" />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-lg-1">Username</label>
          <div class="col-lg-11">
            <input type="text" class="form-control" id="smtp_username" value="<?=$smtp_username?>" />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-lg-1">Password</label>
          <div class="col-lg-11">
            <input type="password" class="form-control" id="smtp_password" value="<?=$smtp_password?>" />
          </div>
        </div>

        <div class="form-group" style="text-align: right">
          <button type="button" class="btn btn-primary" onclick="save_template()">&nbsp&nbsp Save &nbsp&nbsp <i class="icon-spinner spinning hide loading"></i></button>
        </div>

      </form>
    </div>
  </div>

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

    var base_url = '<?= base_url() ?>';
    var loading = false;
    function save_template() {
      if(loading == false){
        loading = true;
        $('.loading').removeClass('hide');
        $.ajax({
            url: base_url+'admin/webinar/save_smtp',
            type : 'POST',
            data : {                
              smtp_secure: $('#smtp_secure').val(),
              smtp_port: $('#smtp_port').val(),
              smtp_host: $('#smtp_host').val(),
              smtp_username: $('#smtp_username').val(),
              smtp_password: $('#smtp_password').val()
            },
            cache: false,
            success: function(result) {
              new PNotify({
                  title: 'Success!',
                  text: 'Save Email Template Success.',
                  icon: 'icon-checkmark3',
                  type: 'success'
              });
            },
            complete: function(){
              loading = false;
              $('.loading').addClass('hide');
            }
        });
      }
    }

</script>