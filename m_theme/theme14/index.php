<?php
	if(isset($_GET['login']))
	{
		include("login.php");
	}
	else
	if(isset($_GET['register']))
	{
		include("register.php");
	}
	else
	{
?>
<!DOCTYPE html>
<!-- saved from url=(0026)./index.php? -->
<html lang="en" class=" js svg mediaqueries"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="<?php echo $path;?>/data/index.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path;?>/data/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $path;?>/data/animate.css">
<script type="text/javascript" src="<?php echo $path;?>/data/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $path;?>/data/jquery.yiiactiveform.js"></script>
<title>AdsMoblead</title>
    <link rel="icon" href="./index.php?images/index/favicon.ico" type="image/x-icon">
    <!-- Scroll To -->
    <script>
        $(function() {
            $('a[href*=#].scrollTo:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    </script>
    <!-- Scroll Top end-->
    <!-- Top Menu -->
    <script>
        $(function() {
            (function topMenuControl(){
                $('.btn-top-menu').on('click', function(){
                    $('.b-top-menu ').toggle();
                });
            })();
        });
    </script>
    <!-- Top Menu -->
    <!-- Go To Top  -->
    <script type="text/javascript">
        $(function() {
            (function goToTop(){
                var $link = $('.b-go-top');
                var isShowedLink = false;

                $link.css('display','none');
                $(window).on('scroll', function(){
                    if ($(window).scrollTop() !== 0) {
                        $link.fadeIn(200);
                        isShowedLink = true;
                    } else {
                        $link.fadeOut(200);
                    }


                });
            })();
        });
    </script>
    <!-- Intro Slider -->
    <script src="<?php echo $path;?>/data/introSlider.js"></script>

    <!-- Go To Top end -->
    <!-- Modals -->
    <script src="<?php echo $path;?>/data/bootstrap.modal.js"></script>
    <!-- Modals end -->
    <!-- SCRIPTS FOR ALL PAGES END -->

    <!-- SCRIPTS FOR CURRENT PAGE -->
    <!-- inViewport  Detection -->
    <script>
        (function($){
            $.fn.isStartToWatch = function() {
                return ($(window).scrollTop() + $(window).height()) > this.offset().top;
            };
        })( jQuery );
    </script>
    <!-- inViewport  Detection end -->

    <!-- Count To  -->
    <script src="<?php echo $path;?>/data/jquery.countTo.js"></script>
    <script type="text/javascript">
        $(function() {
            (function initCountTo(){
                var isAnimationDone = false;
                $(window).on('scroll', function(){
                    if ($('.b-facts-section').isStartToWatch() && !isAnimationDone)  {
                        $('.count-to').countTo();
                        isAnimationDone = true;
                    }
                });
            })();
        });
    </script>
    <!-- Count To end  -->

    <!-- About Us Animation -->
    <script>
        $(function(){
            (function initAboutAnimation(){
                var isAnimationDone = false;
                $(window).on('scroll', function(){
                    if ($('.b-about-section').isStartToWatch() && !isAnimationDone)  {
                        $('.b-about-section .pic .pic-part-1').addClass('bounceInUp').addClass('animated');
                        $('.b-about-section .pic .pic-part-2').addClass('bounceInUp').addClass('animated');
                        $('.b-about-section .pic .pic-part-3').addClass('bounceInUp').addClass('animated');

                        isAnimationDone = true;
                    }
                });
            })();
        });
    </script>
    <!-- About Us Animation -->

    <!-- Fixed Header -->
    <script src="<?php echo $path;?>/data/bootstrap.affix.js"></script>
    <script>
        $(function(){
            $('.b-header').affix({top: 0, bottom: 0});

            (function initFixedHeaderMenuItemActivation(){
                function init() {
                    $('.b-top-menu .link').each(function(){
                        var href = $(this).attr('href').replace('/', '');
                        if (($(window).scrollTop() + $('.b-header').outerHeight()) > $(href).offset().top) {
                            $(this).closest('.item').addClass('active');
                            $(this).closest('.item').prevAll('.item').removeClass('active');
                        } else {
                            $(this).closest('.item').removeClass('active');
                        }
                    });
                };

                init();

                $(window).on('scroll', function(){
                    var refreshIntervalId = setInterval(function() {
                        init();
                        clearInterval(refreshIntervalId);
                    }, 300);
                });
            })();
        });
    </script>
    <!-- Fixed Header end -->
    <!-- SCRIPTS FOR CURRENT PAGE END -->
<script type="text/javascript" charset="UTF-8" src="<?php echo $path;?>/data/7Vpuq00M35wOuIJ4Ae6VhgbPRuzC2GFVmEmA90_ZXQg.js"></script><style type="text/css">

.recaptcha_is_showing_audio .recaptcha_only_if_image,.recaptcha_isnot_showing_audio .recaptcha_only_if_audio,.recaptcha_had_incorrect_sol .recaptcha_only_if_no_incorrect_sol,.recaptcha_nothad_incorrect_sol .recaptcha_only_if_incorrect_sol{display:none !important}</style><script type="text/javascript" src="<?php echo $path;?>/data/reload"></script><script type="text/javascript" src="<?php echo $path;?>/data/reload(1)"></script><script type="text/javascript" src="<?php echo $path;?>/data/reload(2)"></script><script type="text/javascript" src="<?php echo $path;?>/data/reload(3)"></script><script type="text/javascript" src="<?php echo $path;?>/data/reload(4)"></script><script type="text/javascript" src="<?php echo $path;?>/data/reload(5)"></script></head>

<body>
<div class="b-top-line" id="top">
    <div class="b-main">
        <ul class="b-top-line-contact">
            <li class="item">
                <a class="link" href="mailto:support@adsmoblead.com"><i class="fa fa-envelope"></i> support@adsmoblead.com</a>
            </li>
        </ul>
    </div>
</div>
<div class="b-header">
    <div class="b-main">
        <div class="wrapper">
            <a href="<?php echo $path;?>/data/AdsMoblead.html" class="b-logo">
                <img alt="AdsMoblead" src="<?php echo $path;?>/data/logo.png">
            </a>
            <a href="javascript: void(0);" class="btn-top-menu">Menu</a>
            <ul class="b-top-menu visible">
                <li class="item active">
                    <a href="#top" class="link scrollTo">Home</a>
                </li>
                <li class="item">
                    <a href="#features" class="link scrollTo">Features</a>
                </li>
                <li class="item">
                    <a href="#about-us" class="link scrollTo">About us</a>
                </li>
                <li class="item">
                    <a href="#contact" class="link scrollTo">Get in touch</a>
                </li>
                                    <li class="item item-buttons">
                        <a href="./index.php?login" class="btn" title="Log in">Log in</a>
                        <a href="./index.php?register" class="btn" title="Sign up">Sign up</a>
                    </li>
                            </ul>
        </div>
    </div>
</div>
<div class="b-content">
<div class="b-intro-section">
    <div class="b-intro-slider">
        <div class="b-intro-slide b-intro-slide-1 active">
            <div class="slide-inner">
                <div class="wrapper">
                    <div class="text">
                        <h1 class="title animated bounceInDown" data-animation="bounceInDown">
                            Reach your target!
                        </h1>
                        <h2 class="intro animated bounceInDown" data-animation="bounceInDown">
                            The right people get the right message at the right time
                        </h2>
                        <div class="row-button">
                            <a href="./index.php?register" class="btn btn-large btn-primary animated bounceInLeft" data-animation="bounceInLeft" title="Start now!">
                                Start now!
                            </a>
                            <a href="./index.php?#features" class="btn btn-large btn-empty animated bounceInRight" data-animation="bounceInRight" title="Learn more">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-intro-slide b-intro-slide-2">
            <div class="slide-inner">
                <div class="wrapper">
                    <div class="text">
                        <h1 class="title animated" data-animation="bounceInDown">
                            Expert time management
                        </h1>
                        <h2 class="intro animated" data-animation="bounceInLeft">
                            Auto optimization algorithm designed to save time spent on campaign management.
                        </h2>
                        <p class="message animated" data-animation="bounceInRight">
                            You can test and determine the optimal combination of banner and target audience yourself, or just let our Fully Managed service do it for you.
                        </p>
                        <div class="row-button animated" data-animation="bounceInUp">
                            <a href="./index.php?#features" class="btn btn-large btn-empty" title="Learn more">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-intro-slide b-intro-slide-3">
            <div class="slide-inner">
                <div class="wrapper">
                    <div class="text">
                        <h1 class="title animated" data-animation="bounceInDown">
                            Control your ads!
                        </h1>
                        <h2 class="intro animated" data-animation="bounceInLeft">
                            Powerful daily and hourly analytics and detailed reporting for      the media buying process.
                        </h2>
                        <p class="message animated" data-animation="bounceInRight">
                            With the received data you will be able to spot the most successful time intervals for traffic acquisition of different locations and target audiences, and increase the purchase amount.
                        </p>
                        <div class="row-button">
                            <a href="./index.php?register" class="btn btn-large btn-primary animated" data-animation="bounceInUp" title="Get it now!">
                                Get it now!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="./index.php?#" class="nav prev"><i class="fa fa-chevron-left"></i></a>
        <a href="./index.php?#" class="nav next"><i class="fa fa-chevron-right"></i></a>
        <div class="dots">
            <a href="./index.php?#" class="dot active"></a>
            <a href="./index.php?#" class="dot"></a>
            <a href="./index.php?#" class="dot"></a>
        </div>
    </div>
</div>
<div class="b-campaign-management-section" id="features">
    <div class="inner">
        <div class="top-part">
            <div class="inner">
                <div class="b-main">
                    <h2 class="title">
                        Campaign management
                    </h2>
                    <h3 class="intro">
                        Campaign management has never been easier with our unique features
                    </h3>
                    <ul class="list-illustrated">
                        <li class="item item-1">
                            <h4 class="item-title">
                                Big data segmentation algorithm
                            </h4>
                            <p>
                                Anticipate users and make predictions about their future behaviors using their behavioral, geographic and demographic data.
                            </p>
                        </li>
                        <li class="item item-2">
                            <h4 class="item-title">
                                Comprehensive daily and monthly reports
                            </h4>
                            <p>
                                Daily and hourly statistics allow you to see exactly how your campaign is performing and determine the strong sides of your ads.
                            </p>
                        </li>
                        <li class="item item-3">
                            <h4 class="item-title">
                                Multivariate A/B testing
                            </h4>
                            <p>
                                Find the best audiences for your ads by auto splitting targeting in granular segments and getting a side-by-side comparison.
                            </p>
                        </li>
                        <li class="item item-4">
                            <h4 class="item-title">
                                Automatic ad optimization
                            </h4>
                            <p>
                                Automatically promote the best performing ads based on your rules.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-part">
            <div class="inner">
                <div class="b-main">
                    <ul class="list">
                        <li class="item">
                            <h4 class="item-title">Hyperlocal targeting</h4>
                            <p>Locate your target audience accurately by selecting a specific area on a 2D world map.</p>
                        </li>
                        <li class="item">
                            <h4 class="item-title">Multi-product ad</h4>
                            <p>Increase your CTR by 57% and improve your conversion rate by displaying three banners instead of one in the news feed.</p>
                        </li>
                        <li class="item">
                            <h4 class="item-title">Real-Time monitoring</h4>
                            <p>Real-time budget controls for full control and optimization towards ROI.</p>
                        </li>
                        <li class="item">
                            <h4 class="item-title">Creative/promo library</h4>
                            <p>Speed up the process of campaign creation by segmenting promo materials according to project, traffic type or other preferences.</p>
                        </li>
                        <li class="item">
                            <h4 class="item-title">Mass ad creation</h4>
                            <p>You can choose multiple images at the same time for creating ads.</p>
                        </li>
                        <li class="item">
                            <h4 class="item-title">Minimize marketing risks using “alerts”</h4>
                            <p>Keep abreast of your campaigns 24/7 with email and SMS notifications.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="b-facts-section" id="facts">
    <div class="inner">
        <div class="b-main">
            <h2 class="title">
                INTERESTING FACTS &amp; NUMBERS
            </h2>
            <ul class="list">
                <li class="item">
                    <i class="pic pic-1"></i>
                            <span class="number">
                                <span class="count-to" data-from="0" data-to="4" data-speed="3000">4</span>
                                <span class="unit">
                                    Years
                                </span>
                            </span>
                    In the market
                </li>
                <li class="item">
                    <i class="pic pic-2"></i>
                            <span class="number">
                                <span class="count-to" data-from="0" data-to="100" data-speed="4000">100</span>+
                            </span>
                    Promoted apps
                </li>
                <li class="item">
                    <i class="pic pic-3"></i>
                            <span class="number">
                                <span class="count-to" data-from="0" data-to="24" data-speed="2000">24</span>/<span class="count-to" data-from="0" data-to="7" data-speed="2000">7</span>/<span class="count-to" data-from="0" data-to="365" data-speed="5000">365</span>
                            </span>
                    Control
                </li>
                <li class="item">
                    <i class="pic pic-4"></i>
                            <span class="number">
                                <span class="count-to" data-from="0" data-to="30" data-speed="5000">30</span>
                                %+
                            </span>
                    KPI &amp; metrics
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="b-about-section" id="about-us">
    <div class="b-main">
        <h2 class="title">
            About us
        </h2>
        <div class="text">
            <div class="col">
                <p>
                    Our success is in the creation of universal methodologies for advertising and estimation of efficiency based on ROI, CPA, etc. We are always staying on top and following the latest marketing trends. AdsMoblead offers a wide variety of innovative advertising solutions and helps our partners to build their online marketing campaigns with maximum efficiency in two ways: SaaS and Managed Service.
                </p>
            </div>
            <div class="col">
                <p>
                    We are here to help you more effectively and profitably manage your advertising campaigns and scale your businesses. By providing universal tracking and promotion software for your Facebook marketing campaigns we aim to lift all cares from your shoulders and make digital advertising simple for you.
                </p>
            </div>
        </div>
        <div class="pic">
            <i class="pic-part-1 bounceInUp animated"></i>
            <i class="pic-part-2 bounceInUp animated"></i>
            <i class="pic-part-3 bounceInUp animated"></i>
        </div>
    </div>
</div>
<div class="b-index-message-section b-index-message-section_center">
    <div class="inner">
        <div class="b-main">
            <div class="wrapper">
                <div class="cell-message">
                    <h2 class="message">Want to earn with us?</h2>
                </div>
                <div class="cell-button">
                    <a href="./index.php?register" class="btn btn-secondary btn-large" title="Try it now!">Try it now!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="b-contact-section" id="contact">
    <div class="b-main">
        <div class="wrapper">
            <div class="b-contact-form">
                <h3 class="title">
                    Get in touch
                </h3>
                <div class="b-form form">
                    
<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'custom',
        custom_theme_widget: 'recaptcha_widget',
        lang : 'en'
    };

    $(function() {
        $('input.placeholder, textarea.placeholder').blur(function() {
            var label = $(this).parent().find('label span').html();
            if(this.value== '') this.value= label;
        });

        $('input.placeholder, textarea.placeholder').focus(function() {
            var label = $(this).parent().find('label span').html();
            if(this.value == label) this.value='';
        });


    });

    var beforeValidate = function(e) {
            $('input.placeholder, textarea.placeholder', e.context).each(function() {
                var label = $(this).parent().find('label span').html();
                if($(this).val() == label) $(this).val('');
            });
            return true;
        },
        afterValidate = function(e,errors) {
            $('input.placeholder, textarea.placeholder', e.context).each(function() {
                var label = $(this).parent().find('label span').html();
                if($(this).val() == '') $(this).val(label);
            });

            if (errors.ContactUsForm_recaptcha_response_field) {
                $('#recaptcha_widget').addClass('error');
                Recaptcha.reload();
            } else {
                $('#recaptcha_widget').removeClass('error');
            }
            if ($.isEmptyObject(errors)) {
                $.post('', $( "#contact-form" ).serialize())
                    .done(function() { $('#sentMessage').modal('show')});

            }

            return false;
    }
</script>

<form id="contact-form" action="./index.php?contact" method="post">
    <div class="row">
        <div class="col ">
                        <label class="label pic-label-name" for=""><span class="hidden">Name</span></label>            <input class="placeholder" value="Name" name="ContactUsForm[name]" onclick="this.value=''" id="ContactUsForm_name" type="text">            <div class="alert-message" id="ContactUsForm_name_em_" style="display:none"></div>        </div>
        <div class="col ">
                        <label class="label pic-label-phone" for=""><span class="hidden">Phone</span></label>            <input class="placeholder" value="Phone" name="ContactUsForm[phone]" onclick="this.value=''" id="ContactUsForm_phone" type="text" maxlength="30">            <div class="alert-message" id="ContactUsForm_phone_em_" style="display:none"></div>        </div>
    </div>

    <div class="row">
        <div class="col ">
                        <label class="label pic-label-email" for=""><span class="hidden">Email</span></label>            <input class="placeholder" onclick="this.value=''" value="Email" name="email" id="ContactUsForm_email" type="text">            <div class="alert-message" id="ContactUsForm_email_em_" style="display:none"></div>        </div>
        <div class="col ">
                        <label class="label pic-label-skype" for=""><span class="hidden">Skype</span></label>            <input class="placeholder" onclick="this.value=''" value="Skype" name="ContactUsForm[skype]" id="ContactUsForm_skype" type="text" maxlength="30">            <div class="alert-message" id="ContactUsForm_skype_em_" style="display:none"></div>        </div>
    </div>

    <div class="row-textarea">
        <div class="col ">
                        <label class="label pic-label-message" for=""><span class="hidden">Message</span></label>            <textarea class="placeholder" onclick="this.value=''" name="ContactUsForm[message]" id="ContactUsForm_message">Message</textarea>            <div class="alert-message" id="ContactUsForm_message_em_" style="display:none"></div>        </div>
    </div>

    <div class="row-button">

        <script type="text/javascript" src="<?php echo $path;?>/data/challenge"></script><script type="text/javascript" src="<?php echo $path;?>/data/recaptcha.js"></script>
        <noscript>
            &lt;iframe src="//www.google.com/recaptcha/api/noscript?k=your_public_key"
                    height="300" width="500" frameborder="0"&gt;&lt;/iframe&gt;&lt;br&gt;
            &lt;textarea name="recaptcha_challenge_field" rows="3" cols="40"&gt;
            &lt;/textarea&gt;
            &lt;input type="hidden" name="recaptcha_response_field"
                   value="manual_challenge"&gt;
        </noscript>


        <button type="submit" title="contact us" class="btn btn-primary btn-medium">
            Send
        </button>
    </div>


</form>                </div>
            </div>
            <div class="b-contact-info">
                <h3 class="title">
                    Contact us
                </h3>
                <ul class="list">
                    <!--
                    <li class="item">
                        <strong class="label"><i class="fa fa-location-arrow"></i>Address:</strong> 557 Cyan Avenue, Suite 65, <br>
                        New York, CA 9008
                    </li>
                    <li class="item">
                        <strong class="label"><i class="fa fa-phone"></i> Phone:</strong> (123) 456-7890
                    </li>
                    -->
                    <li class="item">
                        <strong class="label"><i class="fa fa-envelope"></i> Email:</strong> support@adsmoblead.com                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_GET['contact'])&&isset($_POST['email']))
{
	?>
	
<div class="modal fade in" id="sentMessage" aria-hidden="false" style="display: block;"><div class="modal-backdrop fade in"></div>
    <div class="modal-dialog b-popup-contact-us-sent">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true"></span>
            <span class="sr-only">Close</span>
        </button>
        <div class="modal-content">
            <div class="b-popup-title ">
                <i class="pic fa-envelope"></i>
                <h2 class="head-title">
                    Contact Us
                </h2>
            </div>
            <div class="popup-content">
                <div class="message">
                    Thanks for your message!
                    <br>
                    We’ll get back to you as soon as possible!
                </div>
            </div>
            <div class="row-button">
                <button type="submit" class="btn btn-primary btn-medium" title="Close" data-dismiss="modal" onclick="document.getElementById('sentMessage').style.display = 'none';">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
	<?php
}
?>


</div>
<div class="b-footer-top">
    <div class="b-main">
        <div class="footer-info">
            High precision instrument that enables the selection of some area on the 2D map of the world and choose the target audience located only in the area with high accuracy. Extremely useful for selecting small regions as well as the audience in the same time zone.
        </div>
        <div class="b-footer-menu">
            <h4 class="title">
                Help
            </h4>
            <ul class="list">
                <li><a href="./index.php?#">F.A.Q.</a></li>
                <li><a href="./index.php?#">Documentation</a></li>
                <li><a href="./index.php?#">Support forum</a></li>
                <li><a href="./index.php?#">Blog</a></li>
            </ul>
        </div>
        <div class="b-footer-menu">
            <h4 class="title">
                Company
            </h4>
            <ul class="list">
                <li><a href="./index.php?#">Who we are</a></li>
                <li><a href="./index.php?#">Terms of service</a></li>
                <li><a href="./index.php?#">Privacy policy</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="b-footer">
    <div class="b-main">
        <ul class="b-line-share b-line-share_footer">
        </ul>
        <p class="copy">© Copyright 2015 AdsMoblead. All rights Reserved.   </p>
    </div>
</div>
<a href="./index.php?#top" class="scrollTo b-go-top" title="Back to top" style="display: none;">
    <i class="fa fa-arrow-up"></i>
</a>

<script type="text/javascript" src="<?php echo $path;?>/data/script-2-_MlhNWo4B0wgMMxB2cXEEA.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
	jQuery('#contact-form').yiiactiveform({'validateOnSubmit':true,'validateOnChange':false,'beforeValidate':beforeValidate,'afterValidate':afterValidate,'attributes':[{'id':'ContactUsForm_name','inputID':'ContactUsForm_name','errorID':'ContactUsForm_name_em_','model':'ContactUsForm','name':'name','enableAjaxValidation':true},{'id':'ContactUsForm_phone','inputID':'ContactUsForm_phone','errorID':'ContactUsForm_phone_em_','model':'ContactUsForm','name':'phone','enableAjaxValidation':true},{'id':'ContactUsForm_email','inputID':'ContactUsForm_email','errorID':'ContactUsForm_email_em_','model':'ContactUsForm','name':'email','enableAjaxValidation':true},{'id':'ContactUsForm_skype','inputID':'ContactUsForm_skype','errorID':'ContactUsForm_skype_em_','model':'ContactUsForm','name':'skype','enableAjaxValidation':true},{'id':'ContactUsForm_message','inputID':'ContactUsForm_message','errorID':'ContactUsForm_message_em_','model':'ContactUsForm','name':'message','enableAjaxValidation':true}],'errorCss':'error'});
});
/*]]>*/
</script>



<div></div><iframe src="about:blank" style="height: 0px; width: 0px; visibility: hidden; border: none; display: none;">This frame prevents back/forward cache problems in Safari.</iframe></body></html>
<?php
	}
?>