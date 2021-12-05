@component('themes.theme-1.layouts.main')

@slot('title')
    {{$meta_title or ''}}
@endslot

@slot('meta_description')
    {{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
  index-page
@endslot
<?php 
// $description = "You Provide for all blind persons";
$description = "Donate any Amount of your choice";
if(!empty($donation->payment_desc))
{
	$description = "You ".$donation->payment_desc;
}
$fname = isset($donation->first_name) ? $donation->first_name : '';
$lname = isset($donation->last_name) ? $donation->last_name : '';
$name = $fname." ".$lname;
?>

<div class="breadcrumbs">
	<div class="container">
		<ul class="clearfix">
			<li><a href="{{url('/')}}">Home</a></li>	
			<li>Thank You</li>			
		</ul>
	</div>
</div>
<section class="fullwidth innerpage cmlayout">
<div class="container">
	<div class="servcont text-center">
      <h1 class="headings headings-with-border">Thank You</h1>
    </div>
    <div class="cms-content-wrapper">
		<div class="cmscontent">
		 <div class="drecip-sec">
		 	 <p class="text-center"><strong>Thank You For Your Support.</strong></p>
		 	 <p><strong>Your donations details are as under:</strong></p>
		 	 <p><strong>Name :</strong> <?php echo $name;?></p>
			 <p><strong>Amount :</strong> <?php echo $donation->donation_amount;?></p>
			 <p><strong>Donation For :</strong> <?php echo $description?></p>
			 <p><strong>Phone :</strong> <?php echo $donation->phone;?></p>
			 <p><strong>Email :</strong> <?php echo $donation->email;?></p>
			 <p><strong>Address :</strong> <?php echo $donation->address1." ".$donation->address2;?></p>
			

			 <a href="<?php echo url('exportPDF/'.$donation->id)?>" class="button" download>Download Receipt</a>
		</div>
		</div>
    </div>
  </div>
</section>

@slot('footerBlock')

@endslot


@endcomponent