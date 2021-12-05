	@component('admin.layouts.main')

    @slot('title')
        Admin - Manage Products - {{ config('app.name') }}
    @endslot

    <?php
    $BackUrl = CustomHelper::BackUrl();
    $routeName = CustomHelper::getAdminRouteName();
    ?>
    
    <div class="row">
        <div class="col-md-12">
			<div class="titlehead">
			<h1 class="pull-left">Newsletter Subscriber ({{ $newsletters->count() }})</h1>            
            
            <button type="button" onclick="exportList('export_xls')" class="btn btn-info pull-right" ><i class="fa fa-table"></i> Export XLS</button>

            <form name="exportForm" method="" action="" >
                {{ csrf_field() }}
                <input type="hidden" name="export_xls" value="">
                <?php
                if(count(request()->input())){
                    foreach(request()->input() as $input_name=>$input_val){
                        ?>
                        <input type="hidden" name="{{$input_name}}" value="{{$input_val}}">
                        <?php
                    }
                }
                ?>
            </form>

			</div>
		</div>
   </div>

      


    <div class="row">

        <div class="col-md-12">

            @include('snippets.errors')
            @include('snippets.flash')

        <?php

        if(!empty($newsletters) && $newsletters->count() > 0){
            ?>
            <div class="table-responsive">

            {{ $newsletters->appends(request()->query())->links() }}

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="">Email</th>
                        
                        <th class="">Action</th>
                    </tr>
                    <?php
                    
                    foreach ($newsletters as $newsletter){

                     ?>

                        <tr>
                            <td>{{$newsletter->email}}</td>
                            

                            <td>
                               
                               
                                <a href="javascript:void(0)" title="Delete" class="delBtn"><i class="fas fa-trash"></i></a>

                                <form method="post" class="delForm" action="{{url($routeName.'/newsletter/delete/'.$newsletter->id)}}">
                                    {{csrf_field()}}
                                </form>
                                


                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            {{ $newsletters->appends(request()->query())->links() }}
            <?php
                    }
                    else{
                ?>
                <div class="alert alert-warning">There are no Records at the present.</div>
                <?php
            }
            ?>
            </div>

        </div>


@slot('bottomBlock')

<script type="text/javascript">
$(".delBtn").click(function(){
    var conf = confirm("Are you sure you want to delete this record?");

    if(conf){
        $(this).siblings(".delForm").submit();
    }
});


function exportList(exportName){

    if(exportName ){
        if( exportName == 'export_xls'){
            var exportForm = $("form[name='exportForm']");

            exportForm.find("input[name='export_xls']").val('1');
            exportForm.find("input[name='export_inventory']").val('');
            document.exportForm.submit();
        }
    }

}

</script>

@endslot
   

@endcomponent

