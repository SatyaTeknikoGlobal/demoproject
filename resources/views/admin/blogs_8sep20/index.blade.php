@component('admin.layouts.main')

    @slot('title')
        Admin - Manage Blogs - {{ config('app.name') }}
    @endslot

    <?php 
    $back_url = CustomHelper::BackUrl();
    $routeName = CustomHelper::getAdminRouteName();

    $addBtn = 'Add '.ucwords($type);
    $title = 'Manage '.ucwords($type);

    ?>
    <div class="row">

        <div class="col-md-12">

            <h2>{{$title}}
                <a href="{{route($routeName.'.blogs.add',['type'=>$type,'back_url'=>$back_url]) }}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> {{$addBtn}}</a>
            
            </h2>

            @include('snippets.errors')
            @include('snippets.flash')

            <?php
            if(!empty($blogs) && count($blogs) > 0){
                ?>

                <div class="table-responsive">

                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Sub-title</th>  
                            <th>Description</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach($blogs as $blog){
                            $content = CustomHelper::wordsLimit($blog->content,35);

                            $blog_category = $blog->Category;

                            $category_name = (isset($blog_category->name))?$blog_category->name:'';
                            ?>
                        
                            <tr>
                                <td><?php echo $blog->title; ?></td>
                                <td>{{ $blog->subtitle }}</td>
                                <td>{{ strip_tags($content) }}</td>
                                <td>{{ $category_name }}</td>
                                <td>{{ CustomHelper::getStatusStr($blog->featured) }}</td>
                                <td>{{ CustomHelper::getStatusStr($blog->status) }}</td>

                                <td>
                                    <a href="{{ route($routeName.'.blogs.edit', [$blog->id,'back_url'=>$back_url,'type'=>$type]) }}" title="Edit"><i class="fas fa-edit"></i></a>

                                    <a href="javascript:void(0)" class="sbmtDelForm"  id="{{$blog->id}}" title="Delete"><i class="fas fa-trash-alt"></i></i></a>
                                
                                    <form method="POST" action="{{ route($routeName.'.blogs.delete', $blog->id) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove?');" id="delete-form-{{$blog->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <input type="hidden" name="id" value="<?php echo $blog->id; ?>">

                                    </form>

                                     <a href="{{ route($routeName.'.images.upload',['tid'=>$blog->id,'tbl'=>'blogs']) }}" target="_blank"><i class="fas fa-image" title="Add Images"></i></a>

                                     <a  href="{{ route($routeName.'.videos.add',['vid'=>$blog->id,'tbl'=>'blogs']) }}" target="_blank"><i class="fa fa-video" title="Add Videos"></i></a>

                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                 {{ $blogs->appends(request()->query())->links() }}

            
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

<script type="text/javaScript">
    $('.sbmtDelForm').click(function(){
        var id = $(this).attr('id');
        $("#delete-form-"+id).submit();
    });
</script>

@endslot

@endcomponent