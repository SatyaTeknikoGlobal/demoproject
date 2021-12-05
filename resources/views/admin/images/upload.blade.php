@component('admin.layouts.main')

@slot('title')
Admin - {{ $page_heading }} - {{ config('app.name') }}
@endslot

<link rel="stylesheet" href="<?php echo url('public/uploadifive');?>/uploadifive.css">

<div class="row">
    <div class="col-md-12">
        <h2>{{ $page_heading }} <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
        <a href="{{ url($back_url)}}" class="btn btn-sm btn-success" style='float: right;'>Back</a><?php } ?></h2>



        <?php
        $ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
        /*
        <p class="alert alert-warning">
            <strong><span style="color:#FF0000;">*</span> Mandatory fields</strong>
        </p>
        */
        $id = (request('id'))?request('id'):0;
        $tbl = (request('tbl'))?request('tbl'):'';
        //prd($tbl);
        ?>

        <div class="bgcolor">

             @include('snippets.errors')
            @include('snippets.flash')

            
        <?php

            if(session()->has('scc_msg')){
                echo session('scc_msg');
            }
            ?>

            <?php
            if(session()->has('err_msg')){
                echo session('err_msg');
            }
            ?>

            
        <form method="POST" action="" enctype="multipart/form-data" accept-charset="UTF-8" role="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <span style="font-family: arial, sans-serif;"><i><strong>Instructions on use:</strong></i> <br>
                        Please make sure you are trying to upload Image(s) file only with the extension <strong>.jpg</strong>, <strong>.jpeg</strong>, or <strong>.png</strong> at the end of the file name.<br><br></span>
                    </p>
                </div>

                <div class="col-lg-12">

                    <div class="form-group">
                        <label for="images">Image <span class="required">*</span></label>        
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="file" name="images" id="images" multiple>

                                

                            </div>
                        </div>
                    </div>

                    <div id="queue"></div>

                </div>
                <?php
                /*
                <div class="col-md-12">

                    <div class="form-group">
                        <input type="submit" id="submit" class="btn-success btn" name="submit" value="Upload" />
                    </div>
                </div>
                */
                ?>

        </div>
        </form>
        </div>
    </div>

    <div class="clearfix"></div>

</div>

<br>

<div class="bgcolor">

    <form name="updateForm" method="POST">

            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Sort Order</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                $noRecordsDisp = '';
                $saveBtnDisp = 'display:none;';

                $isSaveBtn = false;
                if(!empty($images) && count($images) > 0){

                    $storage = Storage::disk('public');

                    /*$path = 'common/';
                    $thumb_path = 'common/thumb/';*/

                    foreach($images as $img){

                        $imgName = $img->name;

                        if(!empty($imgName) && $storage->exists($path.$imgName)){

                            $isSaveBtn = true;

                            $rowData = [];
                            $rowData['image'] = $img;
                            $rowData['path'] = $path;
                            $rowData['thumb_path'] = $thumb_path;
                            ?>

                            @include('admin.images._row', $rowData)
                            <?php
                        }
                    }

                    
                }

                if($isSaveBtn){
                    $noRecordsDisp = 'display:none;';
                    $saveBtnDisp = '';
                }
            ?>

            <tr class="save_btn_box" style="{{$saveBtnDisp}}">
                <td colspan="5">
                    <input type="button" name="save" value="Save" class="btn btn-success saveBtn">
                </td>
            </tr>

        </tbody>
    </table>

    <div class="no_records" style="{{$noRecordsDisp}}">
        <p>Currently there is no uploaded Image(s).</p>
    </div>

</form>
</div>




@slot('bottomBlock')

<style type="text/css">
    .col-md-6{ padding: 10px; }
    table td,th{border: 1px solid #000;}
</style>

<script src="<?php echo url('public/uploadifive');?>/jquery.uploadifive.min.js"></script>

<script>
        
        <?php $timestamp = time();?>
        
            
            $('#images').uploadifive({
                
                'auto'             : true,
                'removeCompleted'  : true,
                'buttonText'  : 'SELECT IMAGES',
                'width'        : 110,
                'formData'         : {
                    'tid' : "{{$tbl_id}}",
                    'tbl' : "{{$tbl_name}}",
                    '_token' : '<?php echo csrf_token();?>',

                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',


                },
                'itemTemplate' : '<div class="uploadifive-queue-item"><span class="filename"></span> | <span class="fileinfo"></span><div class="close"></div></div>',
                'queueID'          : 'queue',
                //'checkScript'  : '<?php //echo url($ADMIN_ROUTE_NAME."/images/"); ?>/ajax_check_exist',
                'uploadScript'     : '<?php echo url($ADMIN_ROUTE_NAME."/images/"); ?>/ajax_upload',
                //'uploadLimit'  : 4,
                //'fileSizeLimit' : <?php //echo ALBUM_MAX_UPLOAD_SIZE; ?>,

                'onAddQueueItem' : function(file) {
                    //console.log(file.name);
                    //console.log(file.queueItem[0]);

                    //checkExistFile(file);

                    //$(file.queueItem[0]).find(".fileinfo").text("Already exist");
                },

                'onCheck'      : function(file, exists) {
                    if (exists) {
                        alert('The file ' + file.name + ' exists on the server.');
                    }
                },

                'onUploadComplete' : function(file, data,response) {

                    console.log(JSON.parse(data));

                    var resp = JSON.parse(data);

                    if(resp.success){
                        if(resp.imgRow){
                            //$("form[name=updateForm]").find("table tbody").append(resp.imgRow);

                            $(resp.imgRow).insertBefore($("form[name=updateForm]").find("table tbody .save_btn_box"));

                            $(".no_records").hide();
                            $(".save_btn_box").show();
                        }
                    }

                    /*console.log(JSON.parse(data));

                    if(data.error && data.error != ""){
                        $("#queue .uploadifive-queue-item error div").html("");
                    }*/

                    /*var resp = JSON.parse(data);

                    if(resp.success){
                        if(resp.photoRow){
                            $(".photoBox").append(resp.photoRow);
                            $(".sbmtFormBtnTag").show();
                        }
                    }*/
                
                },
                'onError'      : function(errorType) {
                    //console.log('The error was: ' + errorType);
                }
            });


            /*function checkExistFile(file){
                if(file && file.name){
                    var filename = file.name;
                    var _token = '{{ csrf_token() }}';
                    $.ajax({
                        url: "{{ url($ADMIN_ROUTE_NAME.'/images/ajax_check_exist') }}",
                        type: "POST",
                        data: {filename:filename},
                        dataType:"JSON",
                        headers:{'X-CSRF-TOKEN': _token},
                        async: false,
                        cache: false,
                        beforeSend:function(){
                        },
                        success: function(resp){
                            var isExist = parseInt(resp);

                            if(isExist == 1){
                                $(file.queueItem[0]).find(".fileinfo").text("Already exist");
                            }
                        }
                    });
                }
            }


            $(document).on("click", ".UploadBtn", function(){
                var selectedImages = $(".uploadifive-queue-item");
                //alert(selectedImages.length);
                if(selectedImages.length > 0){
                    $('#images').uploadifive('upload');
                }
                else{
                    alert("Please selecte files...");
                }
            });*/


            $(document).on("click", ".saveBtn", function(e){
                e.preventDefault();

                updateFormData = $("form[name=updateForm]").serialize();

                var _token = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ url($ADMIN_ROUTE_NAME.'/images/ajax_update') }}",
                    type: "POST",
                    data: updateFormData,
                    dataType:"JSON",
                    headers:{'X-CSRF-TOKEN': _token},
                    async: false,
                    cache: false,
                    beforeSend:function(){
                    },
                    success: function(resp){

                        if(resp.success){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on("click", ".delImg", function(e){
                e.preventDefault();

                var conf = confirm("Are you sure you want to delete this?");

                if(conf){

                    var currSelector = $(this);

                    var id = $(this).data("id");

                    var _token = '{{ csrf_token() }}';
                    $.ajax({
                        url: "{{ url($ADMIN_ROUTE_NAME.'/images/ajax_delete') }}",
                        type: "POST",
                        data: {id:id},
                        dataType:"JSON",
                        headers:{'X-CSRF-TOKEN': _token},
                        async: false,
                        cache: false,
                        beforeSend:function(){
                        },
                        success: function(resp){

                            if(resp.success){
                                //currSelector.parents(".row_"+id).remove();
                                window.location.reload();
                            }
                        }
                    });
                }
            });
    

</script>


@endslot

@endcomponent