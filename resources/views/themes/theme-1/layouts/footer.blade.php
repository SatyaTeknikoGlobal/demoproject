<footer class="fullwidth footerBox"> 
  <div class="fullwidth footer-top">
  <div class="container">
    <h4>Footer Menu</h4>
  </div> 
    <div class="container clearfix">
      <div class="fbox one ft-links">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('our-projects')}}">Our Projects</a></li>
          <!-- <li><a href="{{url('about-us')}}">About Us</a></li> -->
          <!-- <li><a href="{{url('our-founder')}}">Our Founder</a></li> -->
          <!-- <li><a href="{{url('mission-and-vision')}}">Mission and Vision</a></li> -->
          <!-- <li><a href="{{url('volunteer')}}">Donate</a></li> -->
        </ul> 
      </div>
      <div class="fbox two ft-links">
        <ul class="ft-link">
          <li><a href="{{url('contact-us')}}">Contact</a></li>
          <li><a href="{{url('news')}}">News & Events</a></li>
          <!-- <li><a href="{{url('our-projects')}}">Our Projects</a></li>
          <li><a href="{{url('news')}}">News & Events</a></li>
          <li><a href="{{url('blogs')}}">Blogs</a></li>
          <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
          <li><a href="{{url('terms-conditions')}}">Terms &amp; Conditions</a></li>
          <li><a href="{{url('contact-us')}}">Contact</a></li> -->
        </ul> 
      </div>
      <div class="fbox ft-links"> 
        <ul>
           <li><a href="{{url('terms-conditions')}}">Terms &amp; Conditions</a></li>
             <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
        </ul>
       <!--  <h4>Get in Touch</h4> -->
        <?php //echo $FOOTER_CONTACT_DETAILS; ?>

        <?php /*
        if(!empty($SITE_ADDRESS)){
          ?>
          <h3 class="sp-text">Address:</h3>
          <div class="address-text"><?php echo"$SITE_ADDRESS"; ?> </div>
          <?php
        }
        if(!empty($SITE_EMAIL)){
          ?>
          <h3 class="sp-text">Email:</h3>
          <p><a href="mailto:{{$SITE_EMAIL}}"><i class="mailicon-blue"></i>{{$SITE_EMAIL}}</a></p>
          <?php
        }
        if(!empty($SITE_PHONE)){
          ?>
          <h3 class="sp-text">Landline:</h3>
          <p><a href="tel:+91-11-25948803"><i class="phoneicon-blue"></i>+91-11-25948803</a></p>
          <h3 class="sp-text">Mobile:</h3>
          <p><a href="tel:{{$SITE_PHONE}}"><i class="mobileicon-blue"></i>{{$SITE_PHONE}}</a></p>
          <?php
        }
        */ ?> 
        <div class="ft-social-links">
            <h4 class="title">Social Links</h4>
            <ul class="social-links clearfix">
              <?php
              //prd($FACEBOOK);
              if(!empty($FACEBOOK)){
                ?>
                <li><a class="facebook-link" title="Facebook" href="{{$FACEBOOK}}" target="_blank"><i class="facebookicon"></i></a></li>
                <?php
              }
              if(!empty($YOUTUBE)){  
                ?>
                <li><a class="youtube-link" title="Youtube" href="{{$YOUTUBE}}" target="_blank"><i class="youtubeicon"></i></a></li>
                <?php
              }
              /*if(!empty($TWITTER)){
                ?>
                <li><a href="{{$TWITTER}}" target="_blank"><i class="twittericon"></i></a></li>
                <?php
              }
              if(!empty($LINKEDIN)){
                ?>
                <li><a href="{{$LINKEDIN}}" target="_blank"><i class="linkedinicon"></i></a></li>
                <?php
              }
              if(!empty($INSTAGRAM)){
                ?>
                <li><a href="{{$INSTAGRAM}}" target="_blank"><i class="instagramicon"></i></a></li>
                <?php
              }
               if(!empty($PINTEREST)){
                ?>
                <li><a href="{{$PINTEREST}}" target="_blank"><i class="pinteresticon"></i></a></li>
                <?php
              }*/
              ?>
          </ul>
        </div>
      </div>  
    </div> 
  </div>  
  <div class="footer-bottom">
    <div class="container clearfix">
      <div class="copyright-text">{{$SITE_COPYRIGHT_TEXT}}</div>
     <!--  <div class="design-by">
        Design by : <a title="Indiainternets" target="_blank" rel="nofollow" href="https://www.indiainternets.com/"><i class="indiainternets-icon"></i></a>
      </div> -->
    </div>
  </div>
  <div id="topscroll" style="display: block;"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
</footer>
<script>
   $("nav:first").accessibleMegaMenu({
    /* prefix for generated unique id attributes, which are required 
       to indicate aria-owns, aria-controls and aria-labelledby */
    uuidPrefix: "accessible-megamenu",

    /* css class used to define the megamenu styling */
    menuClass: "nav-menu",

    /* css class for a top-level navigation item in the megamenu */
    topNavItemClass: "nav-item",

    /* css class for a megamenu panel */
    panelClass: "sub-nav",

    /* css class for a group of items within a megamenu panel */
    panelGroupClass: "sub-nav-group",

    /* css class for the hover state */
    hoverClass: "hover",

    /* css class for the focus state */
    focusClass: "focus",

    /* css class for the open state */
    openClass: "open"
});
</script>
<script>
    $(function () {
        $(".navbar-toggle").click(function(){
            $( this ).children( ".sr-only" ).html($( this ).children( ".sr-only" ).html()=="Show Navigation" ? "Hide Navigation" : "Show Navigation");
        });
    });
</script>
<!-- <script>
    window.onscroll = function() {myFunction()};
    
    var navbar = document.getElementById("sticky_menu");
    var sticky = navbar.offsetTop;
    
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }
    </script> -->
<script>jQuery(document).ready(function($){
            var offset = 300,
                offset_opacity = 1200,
                scroll_top_duration = 700,
                $back_to_top = $('.cd-top');
            $(window).scroll(function(){
                ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
                if( $(this).scrollTop() > offset_opacity ) {
                    $back_to_top.addClass('cd-fade-out');
                }
            });
            $back_to_top.on('click', function(event){
                event.preventDefault();
                $('body,html').animate({
                    scrollTop: 0 ,
                     }, scroll_top_duration
                );
            });
        });

      </script>