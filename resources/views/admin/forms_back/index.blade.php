@component('admin.layouts.main')

    @slot('title')
        Admin - Manage Blogs - {{ config('app.name') }}
    @endslot

    <?php 
    $back_url = CustomHelper::BackUrl();
    $routeName = CustomHelper::getAdminRouteName();

    $addBtn = 'Add Form';
    $title = 'Manage Forms';

    ?>
    <div class="row">

        <div class="col-md-12">

            <h2>{{$title}}
                <a href="{{route($routeName.'.forms.add',['back_url'=>$back_url]) }}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> {{$addBtn}}</a>
            
            </h2>

            @include('snippets.errors')
            @include('snippets.flash')

            <?php
            if(!empty($forms) && count($forms) > 0){
                ?>

                <div class="table-responsive">

                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach($forms as $form){

                            //$content = CustomHelper::wordsLimit($blog->content,35);
                            //$category_name = (isset($blog_category->name))?$blog_category->name:'';
                            ?>
                        
                            <tr>
                                <td>{{$form->name}}</td>
                                <td><?php echo url('forms/'.$form->slug); ?></td>
                                <td>{{ CustomHelper::getStatusStr($form->status) }}</td>

                                <td>
                                    <a href="{{ route($routeName.'.forms.edit', [$form->id,'back_url'=>$back_url]) }}" title="Edit Form"><i class="fas fa-edit"></i></a>

                                    <a href="javascript:void(0)" class="sbmtDelForm"  id="{{$form->id}}" title="Delete Form"><i class="fas fa-trash-alt"></i></i></a>
                                
                                    <form method="POST" action="{{ route($routeName.'.forms.delete', $form->id) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this Banner?');" id="delete-form-{{$form->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <input type="hidden" name="banner_id" value="<?php echo $form->id; ?>">

                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                 {{ $forms->appends(request()->query())->links() }}

            
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