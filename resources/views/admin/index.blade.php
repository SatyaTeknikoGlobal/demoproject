@component('admin.layouts.main')

    @slot('title')
        Admin Panel - {{ config('app.name') }}
    @endslot


<!-- weekly_orders -->

    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <?php /*
       <div class="col-md-4">

        <table class="table table-bordered table-striped">
            <tr class="info">
                <th colspan="2" class="text-center">
                    <i class="fa fa-shopping-cart"></i> Orders
                    <a href="{{url('admin/orders')}}" class="pull-right" title="View all users"><small class="label label-info">View all &raquo;</small></a>
                </th>
            </tr>

            <tr>
                <td>Total Orders</td>
                <td class="text-right"> <a href="{{url('admin/orders/')}}">{{$totalOrders}}</a> </td>
            </tr>

            <tr>
                <td>Today's Orders</td>
                <td class="text-right"> <a href="{{url('admin/orders/')}}">{{$todayOrders}}</a> </td>
            </tr>

            <tr>
                <td>Week's Orders</td>
                <td class="text-right"> <a href="{{url('admin/orders/')}}">{{$weekOrders}}</a> </td>
            </tr>

            <tr>
                <td>Month's Orders</td>
                <td class="text-right"> <a href="{{url('admin/orders/')}}">{{$monthOrders}}</a> </td>
            </tr>

            <tr class="info">
                <th colspan="2" class="text-center">
                    <i class="fa fa-shopping-cart"></i> Orders Revenue

                </th>
            </tr>

            <tr>
                <td>Total revenue</td>
                <td class="text-right"> <a href="{{url('admin/orders?order_status=success')}}">{{$totalOrdersRevenue}}</a> </td>
            </tr>




            <tr>
                <td>Today's revenue</td>
                <td class="text-right"> <a href="{{url('admin/orders?order_status=success')}}">{{$todayOrdersRevenue}}</a> </td>
            </tr>

            <tr>
                <td>Week's revenue</td>
                <td class="text-right"> <a href="{{url('admin/orders?order_status=success')}}">{{$weekOrdersRevenue}}</a> </td>
            </tr>

            <tr>
                <td>Month's revenue</td>
                <td class="text-right"> <a href="{{url('admin/orders?order_status=success')}}">{{$monthOrdersRevenue}}</a> </td>
            </tr>


        </table>

    </div>

    <div class="col-md-4">

        <table class="table table-bordered table-striped">
            <tr class="info">
                <th colspan="2" class="text-center">
                    <i class="fas fa-boxes"></i> Top Selling Products
                    <?php
                    if(count($topSellingProducts) > 0){
                        ?>
                        <a href="{{url('admin/products?sortBy=top_selling')}}" class="pull-right" title="View all users"><small class="label label-info">View all &raquo;</small></a>
                        <?php
                    }
                    ?>
                </th>
            </tr>

            <tr class="info">
                <th>Product Name</th>
                <th>Ordered Qty</th>
            </tr>

            <?php
            if(!empty($topSellingProducts) && count($topSellingProducts) > 0){
                foreach($topSellingProducts as $topProd){
                    ?>
                    <tr>
                        <td>{{$topProd->product_name}}</td>
                        <td>{{$topProd->total_qty}}</td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>

    </div>

    */ ?>

</div>

@endcomponent