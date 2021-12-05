	@component('admin.layouts.main')

    @slot('title')
        Admin - Manage Enquiries - {{ config('app.name') }}
    @endslot

    <?php
    $BackUrl = CustomHelper::BackUrl();
    ?>

   <?php //prd($enquiry); ?>

  <a href="{{ route('admin.enquiries.index')}}" class="btn btn-primary" >Back</a>

    <div class="row">

        <div class="col-md-12">

            @include('snippets.errors')
            @include('snippets.flash')

        <?php

        if(!empty($enquiry) && $enquiry->count() > 0){
            ?>
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th width="30%" class="">Subject</th>
                        <td>{{ $enquiry->subject }}</td>
                       
                    </tr>

                    <tr>
                        <th width="30%" class=""> Name</th>
                        <td>{{ $enquiry->name }}</td>
                       
                    </tr>
                    <!-- 
                    <tr>
                        <th class="">Last Name</th>
                         <td>{{ $enquiry->last_name }}</td>
                    </tr> -->
                    <tr>
                        <th class="">Email</th>
                         <td>{{ $enquiry->email }}</td>
                    </tr>

                    <tr>
                        <th class="">Phone</th>
                         <td>{{ $enquiry->phone }}</td>
                    </tr>

                    <?php
                    if($enquiry->type == 'one_time_meal'){
                    ?>

                    <tr>
                        <th class="">Type</th>
                         <td>{{ $enquiry->type }}</td>
                    </tr>

                    <tr>
                        <th class="">Type of meal</th>
                         <td>{{ $enquiry->type_of_meal }}</td>
                    </tr>
                    
                    <tr>
                        <th class="">Payment Option</th>
                         <td>{{ $enquiry->payment_option }}</td>
                    </tr>

                    <tr>
                        <th class="">Date of booking</th>
                         <td>{{ $enquiry->date_of_booking }}</td>
                    </tr>

                    <tr>
                        <th class="">Book for</th>
                         <td>{{ $enquiry->book_for }}</td>
                    </tr>

                    <tr>
                        <th class="">Transaction id</th>
                         <td>{{ $enquiry->transaction_id }}</td>
                    </tr>

                    
                    <tr>
                        <th class="">Address</th>
                         <td>{{ $enquiry->address }}</td>
                    </tr>

                    <?php }
                    ?>

                    <tr>
                        <th class="">Message</th>
                         <td>{{ $enquiry->comment }}</td>
                    </tr>

                    

                    <tr>
                        <th class="">Added Date</th>
                         <td>{{ CustomHelper::DateFormat($enquiry->created_at, $toFormat='d-m-Y h:i:A', $fromFormat='') }}</td>
                    </tr>

                </table>
            </div>
           
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

