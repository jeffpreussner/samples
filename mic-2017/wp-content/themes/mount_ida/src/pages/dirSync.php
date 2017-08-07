
<?php
  $basic_token = 'YW1lcmNhZG86a1JpSSBQOUJMIHVDbEsgNUF6MCBZRFd0IE1ya00=';
  //1isZ oaCL fm0j LpAB iaW2 5bCL
  //var_dump($auth_token);
  $ch = curl_init();
  $file_name = 'DirectoryData.zip';
  $file_path = "/Users/amercado/Documents/mic/" . $file_name;

  if (file_exists($file_path)) :
    echo '<br>File exist';
    $file_content = @file_get_contents($file_path);

    // curl_setopt($ch, CURLOPT_URL, 'http://mic.dev/wp-json/directory/v1/faculty');
    curl_setopt($ch, CURLOPT_URL, 'http://mic.dev/wp-json/wp/v2/media');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-type: Content-type: application/zip',
      'Authorization: Basic ' . $basic_token,
      'Content-Disposition: attachment; filename="'.$file_name.'"'
		));

    // curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $file_content);
    curl_exec($ch);

    // close the session
    curl_close($ch);
  endif;

?>
