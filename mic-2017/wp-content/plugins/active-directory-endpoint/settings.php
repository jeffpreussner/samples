<form method="post" id="active_dir_media_upload"  name="active_dir_media_upload" action="options.php" enctype="multipart/form-data">
    <?php  settings_fields( "ad_sync_settings" ); ?>

    <h2>Active Directory Sync Settings</h2>

    <table class="form-table" style="max-width: 55em;">
        <tbody>
        <tr>
            <th scope="row">Client Host</th>
            <td>
                <input type="text" class="regular-text code" id="<?php echo "client_host"; ?>" name="<?php echo "client_host"; ?>" value="<?php echo get_option( "client_host" ); ?>" />
            </td>
        </tr>

        <tr>
            <th scope="row">Import ID</th>
            <td>
                <input type="text" class="regular-text code" id="<?php echo "import_id"; ?>" name="<?php echo "import_id"; ?>" value="<?php echo get_option( "import_id" ); ?>" />
            </td>
        </tr>

        </tbody>
    </table>

    <input type="submit" value="Save Settings" />
</form>
