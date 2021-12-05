@component('admin.layouts.main')

@slot('title')
Admin - Manage Menus - {{ config('app.name') }}
@endslot

<?php
$backUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();
?>

<div class="row">

    <div class="col-md-12">

        <h2>Manage Menus
            <a href="{{ route($routeName.'.menus.add').'?back_url='.$backUrl }}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> New Menu</a>
        </h2>

        @include('snippets.errors')
        @include('snippets.flash')

        <?php
        
        if(!empty($menus) && count($menus) > 0){
            ?>

            <div class="table-responsive">

                <table class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    foreach($menus as $menu){

                        ?>
                        
                        <tr>
                            <td><?php echo $menu->title; ?></td>
                            <td><?php echo $menu->position; ?></td>
                            <td>{{ CustomHelper::getStatusStr($menu->status) }}</td>

                            <td>
                                <a href="{{route($routeName.'.menus.edit', $menu->id.'?back_url='.$backUrl)}}"><i class="fas fa-edit"></i></a>
                               
                                <a href="{{route($routeName.'.menus.items', $menu->id.'?back_url='.$backUrl)}}" title="Menu Items"><i class="fas fa-list"></i></i></a>
                               
                                <a href="javascript:void(0)" class="sbmtDelForm" ><i class="fas fa-trash-alt"></i></i></a>
                                
                                <form method="POST" action="{{ route($routeName.'.menus.delete', $menu->id) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this Menu?');" id="delete-form-{{$menu->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="menu_id" value="<?php echo $menu->id; ?>">

                                </form>
                                
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            {{ $menus->appends(request()->query())->links() }}
            <?php
        }
        else{
            ?>
            <div class="alert alert-warning">No record(s) found.</div>
            <?php
        }
        ?>

    </div>

</div>

@slot('bottomBlock')
<script type="text/javaScript">
    $('.sbmtDelForm').click(function(){
        var id = $(this).attr('id');
        $("#delete-form-"+id).submit();
    });
</script>
@endslot

@endcomponent