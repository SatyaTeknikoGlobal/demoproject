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
            <h1 class="pull-left">Enquiries ({{ $enquiries->count() }})</h1>

            </div>
        </div>
   </div>


    <div class="row">

        <div class="col-md-12">

            @include('snippets.errors')
            @include('snippets.flash')

        <?php

        if(!empty($enquiries) && $enquiries->count() > 0){

            $staticFormElements  = CustomHelper::getStaticFormElements();
            ?>
            <div class="table-responsive">

            {{ $enquiries->appends(request()->query())->links() }}

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="">Name</th>
                        <th class="">Data</th>
                        <th class="">Action</th>
                    </tr>
                    <?php
                    
                    foreach ($enquiries as $enquiry){

                        $formData = $enquiry->form;
                        $formElemetsData = $formData->formElements;

                        $data = $enquiry->data;
                        $unserializeData = unserialize($data);

                        $formElemsts = $formElemetsData;
                        if(!empty($staticFormElements)){
                            $formElemsts = $formElemetsData->merge($staticFormElements);
                        }

                        $formElemstsArr = [];

                        //prd($formElemsts->toArray());
                        //prd($unserializeData);

                        if(!empty($formElemsts)){
                           $formElemstsArr = $formElemsts->keyBy('id');
                        }

                        /*foreach($unserializeData as $inpKey=>$inpVal){
                            $eleId = str_replace('input','',$inpKey);
                            if(is_numeric($eleId) && $eleId > 0){
                                $elementIdsArr[] = $eleId;
                            }
                        }*/
                        //pr($formElemetsData->toArray());

                     ?>
                        <tr>
                            <td>{{$formData->name}}</td>
                            <td>
                                <?php

                                foreach($unserializeData as $dKey=>$dVal){
                                    $element_id = str_replace('input', '', $dKey);
                                    
                                    $label = (isset($formElemstsArr[$element_id]))?$formElemstsArr[$element_id]->label:'';
                                    //pr($label);
                                    if(!empty($label)){
                                        ?>
                                        <p>
                                            <strong>{{$label}}: </strong>
                                            <?php
                                            if(is_array($dVal)){
                                                echo implode(',', $dVal);
                                            }
                                            else{
                                                echo $dVal;
                                            }
                                            ?>
                                        </p>
                                        <?php
                                    }
                                }
                                ?>

                            </td>
                            
                            <td>
                                <!-- <a href="{{ route('admin.enquiries.view', $enquiry->id.'?back_url='.$BackUrl) }}"><i class="fa fa-search-plus"></i></a> | -->

                                <a href="javascript:void(0)" class="sbmtDelForm"  id="{{$enquiry->id}}"><i class="fas fa-trash-alt"></i></i></a> </br></br>

                                <?php
                                $pdf_path = 'careers/';
                                $storage = Storage::disk('public');

                                if(!empty($enquiry->document)){
                                    if($storage->exists($pdf_path.$enquiry->document)){
                                        ?>
                                        <a target="_blank" href="{{url('public/storage/'.$pdf_path.$enquiry->document)}}">
                                            <img src="{{ url('public/images/pdf.jpg') }}" style="width:30px; height:30px;"><br>
                                        </a>
                                        <?php }
                                    }
                                ?>
                                <a>
                                </a>

                                <form method="POST" action="{{ route('admin.enquiries.delete', $enquiry->id) }}" accept-charset="UTF-8" role="form" onsubmit="return confirm('Do you really want to remove this Enquiry?');" id="delete-form-{{$enquiry->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="enquiry_id" value="<?php echo $enquiry->id; ?>">

                                </form>
                        
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            {{ $enquiries->appends(request()->query())->links() }}
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

