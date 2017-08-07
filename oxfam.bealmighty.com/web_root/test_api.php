<?

foreach (glob("vendor/*.php") as $filename){
    include $filename;
}

use Blue\Tools\Api\Client;

if($_REQUEST['a'] == 1 && $_REQUEST["petition_submit"] == true ){
  $client = new Client(BSD_API_ID, BSD_API_SECRET, BSD_API_BASEURL);
  $email = urlencode($_REQUEST["email"]);
  $last_name = $_REQUEST["last_name"];
  $first_name = $_REQUEST["first_name"];
  $zip = $_REQUEST["zip"];

  $xml = '<?xml version="1.0" encoding="utf-8"?><api><signup_form id="9"><signup_form_field id="82">'.$email.'</signup_form_field><signup_form_field id="83">'.$first_name.'</signup_form_field><signup_form_field id="84">'.$last_name.'</signup_form_field><signup_form_field id="88">'.$zip.'</signup_form_field><signup_form_field id="89">US</signup_form_field></signup_form></api>';
  $response = $client->post('signup/process_signup', ['email' => $email, 'firstname' => $first_name, 'lastname' => $last_name, 'country' => 'US']);

  echo $response;
}else{

?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Prototype</title>
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1" />
        <meta name="description" content=" "/>
        <link rel="canonical" href="" />
        <link rel="stylesheet" href="css/bootstrap_full.min.css">
        <link rel="stylesheet" href="fonts/fonts.css">
        <link rel="stylesheet" href="css/template4.css">
        <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
        <script>window.jQuery || document.write('<script src="http://www.runtheloop.com/files/themes/the_loop/assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script type='text/javascript' src='js/vendor/modernizr-2.7.0.min.js'></script>
        <script src="https://w.soundcloud.com/player/api.js" type="text/javascript"></script>
    </head>
    <body>


      <script type="text/javascript">

$(document).ready(function(){
  console.log("ready to do this...");

  var url = "https://secure2.oxfamamerica.org/page/s/poultry-petition",
      data = {
        "email": "corey@tset.com",
        "firstname": "testfirst",
        "lastname": "testlast",
        "country": "US"
      };

  $.post(url, data).done(function( data ) {
    // alert( "Data Loaded: " + data );
    console.log(data);
  });

});

      </script>

    </body>
</html>


      <? }?>
