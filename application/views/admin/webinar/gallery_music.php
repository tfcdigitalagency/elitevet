<?php date_default_timezone_set('America/Vancouver'); ?>
<style type="text/css">
    .table-bordered>thead {
        background-color: cornflowerblue;
    }
</style>

<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Manage Gallery</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic setup -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Manage Gallery</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <?php if (!empty($gallery)):?>
                    <?php foreach ($gallery as $item):?>
                        <div class="col-sm-6 col-lg-1">
                            <div class="card">
                                <div class="header-elements">
                                    <a class="list-icons-item" onclick="del_Gallery('<?=$item['id']?>')" style="float: right"><i class="icon-close2"></i></a>
                                </div>
                                <div class="card-img-actions m-1">
                                    <img class="card-img img-fluid" src="<?=base_url().$item['thumbnail']?>" alt="">
                                    <div class="card-img-actions-overlay card-img">
                                        <a href="<?=base_url().$item['thumbnail']?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                            <i class="icon-plus3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
                <div class="col-sm-6 col-lg-2" style="text-align: center">
                    <div class="card">
                        <div class="card-img-actions m-1">
                            <button type="button" class="btn btn-primary" onclick="add_Gallery()"><i class="icon-plus-circle2 mr-2"></i> Add More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->

    <!-- Basic setup -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Set Background Music</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">current music:</label>
                        <div class="col-lg-9">
                            <a target="_blank" href="<?=!empty($music)?base_url($music):'';?>" >Click here to see</a>
<!--                            <label class="col-form-label">--><?//=!empty($music)?$music:'';?><!--</label>-->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"></label>
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-outline-primary" style="width: 100px">select music:</button>
                                </div>
                                <div class="col-lg-8">
                                    <input type="file" class="file-input" id="music" name="music" data-show-preview="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"></label>
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-outline-primary" style="width: 100px" onclick="save_Music()">set music:</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->

    <!-- Video -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Videos</h6>
        </div>

        <div class="card-body">

            <table class="table" style="width: auto" id="table-video">
                <tbody>
                    <?php foreach($video as $v){ ?>
                    <tr>
                        <td><i class="icon-film"></i></td>
                        <td><span><?=$v['thumbnail']?></span></td>
                        <td><span class="text-danger" style="cursor: pointer" onclick="del_Gallery('<?=$v['id']?>')">Delete</span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <input type="file" class="file-input-video" id="input-video">
        </div>
    </div>

    <!-- Webinar -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Webinar</h6>
        </div>

        <div class="card-body">

            <div class="alert alert-success timeleft"></div>

            <?php
                $event_name = '';
                $has_event = 0;
                if(count($event) > 0){
                    $event = $event[0];
                    $has_event = 1;
                    $now = date("Y-m-d H:i:s");
            ?>
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
                            $('.timeleft').html("The webinar <strong><?=$event['name']?></strong> will be started after 0 second ...");
                        }
                    }
                </script>
            <?php
                }
            ?>




            <input class="form-group form-control" placeholder="API key" id="webinar-api-key" value="<?=$webinar['api_key']?>">
            <input class="form-group form-control" placeholder="API secret" id="webinar-api-secret" value="<?=$webinar['api_secret']?>">
            <input class="form-group form-control" placeholder="Meeting number" id="webinar-meeting-number" value="<?=$webinar['meeting_number']?>" style="display: inline-block; width: 200px;">
            <input class="form-group form-control" placeholder="Meeting passcode" id="webinar-meeting-passcode" value="<?=$webinar['meeting_passcode']?>" style="display: inline-block; width: 200px;">
            <div>
                <button class="btn btn-primary" id="start-webinar">Start Webinar</button>
                <button class="btn btn-success" id="start-broadcasting">Start Broadcasting</button>
            </div>
        </div>
    </div>
    <div class="zoom-view">
        <span id="close-webinar">X</span>

        <div id="hide-webinar" class="form-check">
            <label class="form-check-label">
                <span>Display zoom video</span>
                <input type="checkbox" class="form-check-input display_zoom" <?=$display_zoom=="1"?"checked='checked'":""?>>
            </label>
        </div>
        <iframe id="frameAdminWebinar"></iframe>
    </div>
    <!-- //Webinar -->

</div>
<!-- /content area -->

<!-- Success modal -->
<div id="modal_theme_primary" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add Gallery</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">Gallery file upload:</label>
                    <div class="col-lg-9" id="image_">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary" onclick="save_Gallery()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /success modal -->


<!-- Broadcasting modal -->


<div id="modal_broadcasting" class="modal modal-lg fade" tabindex="-1" style="margin: 50px auto">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Video Broadcasting</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				 
				 <div style="text-align: center" class="live-iframe">
				<table width="100%">
				<tr>
				<td><div><strong>Camera 1</strong></div>
					<iframe src="<?php echo site_url('/admin/webinar/broadcast/8080?t='.time());?>" title="Video1" width="100%" height="380" scrolling="no"  style="border:0;overflow:hidden"></iframe>    
				</td>
				<td>
					<div><strong>Camera 2</strong></div>
					<iframe src="<?php echo site_url('/admin/webinar/broadcast/4000?t='.time());?>" title="Video1" width="100%" height="380" scrolling="no" style="border:0;overflow:hidden"></iframe>
				</td>
				</tr>
				</table>
			  </div>
			</div>
		</div>
	</div>
</div>
<!-- /success modal -->

<script>
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
        modalTemplate = '<div class="modal-dialog modal-lg" role="document">' +
            '  <div class="modal-content">' +
            '    <div class="modal-header align-items-center">' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>' +
            '    </div>' +
            '    <div class="modal-body">' +
            '      <div class="floating-buttons btn-group"></div>' +
            '      <div class="kv-zoom-body file-zoom-content"></div>' + '{prev} {next}' +
            '    </div>' +
            '  </div>' +
            '</div>';

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
    };

    function del_Gallery(id) {
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
                        url: base_url+'admin/webinar/del_Gallery',
                        type : 'POST',
                        data : {
                            id: id
                        },
                        cache: false,
                        success: function(result) {
                            swal({
                                title:'Success!',
                                text:'Your operation successfully!',
                                type:'success',
                                confirmButtonClass: 'btn btn-primary',
                                confirmButtonText: 'Confirm',
                            });

                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                    });
                }
            }
        );
    }

    function add_Gallery() {
        $('#image_').empty();
        $('#image_').html('<input type="file" class="file-input" name="thumbnail" id="thumbnail"  data-fouc>');
        $('.file-input').fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });
        _componentFileUpload();

        $('.modal-title').html("Add New Gallery");
        $('#modal_theme_primary').modal();
    }

    function save_Gallery() {
        var thumbnail = $("#thumbnail")[0].files[0];

        var A = new FormData();

        if (thumbnail) {
            console.log(thumbnail);
            A.append("thumbnail", thumbnail);
        }

        var C = new XMLHttpRequest();
        C.open("POST", base_url + 'admin/webinar/save_Gallery');
        C.onload = function() {
            $("#modal_theme_primary").modal("hide");
            swal({
                title:'Success!',
                text:'Your operation successfully!',
                type:'success',
                confirmButtonClass: 'btn btn-primary',
                confirmButtonText: 'Confirm',
            });

            setTimeout(function () {
                location.reload();
            }, 2000);
        };
        C.send(A);
    }

    function save_Music() {
        var music = $("#music")[0].files[0];
        var A = new FormData();

        A.append("id", $("#id").val());

        if (music) {
            A.append("music", music);
        }

        var C = new XMLHttpRequest();
        C.open("POST", base_url + 'admin/webinar/save_Music');
        C.onload = function() {
            swal({
                title:'Success!',
                text:'Your operation successfully!',
                type:'success',
                confirmButtonClass: 'btn btn-primary',
                confirmButtonText: 'Confirm',
            });

            setTimeout(function () {
                location.reload();
            }, 2000);
        };
        C.send(A);
    }

    jQuery(document).ready(function($) {

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });


        $('#start-broadcasting').click(function(){
			$("#modal_broadcasting").modal("show"); 
		});
  
		$('#start-webinar').click(function(){
            $('.zoom-view').addClass('show');
            var api_key = $('#webinar-api-key').val();
            var api_secret = $('#webinar-api-secret').val();
            var meeting_number = $('#webinar-meeting-number').val();
            var meeting_passcode = $('#webinar-meeting-passcode').val();
            $("#frameAdminWebinar").attr("src", "<?=base_url()?>admin/webinar/live?api_key="+api_key+"&api_secret="+api_secret+"&meeting_number="+meeting_number+"&meeting_passcode="+meeting_passcode);
        });

        $('#close-webinar').click(function(){
            $('.zoom-view').removeClass('show');
        });

        $('.file-input-video').fileinput({
            uploadUrl: base_url + 'admin/webinar/save_Video',
            allowedFileExtensions: ["mp4","webm","ogg"],
            showPreview: false,
        }).on('fileuploaderror', function(event, data, msg) {
           alert('Upload error!');
        }).on('fileuploaded ', function(event, data, previewId, index, fileId){
            var response = data.response;
            if(response.status == 'success'){
                location.reload();
            }
        });

        var base_url = '<?= base_url() ?>';

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


    });
</script>
