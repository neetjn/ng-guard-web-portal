<?php

    global $web;
    
    $username = $_GET['u'];
	if( $username ):
		$username = str_replace( ' ', '', $username );
	endif;
	
    
?>
<!-- Marker: Registration Begin -->
<script src='//guard.neetgroup.net/source/js/libs/jquery_cookie.js'></script>
<script>
    $('.input.section.validation').ready( function() {
        $('.input.section.validation').hide();
    });
</script>
<div class="notification valid wrapper" id="free">
    <p class="notification message"><i class="fa fa-check-circle"></i>&nbsp;Guard Registration Is Now Completely Free!</p>
</div>
<div class="dialog panel wrapper" style="display:none;">
    <h1 class="global header large"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Now Redirecting...</h1>
</div>
<div class="registration panel wrapper">
    <div class="registration panel left">
        <h1 class='global header small'>Guard Registration</h1>
            <form class='registration panel form' name='registration'>
                <p class='input section'>
                    <label class='input label' for='username'>
                        Username<br>
                        <?php if(!$username): ?>
                        <input id='username' class='input textbox info' type='text' name='username' />
                        <?php else: ?>
                        <input id='username' class='input textbox info' type='text' name='username' value='<?php echo $username; ?>' />
                        <?php endif; ?>
                    </label>
                </p>
                <p class='input section'>
                    <label class='input label' for='password'>
                        Password<br>
                        <input id='password' class='input textbox info' type='password' name='password' />
                    </label>
                </p>
                <p class='input section'>
                    <input id='register' class='input button info small' type='submit' value='Register' onclick="return false;" />
                    <input id='verify' class='input button valid small' type='button' value='Verify' />
                </p>
                <p class='input section validation'>
                    <label class='input label' for='key'>
                        Validation<br>
                        <input id='key' class='input textbox valid' type='password' name='key' />
                    </label>
                </p>
            </form>
    </div>
    <script src='//guard.neetgroup.net/source/js/libs/webtoolkit.md5.js'></script>
    <script>
        $key = MD5(Math.random().toString());
    </script>
    <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/register.js'); ?>
    <div class="registration panel right">
        <img class='guard icon large' src ='//guard.neetgroup.net/source/img/guard_icon_large.png' title="Powered By Guard">
        <p class='guard icon message'>Powered by Guard</p>
    </div>
</div>
<!-- Marker: Registration End -->