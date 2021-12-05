@component('themes.theme-1.layouts.main')

@slot('title')
    {{$meta_title or ''}}
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot

<?php
$storage = Storage::disk('public');
$image = '';
if(!empty($cms['image']) && $storage->exists('cms_pages/thumb/'.$cms['image'])){
	$image = url('public/storage/cms_pages/thumb/'.$cms['image']);
}

$banner_image = asset('public/assets/themes/theme-1/images/default-img.png');
if(!empty($cms['banner_image']) && $storage->exists('cms_pages/'.$cms['banner_image'])){
	$banner_image = url('public/storage/cms_pages/'.$cms['banner_image']);
}
?>
<section class="fullwidth innerbanner" style="background: url('<?php echo $banner_image;?>') center center no-repeat;">
<!-- <img src="" alt="Industries &amp; Applications"> -->
</section>
<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>{{$cms['title']}}</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage cmlayout">
<div class="container">
	<div class="servcont text-center">
      <h1 class="headings headings-with-border">{{$cms['title']}}</h1>
    </div>
    <div class="cms-content-wrapper donate-lp">
    	<?php 
	    if(!empty($image)){
	    ?>
		<div class="pageimg">
			<img src="<?php echo $image;?>" alt="{{$cms['title']}}">
		</div>
		<?php } ?>
		<div class="cmscontent">
	     <?php echo $cms['content']; ?>
	     <div id="donate-form-wrapper" class="donate-form-wrapper cheque-frm">
	     	 
	     	@include('components.includes._donate_cheque_form') 

	     </div>
		</div>
    </div>
  </div>
</section>

@slot('footerBlock')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
$.validate({
});
</script>


<script>
    $('#rzp-footer-form').submit(function (e) {
        var button = $(this).find('button');
        var parent = $(this);
        button.attr('disabled', 'true').html('Please Wait...');
        $.ajax({
            method: 'get',
            url: this.action,
            data: $(this).serialize(),
            complete: function (r) {
                console.log('complete');
                console.log(r);
            }
        })
        return false;
    })
</script>

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        $("#paymentDetail").removeAttr('style');
        $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );

        $.ajax({
            method: 'post',
            url: "{!!route('dopayment')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id
            },
            complete: function (r) {
                console.log('complete');
                console.log(r);
            }
        })
    }
</script>

<script>
    var options = {
        key: "{{ config('custom.RAZORPAY_KEY') }}",
        amount: '247500',
        name: 'CodesCompanion',
        description: 'TVS Keyboard',
        image: 'https://i.imgur.com/n5tjHFD.png',
        handler: demoSuccessHandler
    }
</script>
<script>
    window.r = new Razorpay(options);
    document.getElementById('paybtn').onclick = function () {
        r.open()
    }
</script>

@endslot


@endcomponent