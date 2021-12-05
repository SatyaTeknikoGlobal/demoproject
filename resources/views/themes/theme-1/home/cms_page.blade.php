@component('themes.theme-1.layouts.main')

@slot('title')
{{$meta_title or ''}}
@endslot

@slot('meta_description')
{{$meta_description or ''}}
@endslot

@slot('headerBlock')

<link rel="stylesheet" type="text/css" href="{{asset('public/assets/themes/theme-1/css/owl.carousel.min.css')}}" />
<style type="text/css">
  .sub-donate h4{
    font-weight: 600;
    color: #363b97;
    font-size: 20px;
  }
  .sub-donate{
    margin-bottom: 30px;
  }
  .sub-donate input[type=radio]{
    margin-bottom: 12px;
  }
</style>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- Event snippet for Sponsor Meal conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-527459866/VmI4CNLGv-QBEJrMwfsB', 'transaction_id': '', 'event_callback': callback }); return false; } </script>

@endslot

<!-- to attach class on body tag of page -->
@slot('bodyClass')
index-page
@endslot

<?php
$url = url()->current();
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
  <div class="cms-content-wrapper">
  <div class="cmscontent">
    <?php echo $cms['content']; ?>
  </div>
</div>
<div class="msg"></div>
<?php if($cms['parent_id'] == 37){

  ?>



<div class="donate-form-wrapper sub-donate">
  
<form method="POST" name="donateForm" id="donateForm" class="donateForm">	
   <div class="row">
    <div class="col-md-6">
      <h4>Select Your Donation Amount </h4>
      <div class="form-group">
      <input type="text" name="donation_amount" id="donation_amount" value="1000.00" data-validation="required" class="form-control"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-validation-error-msg-custom = "This should be numeric text">
      <span id="error_price"></span>
     </div>
   </div>
   </div>

   <input type="radio" name="amount_choose" id="amount_choose" value="INR 200 will provide walking stick to 1 blind person" data-value="200" title="INR 200 will provide walking stick to 1 blind person"> INR 200 will provide walking stick to 1 blind person<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="INR 600 will provide walking sticks to 3 blind persons" data-value="600" title="INR 600 will provide walking sticks to 3 blind persons"> INR 600 will provide walking sticks to 3 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="INR 1000 will provide walking sticks to 5 blind persons" checked data-value="1000" title="INR 1000 will provide walking sticks to 5 blind persons"> INR 1000 will provide walking sticks to 5 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="INR 2000 will provide walking sticks to 10 blind persons" data-value="2000" title="INR 2000 will provide walking sticks to 10 blind persons"> INR 2000 will provide walking sticks to 10 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value=" INR 3000 will provide walking sticks to 15 blind persons" data-value="3000" title="INR 3000 will provide walking sticks to 15 blind persons"> INR 3000 will provide walking sticks to 15 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="INR 5000 will provide walking sticks to 25 blind persons" data-value="5000" title="INR 5000 will provide walking sticks to 25 blind persons"> INR 5000 will provide walking sticks to 25 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="INR 10000 will provide walking sticks to 50 blind persons" data-value="10000" title="INR 10000 will provide walking sticks to 50 blind persons"> INR 10000 will provide walking sticks to 50 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="NR 20000 will provide walking sticks to 100 blind persons" data-value="20000" title="INR 20000 will provide walking sticks to 100 blind persons"> INR 20000 will provide walking sticks to 100 blind persons<br>
   <input type="radio" name="amount_choose" id="amount_choose" value="Donate any Amount of your choice" data-value="0" title="Donate any Amount of your choice" > Donate any Amount of your choice

   <br>

    <h4>Personal Info</h4>
    <div class="row">
     <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="first_name">First Name <span  title="This field is required." class="required">*</span>  </label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="" data-validation="required custom" aria-required="true" placeholder="Enter First Name">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="last_name">Last Name <span title="This field is required." class="required">*</span> </label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="" data-validation="required" aria-required="true" placeholder="Enter Last Name">
      </div>
    </div>
  </div>
  <div class="row">
   <div class="col-md-6">
    <div class="form-group">
      <label class="control-label" for="contact_email">Email Address <span title="This field is required." class="required">*</span>  </label>
      <input type="text" name="email"  id='contact_email' class="form-control" value="" data-validation="required" aria-required="true" placeholder="Enter Email">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label" for="phone">Phone <span title="This field is required." class="required">*</span> </label>
      <input type="text" name="phone" id="phone" class="form-control" value="" data-validation="required" aria-required="true" placeholder="Enter Phone">
    </div>
  </div>
</div>


  <h4>Billing Details</h4>
  <div class="row">

<div class="col-md-12">
  <div class="form-group">
    <label class="control-label" for="address">Address<span title="This field is required." class="required">*</span></label>
    <input type="text" name="address1" id="address" class="form-control" value="" data-validation="required" aria-required="true" placeholder="Enter Address">
  </div>
</div>
</div>
<div class="row">
<!--  <div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="address2">Address 2</label>
    <input type="text" name="address2" id="address2" class="form-control" value="" aria-required="true" placeholder="Enter Address">
  </div>
</div> -->
   <div class="col-md-6">
    <div class="form-group">
      <label class="control-label" for="country">Country <span title="This field is required." class="required">*</span></label>
      <select name="country" class="form-control" data-validation="required" id="country">
       <option value="" selected disabled>Select Country</option>
       <?php foreach($countries as $country){?>
        <option value="{{$country->id}}">{{$country->name}}</option>
      <?php }?>
    </select>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="City">City <span title="This field is required." class="required">*</span></label>
    <input type="text" name="City" id="City" placeholder="Enter City" class="form-control" value="" data-validation="required" >
  </div>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="state">State</label>
    <input type="text" name="address2" id="state" class="form-control" value="" data-validation="required" aria-required="true" placeholder="Enter State">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="pincode">Zip Code <span title="This field is required." class="required">*</span></label>
    <input type="text" name="pincode" id="pincode" class="form-control" value="" data-validation="required" aria-required="true" placeholder="Enter Pincode">
  </div>
</div>
</div>
<span>Donation Total</span>
<span>₹</span><span id="total_donation"><?php echo '1000.00';?></span><br><br>
<button type="submit" class="button buttonDonate" id="paybtn">Submit</button>


</form>
</div>

<?php }?>
<?php if(isset($cms['description'])){?>
  <div class="spara">
 <?php 
    $description = isset($cms['description']) ? $cms['description'] :'';
    echo $description;
    ?>
  </div>
    <?php }?>
    <?php if($cms['parent_id'] == 37){

  ?>
<div class="shear">
  <h4>Spread the Word</h4>
  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url?>" target="_blank" class="facebook" title="facebook"><i class="fa fa-facebook"></i></a>
  <a href="http://www.twitter.com/share?url=<?php echo $url?>" target="_blank" class="twitter" title="twitter"><i class="fa fa-twitter"></i></a>
  <a href="https://www.linkedin.com/shareArticle?url=<?php echo $url?>" target="_blank" class="linkedin" title="linkedin"> <i class="fa fa-linkedin"></i></a>
  <a href="whatsapp://send?text=<?php echo $url?>" target="_blank" class="whatsapp" title="whatsapp"><i class="fa fa-whatsapp"></i></a>
  <a href="https://www.instagram.com/sharer/sharer.php?u=<?php echo $url?>" target="_blank" class="instagram" title="instagram"><i class="fa fa-instagram"></i></a>
</div>
<?php }?>
    
</div>

</section>


  


@slot('footerBlock')
<script type="text/javascript">
	$('.book-meal').on('click',function(ev) {
    ev.stopPropagation();
    $('.book-meal-sec').slideToggle();
  });
</script>
@endslot


@endcomponent
<script type="text/javascript">

  var donation_amount = $("input[name='amount_choose']:checked").data('value');


  $('input[type=radio][name=amount_choose]').change(function() {

    var donation_amount = $("input[name='amount_choose']:checked").data('value');
    $('#donation_amount').val(donation_amount +'.00');
    $('#total_donation').html(donation_amount +'.00');
  });
  $("#donation_amount").keyup(function(){
    $("input[name=amount_choose][value='0']").prop("checked",true);
    var donation_amount = $('#donation_amount').val();
    if(donation_amount == ''){
     $('#total_donation').html('0.00');
   }
   $('#total_donation').html(donation_amount +'.00');
 });
</script>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>


<script type="text/javascript">
  function submitPaymentForm(transaction_id){
    //alert(transaction_id); return false;

    var donateForm = $("form[name=donateForm]");
    donateForm.find(".form-group").removeClass( "has-error" );
    donateForm.find(".help-block").remove();

    formData = donateForm.serialize()+'&transaction_id='+transaction_id;

    var _token = '{{ csrf_token() }}';

    $.ajax({
      url: "{{ url('donation_save') }}",
      type: "POST",
      data: formData,
      dataType:"JSON",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      beforeSend:function(){
        donateForm.find(".form-group").removeClass( "has-error" );
        donateForm.find(".help-block").remove();
      },
      success: function(resp){
        if(resp.success) {
          var data = resp.data;
          $(".msg").html('<div class="alert alert-success">Thank You For Your Support</div>');
          $("#donateForm")[0].reset();
          var id = data.donation_id;
          var url = "<?php echo url('downloadreciept')?>/" + id;
          //console.log(url);
          // alert(url);
        window.location.href = url;
      }
      else if(resp.errors){

        var errTag;
        var countErr = 1;

        $.each( resp.errors, function ( i, val ) {

          //donateForm.find( "[name='" + i + "']" ).parents(".form-group").addClass( "has-error" );
          donateForm.find( "[name='" + i + "']" ).parents(".form-group").append( '<p class="help-block">' + val + '</p>' );

          if(countErr == 1){
            errTag = donateForm.find( "[name='" + i + "']" );
          }
          countErr++;

        });

        if(errTag){
          errTag.focus();
        }
      }
    }
  });
  }


  $(document).on("click", ".buttonDonate", function(e){

    var total_donation = $('#total_donation').html();
    var contact_name = $('#first_name').val();
    var donation_amount = $('#donation_amount').val();
    var contact_email = $('#contact_email').val();
    var contact_phone = $('#phone').val();
    e.preventDefault();
    var logoUrl = "{{asset('public/images/logo.png')}}";
    var total_donation = parseInt(total_donation);
    $('#error_price').html('');
    if(total_donation == 0 || total_donation == NaN || donation_amount == 0 || donation_amount == NaN){
        $('#error_price').html('Please Enter amount More than 0.');
       return false;
    }
   
    
    if($("#donateForm").isValid()){

      var currSel = $(this);

      var options = {
        //rzp_test_sh26xjAp13bP6T
      // /{{ config('custom.RAZORPAY_KEY') }}
      key: "{{ config('custom.RAZORPAY_KEY') }}",
      amount: total_donation * 100,
      id: "{{123}}",
      name: 'Blindwelfaresociety',
      image: logoUrl,
      "prefill": {
        "name": contact_name,
        "email": contact_email,
        "contact": contact_phone
      },
      handler: demoSuccessHandler
    }

    window.r = new Razorpay(options);
    var succ = r.open();
    if(succ){

      return false;
    // var donateForm = $("form[name=donateForm]");
    // donateForm.find(".form-group").removeClass( "has-error" );
    // donateForm.find(".help-block").remove();

    // var _token = '{{ csrf_token() }}';
  }
}
});

    // $('#donateForm').submit(function (e) {
    //     var button = $(this).find('button');
    //     var parent = $(this);
    //     button.attr('disabled', 'true').html('Please Wait...');
    //     $.ajax({
    //         method: 'get',
    //         url: this.action,
    //         data: $(this).serialize(),
    //         complete: function (r) {
    //             console.log('complete');
    //             console.log(r);
    //         }
    //     })
    //     return false;
    // })




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

        var transaction_id = transaction.razorpay_payment_id;

        submitPaymentForm(transaction_id);
      }


    /*window.r = new Razorpay(options);
    document.getElementById('paybtn').onclick = function () {
        r.open()
      }*/
    </script>