<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */

?>
<div class="fl-twenty-twenty twentytwenty-container">

 <!-- The before image is first -->
 <img src="<?php echo $settings->photo_one_src; ?>" />
 <!-- The after image is last -->
 <img src="<?php echo $settings->photo_two_src; ?>" />
</div>
