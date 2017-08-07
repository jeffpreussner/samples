<?php
require('../config/config.php');
require('../lib/Mobile_Detect.php');
$detect = new Mobile_Detect;

?>
<!DOCTYPE html>
<html class="no-js" lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Prototype</title>
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="description" content=" "/>
        <link rel="canonical" href="" />
        <link rel="stylesheet" href="css/bootstrap_full.min.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/template4.css">
        <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
        <?php
if( $detect->isMobile() || $detect->isTablet() ) { ?>
    <link rel="stylesheet" href="css/mobile.css">

<? }?>

    </head>
    <body class="" >
        <div class="loading" id="loader"></div>
        <div class="main-container">
            <!--[if lte IE 9]>
            <div class="alert alert-warning">
                You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</div>
            <![endif]-->
            <!-- <div class="navbar navbar-inverse navbar-fixed-top">
                <a id="nav-toggle" href="#"><span></span> <b>Menu</b></a> <a href="#" class="petition_link"><span class="cta"><span class="icon_bolt"></span> Take Action</span></a> <a href="http://www.oxfamamerica.org/" target="_blank" class="logo_link"></a>
            </div> -->
            <div id="navigation">
                <div class="menu">
                    <div class="about_container"><a href="#media_modal" class="launch_modal about">Media</a><a href="#about_modal" class="launch_modal about">About</a></div>
                    <a href="#chapter_1_top" class="navLink">One<span>The Introduction</span></a>
                    <a href="#chapter_2_top" class="navLink">Two<span>THE POULTRY MACHINE</span></a>
                    <a href="#chapter_3_top" class="navLink">Three<span>The Line</span></a>
                    <a href="#chapter_4_top" class="navLink">Four<span>Life on The Line</span></a>
                    <a href="#chapter_5_top" class="navLink">Five<span>What you can do</span></a>
                </div>
                <div class="navbar navbar-inverse">
                    <a id="nav-toggle" href="#"><span></span> <b>Menu</b></a> <a href="#" class="petition_link"><span class="cta"><span class="icon_bolt"></span> Take Action</span></a> <a href="http://www.oxfamamerica.org/" target="_blank" class="logo_link"></a>
                </div>
                <div id="progress"></div>
            </div>
            <div class="navigation-bg"></div>
            <div class="petition">
                <div class="form_container">
                    <a href="#" class="petition_link mobile_only"><span class="close">× Close</span></a>
                    <div class="form-content">
                      <p class="signcta">Sign the petition:<br>Your Voice For Theirs</p>
                      <form class="petition_form" id="form">
                          <input type="text" class="firstName" name="first_name" placeholder="First Name">
                          <label class="first_name_error error_status" for="">Test error message</label>
                          <input type="text" class="lastName" name="last_name" placeholder="Last Name">
                          <label class="last_name_error error_status" for="">Test error message</label>
                          <input type="email" class="email" name="email" placeholder="Email">
                          <label class="email_error error_status" for="">Test error message</label>
                          <input type="zip" class="zip" name="zip" placeholder="Zip Code">
                          <label class="zip_error error_status" for="">Test error message</label>
                          <input type="submit" value="Submit" class="submit" name="submit">
                          <label class="global_error error_status"></label>
                      </form>
                    </div>
                    <div class="form-success">
                      <p class="signcta">Thank you for signing!<br>Now please tell your friends</p>
                      <div class="social-icons clearfix">
                        <a href="#">Twitter</a>
                        <a href="#">facebook</a>
                      </div>
                      <p class="sub-text">Lorem ipsum dolor sit amet, adipiscing elit. Quisque libero quam, tincidunt vestibulum enim nec, auctor elementum quam.</p>
                    </div>
                </div>
                <div class="petition_text">
                    <a href="#" class="petition_link desktop_only"><span class="close">&times; Close</span></a>
                    <h3 class="petition_heading">Act now: Demand fair, safe working conditions for poultry workers</h3>
                    <? include('inc/petition_text.php'); ?>
                </div>
            </div>
        </div>
        <div class="main-content" id="skrollr-body">
            <div id="template_wrapper" class="entry-content">
                <?include('inc/chapter1.php');?>
                <?include('inc/chapter2.php');?>
                <?include('inc/chapter3.php');?>
                <?include('inc/chapter4.php');?>
                <?include('inc/chapter5.php');?>
                <div class="footer module">

                <div class="container-fluid module_text1 section_background section1">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="text_overlay mobile-m-bottom-0 mobile-m-top-0">
                                <h3>Lives on the Line</h3>
                                <a href="#" class="bold">Acknowledgements</a>
                                <a href="#" class="bold">Download full report</a>
                                <a class="bold" href="http://www.oxfamamerica.org/explore/inside-oxfam-america/" target="_blank">Learn More about Oxfam America</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <div class="text_overlay mobile-m-bottom-0">
                                <img class="footer_logo" src="images/footer_logo.jpg">
    <p>© 2015 Oxfam America Inc. All rights reserved.</p>
    <p>Oxfam America is a global organization working to right the wrongs of poverty, hunger, and injustice. As one of 17 members of the international Oxfam confederation, we work with people in more than 90 countries to create lasting solutions.</p>
    <p>Oxfam America is a 501(c)(3) organization. <a href="#">Privacy & Legal</a></p>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <!--VIDEO MODAL CHAPTER 1-->
        <div class="modal video_modal" id="chapter_1_video_modal">
            <div id="video_player_01" class="container module_video video_player" data-src="media/fpo" data-poster="http://placehold.it/1280x700" data-id="01">
                <div  class="videoContainer">
                    <a href="#" class="fake_play" style="display: none;" data-id="01">play</a><a href="#" class="fake_pause" data-id="01">pause</a>
                    <a class="close" href="#">&times; Close</a>
                    <div id="video_01" class="jp-jplayer"></div>
                    <div class="seek-bar" id="vid_01_seek_bar"><div class="play-bar" id="vid_01_play_bar"></div></div>
                </div>
                <button class="play_btn" id="vid_01_play">play</button><button class="pause_btn" id="vid_01_pause">pause</button>
                <div class="time">
                    <span class="current_time" id="vid_01_currentTime"></span> / <span class="duration" id="vid_01_duration"></span>
                </div>
            </div>
        </div>
        <!--VIDEO MODAL CHAPTER 2-->
        <script type="text/javascript">
        var SERVER_URL = "<?=SERVER_URL?>";
        </script>
        <script type='text/javascript' src='js/bios.js'></script>
        <script type='text/javascript' src='js/skrollr.js'></script>
        <script type='text/javascript' src='js/skrollr.menu.js'></script>
        <script type='text/javascript' src='js/jquery.flexslider-min.js'></script>
        <!-- <script type='text/javascript' src="js/jquery.nicescroll.min.js"></script> -->
        <script type='text/javascript' src='js/isInViewport.min.js'></script>
        <script type='text/javascript' src='js/backgrounds.js'></script>
        <script type='text/javascript' src='js/jquery.jplayer.js'></script>
        <script type='text/javascript' src="js/countUp.min.js"></script>
        <script type='text/javascript' src="js/main.js"></script>

        <div class="modal video_modal" id="chapter_2_video_modal">
            <div id="video_player_02" class="container module_video video_player" data-src="media/Sub_Video/2-3-Poultry-machine-Jose-Luis-HD" data-poster="images/video_sub-Ch2-CH2MV1_CHAPTER_2_VIDEO_1_master_1920X1080_ProRes422_091815.jpg" data-id="02">
                <div  class="videoContainer">
                    <a href="#" class="fake_play" style="display: none;" data-id="02">play</a><a href="#" class="fake_pause" data-id="02">pause</a>
                    <a class="close" href="#">&times; Close</a>
                    <div id="video_02" class="jp-jplayer"></div>
                    <div class="seek-bar" id="vid_02_seek_bar"><div class="play-bar" id="vid_02_play_bar"></div></div>
                </div>
                <button class="play_btn" id="vid_02_play">play</button><button class="pause_btn" id="vid_02_pause">pause</button>
                <div class="time">
                    <span class="current_time" id="vid_02_currentTime"></span> / <span class="duration" id="vid_02_duration"></span>
                </div>
            </div>
        </div>
        <div class="modal video_modal" id="chapter_4_video_modal">
            <div id="video_player_04" class="container module_video video_player" data-src="media/Sub_Video/2-4Three-problems-Bacilios-injury-web" data-poster="http://placehold.it/1280x700" data-id="04">
                <div  class="videoContainer">
                    <a href="#" class="fake_play" style="display: none;" data-id="04">play</a><a href="#" class="fake_pause" data-id="04">pause</a>

                    <a class="close" href="#">&times; Close</a>
                    <div id="video_04" class="jp-jplayer"></div>
                    <div class="seek-bar" id="vid_04_seek_bar"><div class="play-bar" id="vid_04_play_bar"></div></div>
                </div>
                <button class="play_btn" id="vid_04_play">play</button><button class="pause_btn" id="vid_04_pause">pause</button>
                <div class="time">
                    <span class="current_time" id="vid_04_currentTime"></span> / <span class="duration" id="vid_04_duration"></span>
                </div>
            </div>
        </div>
        <div class="modal video_modal" id="chapter_4b_video_modal">
            <div id="video_player_04b" class="container module_video video_player" data-src="media/Sub_Video/2-4-Three-problems-Claims-denied-web" data-poster="images/video_sub-Ch4-2-4-Three-problems--Claims-denied.jpg" data-id="04b">
                <div  class="videoContainer">
                    <a href="#" class="fake_play" style="display: none;" data-id="04b">play</a><a href="#" class="fake_pause" data-id="04b">pause</a>
                    <a class="close" href="#">&times; Close</a>
                    <div id="video_04b" class="jp-jplayer"></div>
                    <div class="seek-bar" id="vid_04b_seek_bar"><div class="play-bar" id="vid_04b_play_bar"></div></div>
                </div>
                <button class="play_btn" id="vid_04b_play">play</button><button class="pause_btn" id="vid_04b_pause">pause</button>
                <div class="time">
                    <span class="current_time" id="vid_04b_currentTime"></span> / <span class="duration" id="vid_04b_duration"></span>
                </div>
            </div>
        </div>
        <div class="modal video_modal" id="chapter_4c_video_modal">
            <div id="video_player_04c" class="container module_video video_player" data-src="media/Sub_Video/2-4-Three-Problems-Everyday-living-web" data-poster="video_sub-Ch4-2-4-Three-Problems--Everyday-living.jpg" data-id="04c">
                <div  class="videoContainer">
                    <a href="#" class="fake_play" style="display: none;" data-id="04c">play</a><a href="#" class="fake_pause" data-id="04c">pause</a>
                    <a class="close" href="#">&times; Close</a>
                    <div id="video_04c" class="jp-jplayer"></div>
                    <div class="seek-bar" id="vid_04c_seek_bar"><div class="play-bar" id="vid_04c_play_bar"></div></div>
                </div>
                <button class="play_btn" id="vid_04c_play">play</button><button class="pause_btn" id="vid_04c_pause">pause</button>
                <div class="time">
                    <span class="current_time" id="vid_04c_currentTime"></span> / <span class="duration" id="vid_04c_duration"></span>
                </div>
            </div>
        </div>
        <div class="modal bio" id="bio">
            <div class="container">
                <div class="row">
                    <a href="#" class="close">&times; Close</a>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <img class="bio_image" src="">
                        <div class="bio_cap">
                        </div>
                        <div class="bio_name"></div>
                        <div class="bio_title"></div>
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        <div class="bio_quote"></div>
                        <div class="bio_text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="about_modal">
            <div class="container">
                <a href="#" class="close">&times; Close</a>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="text_overlay">
                            <a href="" class="greenlink full-report">Download the full report</a>
                            <h3>A note about privacy</h3>
                            <p>Most of the workers interviewed requested the use of pseudonyms out of fear of retribution. Where possible, details about their plant, job, and location have been included.</p>
                            <p>Many workers generously agreed to be photographed or videotaped, with the goal of sharing their stories and experiences. Some workers were too worried about harmful consequences to themselves and their families; they are portrayed incognito (for example, in silhouette).</p>
                            <h3>Thank you</h3>
                            <p>We are profoundly grateful to the workers who were willing to talk honestly and openly about their experiences in the poultry industry. They showed great courage and grace under pressure.</p>
                            <p>In addition, we consulted numerous experts and advocates about the realities of life for poultry processing workers in the US today. We are grateful for their knowledge, commitment, and willingness to share their expertise.</p>
                            <p>The following people were particularly generous with their time:</p>
                            <ul>
                                <li>Christopher Cook</li>
                                <li>Tom Fritzsche</li>
                                <li>Christopher Leonard</li>
                                <li>Celeste Monforton</li>
                                <li>Angela Stuesse</li>
                                <li>Darcy Tromanhauser and Omaid Zabih of Nebraska Appleseed</li>
                                <li>The staff at the Northwest Arkansas Workers’ Justice Center</li>
                                <li>The staff at the Western North Carolina Workers’ Center</li>
                                <li>The staff at Southern Poverty Law Center</li>
                                <li>United Food and Commercial Workers</li>
                            </ul>
                            <h3>Credits</h3>
                            <p>Videography by Alan Grazioso Production (credit as noted in contract)</p>
                            <p>Photography by John D. Simmons/The Charlotte Observer, Earl Dotter/Oxfam America</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="media_modal">
            <div class="container">
                <a href="#" class="close">&times; Close</a>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="text_overlay">
                            <a href="" class="greenlink full-report">Download the full report</a>
                            <h3>A note about privacy</h3>
                            <p>Most of the workers interviewed requested the use of pseudonyms out of fear of retribution. Where possible, details about their plant, job, and location have been included.</p>
                            <p>Many workers generously agreed to be photographed or videotaped, with the goal of sharing their stories and experiences. Some workers were too worried about harmful consequences to themselves and their families; they are portrayed incognito (for example, in silhouette).</p>
                            <h3>Thank you</h3>
                            <p>We are profoundly grateful to the workers who were willing to talk honestly and openly about their experiences in the poultry industry. They showed great courage and grace under pressure.</p>
                            <p>In addition, we consulted numerous experts and advocates about the realities of life for poultry processing workers in the US today. We are grateful for their knowledge, commitment, and willingness to share their expertise.</p>
                            <p>The following people were particularly generous with their time:</p>
                            <ul>
                                <li>Christopher Cook</li>
                                <li>Tom Fritzsche</li>
                                <li>Christopher Leonard</li>
                                <li>Celeste Monforton</li>
                                <li>Angela Stuesse</li>
                                <li>Darcy Tromanhauser and Omaid Zabih of Nebraska Appleseed</li>
                                <li>The staff at the Northwest Arkansas Workers’ Justice Center</li>
                                <li>The staff at the Western North Carolina Workers’ Center</li>
                                <li>The staff at Southern Poverty Law Center</li>
                                <li>United Food and Commercial Workers</li>
                            </ul>
                            <h3>Credits</h3>
                            <p>Videography by Alan Grazioso Production (credit as noted in contract)</p>
                            <p>Photography by John D. Simmons/The Charlotte Observer, Earl Dotter/Oxfam America</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal"><a class="close" href="#">&times;</a><div class="modal_title"></div><div class="modal_content"></div></div>
    </body>
</html>
