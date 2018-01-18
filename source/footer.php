<?php

    global $statistics;

?>
	<p class="cookie warning message"><i class="fa fa-warning" style="color:#ffa500;"></i>&nbsp;&nbsp;Please Enable Cookies and Javascript For The Best Experience</p>
</div>
<!-- Marker: Wrapper End -->

<!-- Marker: Disclaimer Begin -->
<div class='disclaimer wrapper'>
    <h1 class='disclaimer title'>Global Disclaimer</h3>
    <p class='disclaimer message'>
        <u>Guard</u> is a 3rd data framework and ecosystem for use of the developers of the Group.
        <br>
        <u>Guard</u> was developed entirely by <a class='copyright link' href="https://www.linkedin.com/pub/john-nolette/89/2a4/b55">John Nolette</a>, as such all rights are reserved to the NEET.Group&copy;.
        <br>
        <u>Guard</u> was created and intended primarily for educational purposes.
    </p>
</div>
<!-- Marker: Disclaimer End -->

<!-- Marker: Bottom Begin -->
<div class='bottom wrapper'>
    <div class='bottom copyright wrapper'>
        <p class='bottom copyright message'><i class='fa fa-suitcase'></i>&nbsp;&nbsp;Website and Design by <a class='copyright link' href='https://www.linkedin.com/pub/john-nolette/89/2a4/b55'>John Nolette</a></p>
    </div>
    <div class='bottom statistics wrapper'>

        <div class='bottom statistics header wrapper'>

            <h2 class='bottom statistics header title'><i class='fa fa-users'></i>&nbsp;&nbsp;Guard Statistics - (<?php echo( sizeof( $statistics->data['users']['active'] ) ); ?>) Active Users</h2>
        </div>
        <p class='bottom statistics active list'>
        <?php
            
            $active_count = sizeof( $statistics->data['users']['active'] );
            if($active_count >= 30):
                
                for($i = ( $active_count - 30 ); $i < $active_count; $i++):
                    
                    if($i !== 0):
                        
                        $user = $statistics->data['users']['active'][$i-1];
                        echo("<a class='bottom statistics user link' href='#'>$user</a>");
                        if($i !== 1):
                            echo(', ');
                        endif;
                        
                    else:
                        
                        echo('...');
                        
                    endif;
                    
                endfor;
                
            else:
                
                for($i = $active_count; $i > 0; $i--):
                    
                    if($i !== 0):
                        
                        $user = $statistics->data['users']['active'][$i-1];
                        echo("<a class='bottom statistics user link' href='#'>$user</a>");
                        if($i !== 1):
                            echo(', ');
                        endif;
                        
                    endif;
                    
                endfor;
                
            endif;
        ?>
        </p>
    </div>
    <div class='bottom social wrapper'>
        <a class='bottom social icon facebook' href='https://facebook.com/NEET.Group'>
            <i class='fa fa-facebook'></i>
        </a>
        <a class='bottom social icon twitter' href='https://twitter.com/neet_veritas'>
            <i class='fa fa-twitter'></i>
        </a>
    </div>
</div>
<!-- Marker: Bottom End -->
<!-- Marker: Footer Begin -->
<div class='footer wrapper'>
    <p class='footer copyright message'>NEET.Group &copy; 2012-2015. All Rights Reserved.</p>
</div>
<!-- Marker: Footer End -->
    </body>
</html>