<?php date_default_timezone_set('America/Vancouver'); ?>

<!-- Page header -->
<div class="page-header page-header-light">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><span class="font-weight-semibold">Control webinar</span></h4>
    </div>
  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

  <div class="card"> 
    <div class="card-header bg-white header-elements-inline">
      <h6 class="card-title">Video control</h6>
    </div>      
    <div class="card-body">

      <?php
          $event_name = '';
          $has_event = 0;
          if(count($event) > 0){
              $event = $event[0];
              $has_event = 1;
              $now = date("Y-m-d H:i:s");
      ?>
        <div class="alert alert-success timeleft"></div>
        <br>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input display_zoom" <?=$display_zoom=="1"?"checked='checked'":""?>>Display zoom video
          </label>
        </div>
        <br>
        <button class="btn btn-danger end-webinar">END WEBINAR</button>
        <br>
        <script>
            
            var now = moment('<?=$now?>','YYYY-MM-DD HH:mm:ss');
            var live = moment('<?=$event["start_time"]?>','YYYY-MM-DD HH:mm');
            var timeleft = '';
            var duration = live.diff(now,'seconds');
            getTimeLeft();
            setInterval(function(){
                if(duration >= 0){
                    getTimeLeft();
                }
                duration -= 1;
            }, 1000);
            getTimeLeft();
            function getTimeLeft(){
                
                if(duration > 0){
                    var d = h = m = s = 0;
                    var totalSeconds = duration;
                    d = Math.floor(totalSeconds / 86400);
                    totalSeconds %= 86400

                    h = Math.floor(totalSeconds / 3600);
                    totalSeconds %= 3600;

                    m = Math.floor(totalSeconds / 60);
                    s = totalSeconds % 60;

                    var ds = d < 2 ? (d + " day ") : (d + " days ");
                    var hs = h < 2 ? (h + " hour ") : (h + " hours ");
                    var ms = m < 2 ? (m + " min ") : (m + " mins ");
                    var ss = s < 2 ? (s + " second ") : (s + " seconds ");

                    timeleft = ss;
                    if(d > 0 | h > 0 | m > 0) timeleft = ms + timeleft;
                    if(d > 0 | h > 0) timeleft = hs + timeleft;
                    if(d > 0) timeleft = ds + timeleft;

                    $('.timeleft').html("The webinar <strong><?=$event['name']?></strong> will be started after " + timeleft + "...");
                }else{
                    $('.timeleft').html("The webinar <strong><?=$event['name']?></strong> is started");
                }
            }
        </script>
      <?php
          }else{
      ?>
        <em>You do not have any upcoming webinar</em>
      <?php
          }
      ?>

    </div>
  </div>

  <div class="card"> 
    <div class="card-header bg-white header-elements-inline">
      <h6 class="card-title">Upload image</h6>
    </div>      
    <div class="card-body">
      <div class="row">
        <div class="col-sm-6">
          <h5>Logo image</h5>
          <img src="<?=base_url().$logo_image?>" alt="" />
          <br><br>
          <input type="file" class="file-input-overwrite" name="image" id="logoImage" >
          <div style="text-align: right; margin-top: 20px">
            <button class="btn btn-danger" id="logoImageDelete">Delete</button>
            <button class="btn btn-primary" id="logoImageSave">Save</button>
          </div>
        </div>
        <div class="col-sm-6">
          <h5>Sponsor image</h5>
          <img src="<?=base_url().$sponsor_image?>" alt="" />
          <br><br>
          <input type="file" class="file-input-overwrite" name="second_image" id="sponsorImage" >
          <div style="text-align: right; margin-top: 20px">
            <button class="btn btn-danger" id="sponsorImageDelete">Delete</button>
            <button class="btn btn-primary" id="sponsorImageSave">Save</button>
          </div>
        </div>
      </div>
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
img{
  max-width: 100%
}
</style>

<script>

    var base_url = '<?= base_url() ?>';
    var loading = false;
    $('.display_zoom').change(function(){
      var display_zoom = 0;
      if ($(this).is(":checked")){
        display_zoom = 1;
      }
      $.ajax({
        url: base_url+'admin/webinar/update_display_zoom',
        type : 'POST',
        data : {                
          display_zoom: display_zoom
        },
        cache: false,
        success: function(result) {
          new PNotify({
              title: 'Success!',
              text: '',
              icon: 'icon-checkmark3',
              type: 'success'
          });
        },
        error: function(){
          new PNotify({
              title: 'Error!',
              text: '',
              icon: 'icon-warning',
              type: 'danger'
          });
        },
        complete: function(){
        }
      });
    });

    jQuery(document).ready(function($) {

      $('#logoImage').fileinput({
        allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
      });

      $('#sponsorImage').fileinput({
        allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
      });

      $('#logoImageSave').click(function() {
        var file = $("#logoImage")[0].files[0];
        if (file) {
          var A = new FormData();
          A.append("image", file);
          var C = new XMLHttpRequest();
          C.open("POST", base_url + 'admin/webinar/saveLogoImage');
          C.onload = function() {
            setTimeout(function () {
              location.reload();
            }, 300);
          };
          C.send(A);
        }
      });

      $('#logoImageDelete').click(function() {
        $.ajax({
          url: base_url+'admin/webinar/deleteLogoImage',
          type : 'POST',
          cache: false,
          success: function(result) {
            setTimeout(function () {
              location.reload();
            }, 300);
          }
        });
      });

      $('#sponsorImageSave').click(function() {
        var file = $("#sponsorImage")[0].files[0];
        if (file) {
          var A = new FormData();
          A.append("image", file);
          var C = new XMLHttpRequest();
          C.open("POST", base_url + 'admin/webinar/saveSponsorImage');
          C.onload = function() {
            setTimeout(function () {
              location.reload();
            }, 300);
          };
          C.send(A);
        }
      });

      $('#sponsorImageDelete').click(function() {
        $.ajax({
          url: base_url+'admin/webinar/deleteSponsorImage',
          type : 'POST',
          cache: false,
          success: function(result) {
            setTimeout(function () {
              location.reload();
            }, 300);
          }
        });
      });

      $('.end-webinar').click(function(){
        if(confirm("if you end webinar, two images will be displayed in the webinar page")){
          $.ajax({
            url: base_url+'admin/webinar/endWebinar',
            type : 'POST',
            cache: false,
            success: function(result) {
              setTimeout(function () {
                location.reload();
              }, 300);
            }
          });
        }
      });

    });

</script>