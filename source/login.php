<?php

    global $web;

?>
<!-- Marker: Login Begin -->
<script src='//guard.neetgroup.net/source/js/libs/jquery_cookie.js'></script>
<script>
    $('.input.textbox#username').ready( function(){
       if ($.cookie('GUARD_SAVEU')) {
            $('.input.textbox#username').attr('value', $.cookie('GUARD_SAVEU'));
       } 
    });
</script>
<div class="dialog panel wrapper" style="display:none;">
    <h1 class="global header large"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Now Redirecting...</h1>
</div>
<div class='login panel wrapper'>
    <div class='login panel left'>
        <img class='guard icon large' src ='//guard.neetgroup.net/source/img/guard_icon_large.png' title="Powered By Guard">
        <p class='guard icon message'>Powered by Guard</p>
    </div>
    <div class='login panel right'>
        <div class='login panel main'>
            <h1 class='global header small'>Log in or Sign up</h1>
            <form class='login panel form' name='login'>
                <p class='input section'>
                    <label class='input label' for='username'>
                        Username<br>
                        <input id='username' class='input textbox info' type='text' name='username' />
                    </label>
                </p>
                <p class='input section'>
                    <label class='input label' for='password'>
                        Password<br>
                        <input id='password' class='input textbox info' type='password' name='password' />
                    </label>
                </p>
                <p class='input section'>
                    <input id='login' class='input button info small' type='submit' value='Login' onclick="return false;" />
                    <input id='register' class='input button alert small' type='button' value='Register' />
                </p>
            </form>
        </div>
        <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/login.js'); ?>
    </div>
</div>
<!-- Marker: Login End -->