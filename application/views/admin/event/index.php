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
            <h4><span class="font-weight-semibold">Manage Events</span></h4>
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
                <button type="button" class="btn bg-teal-400" onclick="Download()"><i class="icon-download"></i> Download</button>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered" id="event_datatable" width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<!-- Success modal -->
<div id="modal_video" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Video Player</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>           
            <div class="modal-body">
                <video id="my_video" width="100%" height="240" controls>
                  <source src="movie.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                             
            </div>           
        </div>
    </div>
</div>
<!-- /success modal -->

<script>
    
    var $event_datatable = $('#event_datatable');   

    jQuery(document).ready(function() {
        $('.pickadate-year').pickadate({
            format : 'yyyy-mm-dd'
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        var datatableInit = function () {

            // format function for row details
            $event_datatable.dataTable({
                "ordering": true,
                "info": true,
                "searching": true,
                "ajax": {
                    "type": "POST",
                    "async": true,
                    "url": base_url + "admin/event/get_Event",
                    "data": {},
                    "dataSrc": "data",
                    "dataType": "json",
                    "cache": false,
                },
                "columnDefs": [
                    {
                        "targets": [3],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if (!cellData || cellData == null || cellData == "") {
                                $(td).html("");
                            }else{
                                var html =
                                    '<div class="card-img-actions m-1"><img class="card-img img-fluid" style="height: 2.5em; width: 3em;" src="'+base_url+rowData.thumbnail+'" alt="">'+
'                                    <div class="card-img-actions-overlay card-img">' +
'                                        <a href="'+base_url+rowData.thumbnail+'" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">' +
'                                            <i class="icon-plus3"></i>' +
'                                        </a>' +
'                                    </div></div>';
                                $(td).html(html);
//                                $(td).html("<img style='height: 2.5em; width: 3em;' src='"+base_url+rowData.thumbnail+"'>");
                            }
                        }
                    },
                    {
                        "targets": [4],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            if (!cellData || cellData == null || cellData == "") {
                                $(td).html("");
                            }else{
                                var html =
                                    '<div class="card-img-actions m-1"><img class="card-img img-fluid" style="height: 2.5em; width: 3em;" src="'+base_url+rowData.second_thumbnail+'" alt="">'+
'                                    <div class="card-img-actions-overlay card-img">' +
'                                        <a href="'+base_url+rowData.second_thumbnail+'" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">' +
'                                            <i class="icon-plus3"></i>' +
'                                        </a>' +
'                                    </div></div>';
                                $(td).html(html);
                            }
                        }
                    },
                    {
                        "targets": [7],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var html = '';
                            html +=                           
                                '<a href="'+base_url+'admin/event/display_reg_History?id='+rowData.id+'" style="color: deepskyblue;text-decoration:underline">'+cellData+'</a>';
                            $(td).html(html);
                        }
                    },
                    {
                        "targets": [8],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var html = '';
                            html +=                           
                                '<a href="'+base_url+'admin/event/display_attend_History?id='+rowData.id+'" style="color: deepskyblue;text-decoration:underline">'+cellData+'</a>';
                            $(td).html(html);
                        }
                    },
                    {
                        "targets": [12],
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var html = '';
                            if (rowData.display_sponsor == 0){

                                html = '<a onclick="update_Sponsor(1,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input">unchecked</label></div></a>';
                            }
                            else{
                                html = '<a onclick="update_Sponsor(0,'+rowData.id+')"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" checked="">checked</label></div></a>';
                            }
                            $(td).html(html);
                        }
                    },
                    {
                        "targets": [13],
                        orderable: false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var html = '';
                            html +=                           
                                '<a style="color: deepskyblue;" title="Edit"><i class="icon-pencil7"></i>Edit</a>&nbsp&nbsp'+
                                '<a style="color: deepskyblue;" title="Delete"><i class="icon-trash"></i>Delete</a>';
                            $(td).html(html);
                    }
                }
                ],
                "columns": [
                    {"title": "No", "data": "no", "class": "text-center", "width": "5%"},
                    {"title": "Name", "data": "name", "class": "text-center", "width": "10%"},
                    {"title": "Location", "data": "location", "class": "text-center", "width": "10%"},
                    {"title": "Thumbnail", "data": "thumbnail", "class": "text-center", "width": "10%"},
                    {"title": "Second thumbnail", "data": "second_thumbnail", "class": "text-center", "width": "10%"},
                    {"title": "Start time", "data": "start_time", "class": "text-center", "width": "10%",
											mRender: function(data, type, row) {
												return data + ' PT';
											}
										},
                    {"title": "End time", "data": "end_time", "class": "text-center", "width": "10%"},
                    {"title": "Registered", "data": "real_register", "class": "text-center", "width": "5%"},
                    {"title": "Attended", "data": "real_attend", "class": "text-center", "width": "5%"},
                    {"title": "Link", "data": "link", "class": "text-center", "width": "5%"},
                    {"title": "Status", "data": "status", "class": "text-center", "width": "10%",
                        mRender: function(data, type, row) {
                            if (data == 'live')
                                return '<span class="badge-pill badge-warning">live</span>';
                            else if(data == 'upcoming')
                                return '<span class="badge-pill badge-info">upcoming</span>';
                            else 
                                return '<span class="badge-pill badge-primary">completed</span>';

                    }},
                    {"title": "Remind to", "data": "remind_to", "class": "text-center", "width": "5%"},
                    {"title": "Display Sponsor", "data": "display_sponsor", "class": "text-center", "width": "10%"},
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

            $('#event_datatable tbody').on('click', 'a[title="Edit"]', function () {
                var data = $event_datatable.fnGetData($(this).parents('tr')[0]);

                location.href = base_url+'admin/event/edit?id='+data.id;
            });

            $('#event_datatable tbody').on('click', 'a[title="Delete"]', function () {
                var data = $event_datatable.fnGetData($(this).parents('tr')[0]);

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
                                url: base_url+'admin/event/del_Event',
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
                                    $event_datatable.DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                );
            });
        });

    });

    function Download() {
        location.href = base_url + 'admin/event/export_Event';
    }

    function update_Sponsor(state,id) {

        if(state == 1){
            $('#display_sponsor_label_'+id).text('checked');
        }else{
            $('#display_sponsor_label_'+id).text('unchecked');
        }

        $.ajax({
            url: base_url+'admin/event/update_display_sponsor',
            type : 'POST',
            data : {
                id: id,
                state: state
            },
            cache: false,
            success: function() {
                swal(
                    'Success!',
                    'Your operation successfully!',
                    'success'
                );
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        });
    }
</script>