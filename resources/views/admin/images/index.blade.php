@component('admin.layouts.main')

@slot('title')
Admin - Images - {{ config('app.name') }}
@endslot

<?php
$BackUrl = CustomHelper::BackUrl();

$tentative_status_arr = config('custom.tentative_status');

$costing_unique_id_arr = [];

if(session()->has('costing_unique_id_arr')){
    $costing_unique_id_arr = session('costing_unique_id_arr');
}

$req_keyword = (request()->has('keyword'))?request('keyword'):'';

?>

@include('snippets.errors')
@include('snippets.flash')

<div class="row">

    <div class="col-md-12">

        <h1>
            Images

            <?php
            if(request()->has('back_url')){
                $back_url= request('back_url');
                ?>
                <a href="{{ url($back_url)}}" class="btn btn-success" style="float: right;">Back</a>
                <?php
            }
            ?>

            <a href="javascript:void(0)" class="btn pull-right searchbtn" ><i class="fa fa-search"></i> Search</a>

        </h1>


        <div class="row searchshow">

            <form name="searchForm" action="">

                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="text" name="keyword" value="{{$req_keyword}}" class="form-control tooltipp"  placeholder="Enter here..." />
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="submit" name="search" class="btn btn-success" value="Search">
                        <a href="{{ url('admin/images') }}" name="reset" class="btn btn-warning reset_button">Reset</a>

                    </div>
                </div>

            </form>

        </div>

        <div class="table-responsive tbl_section">


            <?php
            if(!empty($req_keyword)){
                ?>
                <h4 class="search_for">Search for - {{$req_keyword}}</h4>


                <?php
                $storage = Storage::disk('uploads');

                $big_path = 'images/big/';
                $thumb_path = 'images/thumb/';

                $img_src = '';

                if($storage->exists($big_path.$req_keyword)){
                    $img_src = url('public/uploads/'.$big_path.$req_keyword);
                }
                elseif($storage->exists($thumb_path.$req_keyword)){
                    $img_src = url('public/uploads/'.$thumb_path.$req_keyword);
                }

                if(!empty($img_src)){
                    ?>
                    <div class="img_box">
                        <img src="{{$img_src}}" style="width:30%">
                        @permission('images.delete')
                        <a href="javascript:void(0)" data-img="{{$req_keyword}}" class="del_img">Delete</a>
                        @endpermission                        
                    </div>
                    <?php
                }
            }
            ?>


        </div>

    </div>

</div>



@endcomponent

<script type="text/javascript">

    $(document).on("click", ".searchbtn", function(){
        $('.searchshow').fadeToggle();
    });

    $('.datetimepicker').datetimepicker({
        dateFormat:'dd/mm/yy DD',
        showTimepicker: false
    });

    $(document).on("click", ".del_shipment", function(){

        var id = $(this).data("id");

        if(id && id != ""){
            $(this).siblings("form[name='deleteForm"+id+"']").submit();
        }
        
    });
    $(document).on("click", ".del_img", function(){

        var conf = confirm("Are you sure to delete this image?");

        if(conf){

            var curr_selector = $(this);

            var img = $(this).data("img");

            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ url('admin/images/ajax_delete_images') }}",
                type: "POST",
                data: {img:img},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                beforeSend:function(){
                },
                success: function(resp){
                    if(resp.success){
                        curr_selector.parent(".img_box").remove();
                    }
                }
            });
        }
    });
</script>