<?php
/**
 * Plugin Name: Active Directory Endpoint
 * Description: Enables WP Rest API and takes an incoming zip file to be procesed and imported
 * Version: 1.1.8
 * Author: ADK Group
 **/


// Block direct access
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Define globals
// define('UPLOAD_DIR', wp_upload_dir('', false));

date_default_timezone_set('America/New_York');

class active_directory_sync {

    public function __construct() {

        // Add hooks needed for the plugin
    		add_action( 'rest_insert_attachment', array($this, 'unzip_csv'), 10, 3);

        // add_action( 'rest_api_init', array($this, 'add_custom_endpoint'));
        //Admin Menu
        add_action( "admin_menu", array( &$this, "addMenuPage" ) );

        //Save plugin settings
        add_action( "admin_init", array( &$this, "registerSettings" ) );

    }


    public function addMenuPage()
    {
        //Only called on admin side
        if ( !is_admin() ) return;

        add_options_page( "Active Directory Sync", "Active Directory Sync", "read", "active_directory_sync_settings", array( &$this, "createSettingsPage" ));

    }

    public function createSettingsPage()
    {
        include( dirname( __FILE__ ) . "/settings.php" );
    }

    public function registerSettings()
    {
        register_setting( "ad_sync_settings", "client_host" );
        register_setting( "ad_sync_settings", "import_id" );
    }


    function add_custom_endpoint() {
      register_rest_route( 'directory/v1', '/faculty', array(
        'methods' => 'POST',
        'callback' => 'download_file',
    		'args' => array(

    		),
    		'permission_callback' => function () {
    			return current_user_can( 'edit_others_posts' );
    		}
    	) );
    } // END function add_custom_endpoint()







    function unzip_csv ($attachment, $request) {
      // var_dump($request);
      $host_name = $request->get_header('host');
      // var_dump($host_name);

      // Get client host
      $clientHost = get_option( "client_host" );
      $importId = get_option( "import_id" );

      // Only fire if is coming from a known host
      //if($host_name = $clientHost) {
        $upload_dir = wp_upload_dir('', false);
        $upload_path = $upload_dir['path'];
        $import_path = $upload_dir['basedir'] . "/wpallimport/files";

        $zip_file_id = $attachment->ID;
        $zip_file_name = $attachment->post_title;
        $zip_file_extension = '.zip';

        // $csv_file_name = 'test_file.txt';


        $file_path = $attachment->guid;

        //echo "<br><br> Location : " . $file_path;

        // $uploaddir = realpath('/Applications/MAMP/htdocs/mic.dev/wp-content/uploads/wpallimport/files');
        $file_path = $upload_path . "/" . $zip_file_name . $zip_file_extension;

        $zip = new ZipArchive;
        if ($zip->open($file_path) === TRUE) {

            // for($i = 0; $i < $zip->numFiles; $i++) {
              $csv_file_name = $zip->getNameIndex(0);
            // }

            $zip->extractTo($import_path);
            $zip->close();
            //echo '<br><br> Filed unzipped';
            if (rename($import_path . '/' . $csv_file_name, $import_path . '/DirectoryData.csv')) {
              // echo '<br><br> ok renaming file! = '.$csv_file_name;
            } else {
              // echo '<br><br> Failed renaming file!';
            }

            // Run Trigger and Import on demand
            $this->import_trigger($importId);



        } else {
            //echo '<br><br> failed';
        }

        if (wp_delete_attachment( $zip_file_id, 'true' )) {
            // echo '<br><br> ok deleting zip file!';
        } else {
            // echo '<br><br> failed deleting zip file!';
        }

        // close json array response

      //}

    } // END function unzip_csv()

    function import_trigger ($id) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => get_site_url() . "/wp-cron.php?import_key=iEhZwFxRO&import_id=" . $id . "&action=trigger",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      // disabling json responses to avoid incorrect JSON formatted array
      // echo '[';
      if ($err) {
        // echo "cURL Error #:" . $err;
      } else {
        // echo $response . ',';
        // Run import now
        $this->import_execution($id);
      }
    }  // END function import_trigger()






    function import_execution ($id) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => get_site_url() . "/wp-cron.php?import_key=iEhZwFxRO&import_id=" . $id . "&action=processing",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        // echo "cURL Error #:" . $err;
      } else {
        // echo $response . ',';
      }

    }  // END function import_execution()




    function download_file( WP_REST_Request $request ) {

      $content_disposition = $request->get_header('content_disposition');

    	$zipFile = $request->get_body();
      var_dump($request);
      echo "<br><br>";
      var_dump($content_disposition);
      echo $file_name = get_file_name($content_disposition);
      if ($zipFile) :
        //var_dump($files);
        $uploaddir = realpath('/Applications/MAMP/htdocs/mic.dev/wp-content/uploads');
        $uploadfile = $uploaddir . '/' . basename($file_name);
        echo $uploaddir;
        echo '<br>';
        echo $uploadfile;
        echo "\n";
        echo '<pre>';


        $zip = new ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            $zip->extractTo($uploaddir);
            $zip->close();
            echo 'ok';
        } else {
            echo 'failed';
        }


      endif ;

      return '{error: 1, message: Missing file in request},';
    } // END function download_file()






    function get_file_name($str) {
        preg_match_all("/\w+\.\w+/", $str, $output);

        return $output[0][0];
    } // END function get_file_name()



}

$active_directory_sync = new active_directory_sync();
