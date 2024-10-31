<?php
 $data_count = get_option('data_count');
 $every_page = get_option('every_page');
 if ($every_page == 1 || !isset($every_page))
 {
     $checked = 'checked';
 }else
 {
     $checked = '';
 }
 ?>
<div class="wrap">
<div id="icon-tools" class="icon32 icon32-script-inserter"></div><h2>Plenishable Widget Settings</h2>

<form method="post" action="options.php" name="options">
<?php wp_nonce_field('update-options'); ?>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Product Count</th>
        <td><input type="text" name="data_count" value="<?php echo $data_count ?  $data_count : 4; ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Show on every page</th>
        <td><input type="checkbox" name="every_page" value="1" <?php echo $checked ?>/></td>
        </tr>
    </table>
<input type="hidden" name="action" value="update" />

 <input type="hidden" name="page_options" value="data_count, every_page" />

 <input type="submit" class="button button-primary button-large" name="Submit" value="Save Changes" />

</form>
</div>
