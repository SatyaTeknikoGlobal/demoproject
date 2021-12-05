	@component('admin.layouts.main')

    @slot('title')
        Admin - Manage Products - {{ config('app.name') }}
    @endslot

    <?php
    $BackUrl = CustomHelper::BackUrl();
    $routeName = CustomHelper::getAdminRouteName();

    $path = 'blog_categories/';
    $thumb_path = 'blog_categories/thumb/';

    $storage = Storage::disk('public');

    $title = '';

    if($type == 'blogs'){
        $title = 'Blog Category List';
        $addBtn = 'Add Blog Category';
    }
    elseif($type == 'news'){
        $title = 'News Category List';
        $addBtn = 'Add News Category';
    }
    ?>
    
    <div class="row">
        <div class="col-md-12">
			<div class="titlehead">
			<h1 class="pull-left">{{$title}} ({{ $categories->count() }})</h1>
           
          
            <a href="{{ route($routeName.'.blogs_categories.add', ['type'=>$type,'back_url'=>$BackUrl]) }}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> <?php echo $addBtn;?></a> 
			</div>
		</div>
   </div>

    <div class="row">

        <div class="col-md-12">

            @include('snippets.errors')
            @include('snippets.flash')

        <?php

        if(!empty($categories) && $categories->count() > 0){
            ?>
            <div class="table-responsive">           

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>Name</th>
                        <th>No. of Blog</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $storage = Storage::disk('public');
                    foreach ($categories as $category){

                    $created_at = CustomHelper::DateFormat($category->created_at, 'd M Y');
                        ?>
                        <tr class="row_{{$category->id}}">
                            <td>{{$category->name}}</td>
                            <td>{{$category->blogs()->count()}}</td>
                            <td>{{ CustomHelper::getStatusStr($category->status) }}</td>
                            <td>{{$created_at}}</td>

                            <td>
                                <a href="{{route($routeName.'.blogs_categories.edit', ['type'=>$type,'id'=>$category->id,'back_url'=>$BackUrl])}}" title="Edit"><i class="fas fa-edit"></i></a>
                                &nbsp;

                                <?php 
                                if ($category->blogs() && $category->blogs()->count() == 0) { ?>
                                <a href="javascript:void(0)" class="sbmtDelForm" title="Delete" ><i class="fas fa-trash-alt"></i></a>

                                <form method="POST" action="{{ route($routeName.'.blogs_categories.delete', $category->id) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this category?');" class="delForm">
                                    {{ csrf_field() }}
                                </form>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            {{ $categories->appends(request()->query())->links() }}
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
@endcomponent


<script>
    $(document).on("click", ".sbmtDelForm", function(e){
        e.preventDefault();
        $(this).siblings("form.delForm").submit(); 
    });
</script>