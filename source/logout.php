<?php

    global $web;

?>
<!-- Marker: Logout Begin -->
<style>
    .input.button#continue{
        display:block;
        margin-left:auto;
        margin-right:auto;
    }
</style>
<input id='continue' class='input button alert large' type='button' value='Continue Procedure' />
<div class="dialog panel wrapper" style="display:none;">
    <h2 class="global header large"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Now Logging Out...</h2>
</div>
<?php Doc::load_uncached_script('guard.neetgroup.net/source/js/logout.js'); ?>
<!-- Marker: Logout End -->