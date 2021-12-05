	@component('admin.layouts.main')

    @slot('title')
        Admin - Manage Enquiries - {{ config('app.name') }}
    @endslot

    <?php
    $BackUrl = CustomHelper::BackUrl();
    ?>
    
    <div class="row">
        <div class="col-md-12">
			<div class="titlehead">
			<h1 class="pull-left">Enquiries ({{ $res->count() }})</h1>

			</div>
		</div>
   </div>


    <div class="row">

        <div class="col-md-12">

            @include('snippets.errors')
            @include('snippets.flash')

        <?php

        if(!empty($res) && $res->count() > 0){
            ?>
            <div class="table-responsive">

            {{ $res->appends(request()->query())->links() }}

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Message</th>
                         <th class="">Type</th>
                        
                        <th class="">Action</th>
                    </tr>
                    <?php
                    
                    foreach ($res as $rec){
                     ?>
                        <tr>
                            <td>{{$rec->name}}</td>
                            <td>{{$rec->email}}</td>
                            <td>{{$rec->comment}}</td>
                            <td>{{$rec->type}}</td>
                            
                            <td>
                                <a href="{{ route('admin.enquiries.view', $rec->id.'?back_url='.$BackUrl) }}"><i class="fa fa-search-plus"></i></a> |

                                <a href="javascript:void(0)" class="sbmtDelForm"  id="{{$rec->id}}"><i class="fas fa-trash-alt"></i></i></a>

                                <form method="POST" action="{{ route('admin.enquiries.delete', $rec->id) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this Enquiry?');" id="delete-form-{{$rec->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="enquiry_id" value="<?php echo $rec->id; ?>">

                                </form>
                        
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            {{ $res->appends(request()->query())->links() }}
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

