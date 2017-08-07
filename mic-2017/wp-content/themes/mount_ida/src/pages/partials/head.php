<!DOCTYPE html>
<!--[if IEMobile 7 ]> <html dir="ltr" lang="en-US"class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html dir="ltr" lang="en-US" class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html dir="ltr" lang="en-US" class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html dir="ltr" lang="en-US" class="no-js ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html dir="ltr" lang="en-US" class="ie9"> <![endif]-->
<!--[if IE 10 ]>   <html dir="ltr" lang="en-US" class="ie10"> <![endif]-->
<!--[if IE 11 ]>   <html dir="ltr" lang="en-US" class="ie11"> <![endif]-->

<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html dir="ltr" lang="en-US" class="no-js"><!--<![endif]-->
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-TR8SBSQ');</script>
  <!-- End Google Tag Manager -->

    <title><?php echo wp_get_document_title(); ?></title>
    <!--<meta charset="UTF-8">-->
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <?php wp_head(); ?>
    <script>window.wp_theme_dir_uri="<?php echo $theme_dir_uri;?>"</script>
  </head>
  <?php
  if (is_tax('schools')) :
    $taxonomy = get_queried_object();
    $bodyClass = get_field('page_css_class', get_term($taxonomy->term_id));
  elseif (is_singular( 'areas_of_study' ) ) :
    $schools = new WPSEO_Primary_Term('schools', get_the_ID());
    $mainSchool = $schools->get_primary_term();
    $bodyClass = get_field('page_css_class', 'term_' . $mainSchool);
  endif;
  ?>
  <body id="<?php echo $pagename;?>" <?php ((is_tax() || is_singular( 'areas_of_study' )) && isset($bodyClass) ? body_class($bodyClass) : body_class()) ; ?>>
    <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TR8SBSQ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
    <main>
