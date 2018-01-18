<?php
    
    global $web;
    global $page;
    global $statistics;
	
    global $user;
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php if( !$web->utility->online->__invoke() || $web->utility->maintenance->__invoke() ): ?>
                (OFFLINE) Guard - <?php echo $page->title; ?>
            <?php else: ?>
                Guard - <?php echo $page->title; ?>
            <?php endif; ?>
        </title>
        <?php Doc::load_uncached_style('guard.neetgroup.net/source/css/fonts.css'); ?>
        <?php Doc::load_uncached_style('guard.neetgroup.net/source/css/main.css'); ?>
        <?php Doc::load_uncached_style('guard.neetgroup.net/source/css/ui.css'); ?>
        <link rel='stylesheet' type='text/css' href='//guard.neetgroup.net/source/fa-plugin/css/font-awesome.min.css'>
        <link rel='stylesheet' type='text/css' href='//guard.neetgroup.net/source/prism-plugin/prism.css'>
        <script src='//guard.neetgroup.net/source/js/libs/jquery.js'></script>
        <script src='//guard.neetgroup.net/source/prism-plugin/prism.js'></script>
        <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/libs/utility.js'); ?>
        <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/ui/funcs.js'); ?>
        <meta charset="UTF-8">
        <meta name="description" content="Guard Web Portal">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript">
        <meta name="author" content="John Nolette">
    </head>
    <body>
        <!-- Marker: Header Begin -->
        <div class="header">
            <div class="header info wrapper">
				<a class="header info message" href="https://www.cloudatcost.com/pricing.php">Pay a one time fee now for your own cloud server with <i class="fa fa-cloud"></i>&nbsp;cloudatcost</a>
			</div>
            <div class="header logo wrapper">
                <a href="https://guard.neetgroup.net/">
                    <img class="header logo image" src='//guard.neetgroup.net/source/img/logo.png'></img>
                </a>
            </div>
            <!-- Marker: Navigation Begin -->
            <div class="header navigation wrapper">
                <div class="header navigation inner">
                    <ul class="header navigation list">
                        <li class="header navigation tab">
                            <a class="header navigation tab icon" href="https://neetgroup.net/">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <?php if( !$user ): ?> <!-- Marker: Tab Set 1 - Logged Out -->
                        <li class="header navigation tab">
                            <a id="home" class="header navigation tab link" href="https://guard.neetgroup.net/home.doc">Home</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="login" class="header navigation tab link" href="https://guard.neetgroup.net/login.doc">Login</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="register" class="header navigation tab link" href="https://guard.neetgroup.net/register.doc">Register</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="developers" class="header navigation tab link" href="https://guard.neetgroup.net/developers.doc">Developers</a>
                        </li>
                        <?php else: ?> <!-- Marker: Tab Set 2 - Logged In -->
                        <li class="header navigation tab">
                            <a id="home" class="header navigation tab link" href="https://guard.neetgroup.net/home.doc">Home</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="profile" class="header navigation tab link" href="https://guard.neetgroup.net/profile.doc">Profile</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="activity" class="header navigation tab link" href="https://guard.neetgroup.net/activity.doc">Activity</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="settings" class="header navigation tab link" href="https://guard.neetgroup.net/settings.doc">Settings</a>
                        </li>
                        <li class="header navigation tab">
                            <a id="developers" class="header navigation tab link" href="https://guard.neetgroup.net/developers.doc">Developers</a>
                        </li>
                        	<?php if( $user->data->guard['developer'] ): ?>
                        <li class="header navigation tab">
                            <a id="developer-tools" class="header navigation tab link" href="https://guard.neetgroup.net/developer-tools.doc">Tools</a>
                        </li>
                        	<?php endif; ?>
                        <li class="header navigation tab">
                            <a id="logout" class="header navigation tab link" href="https://guard.neetgroup.net/logout.doc">Logout</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/header.js'); ?>
            <!-- Marker: Navigation End -->
            <?php $announcement = $statistics->data['feed']['content']; ?>
            <!-- Marker: Announcement Begin -->
            <div class="header announcement">
                <div class="header announcement wrapper">
                    <p class="header announcement content">
                    <marquee behavior="scroll" direction="right">
                        <?php echo $announcement; ?>
                    </marquee>
                    </p>
                </div>
            </div>
            <!-- Marker: Announcement End -->
        </div>
        <!-- Marker: Header End -->
        <!-- Marker: Wrapper Begin -->
        <div class='global wrapper'>