<?php

	global $user;
    
    global $web;
    // $web->utility->debug->__invoke();
?>
<!-- Marker: Developers Begin -->
<div id="developers" class="page panel wrapper">
    <?php if( !$user->data->guard['developer'] ): ?>
    <div class="notification error wrapper">
        <p id="register" class="notification message" style="cursor:pointer;" title="Click To Register"><i class="fa fa-minus-circle"></i>&nbsp;Developer Credentials Cannot Be Acquired (Click Me)</p>
    </div>
    <?php else: ?>
    <div class="notification valid wrapper">
        <p id="query" class="notification message" style="cursor:pointer;" title="Click To Find Developer Key"><i class="fa fa-search"></i>&nbsp;&nbsp;<u>Grab My Developer Key</u></p>
        <p id="result" class="notification message" style="display:none;"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;<u>Developer Key Returned</u>&nbsp;</p>
    </div>
    <form id='authentication' class='developers authentication' style="display:none;">
        <p class='input section'>
            <label for='password'>
                Password<br>
                <input id='password' class='input textbox info' type='password' name='password' />
            </label>
        </p>
        <p class='input section'>
            <input id='query' class='input button info small' type='submit' value='Continue' onclick='return false;'  />
        </p>
    </form>
    <?php endif; ?>
	<div class="interface menu wrapper">
        <div class="interface menu left">
            <h1 class="interface menu header">Developer Index</h1>
            <ul class="interface menu list">
                <li id="documentation" class="interface menu item">Documentation</li>
                <li id="api" class="interface menu item">Web API</li>
				<li id="php" class="interface menu item">PHP SDK</li>
				<li id="jquery" class="interface menu item">JQuery SDK</li>
            </ul>
        </div>
        <div class="interface menu right">
            <div class="interface menu content">
                <div id="documentation" class="interface menu input">
                    <h1 class="global header small">Introduction</h1>
                    <p class="developers information">
	                    <u>Guard</u> is a 3rd party data framework and web application developed
	                    by John(Veritas), as an extension to the Group and it's many services.
	                    <u>Guard's</u> initial role was to serve as a licensing system for software, but
	                    it's progressed into a much larger spectacle. <u>Guard's</u> web API offers developers
	                    to query user, project, and subscription data with ease. All data returned
	                    from the web API is also JSON encoded, making it very easy
	                    for deployment and communication.
                    </p>
                    <h1 class="global header small">Developer Keys</h1>
                    <p class="developers information">
                    	Developer Keys are a new subjective idea in <u>Guard</u> 8.
                    	Each <u>Guard</u> user will be endowed their own Developer Key, which they can obtain directly from the Web Portal.
                    	These keys are unique identifiers, used to push requests to <u>Guard's</u> <b>Driver</b>.
                    	Keeping one's developer key private should be top priority when dealing with important data, such as applications and subscriptions.
                    </p>
                    <h1 class="global header small">Modules</h1>
                    <p class="developers information">
                    	The <u>Guard</u> <b>Driver</b> operates using the very simple and coherent notion of <b>Modules</b>.
                    	Modules are, put simply, subset and predefined structures.
                    	They are to be specified whenever a Driver request is made, which the driver then uses to
                    	execute it's provided command. Using this system, intangible concepts such as users and subscriptions
                    	can be be interpreted and managed without any excessive strain.
                    </p>
                    <h1 class="global header small">Applications</h1>
                    <p class="developers information">
                    	In <u>Guard</u> 8, the 'Project' <b>Module</b> was dropped due to it's staggering limitations.
                    	For who were not familiar with <u>Guard</u> 7, the Project Module
                    	allowed developers to store their project data in the cloud using what was known as the GDM (Guard Developer Manager).
                    	This data was though fixed, limiting what developers could actually store or query.
                    	In it's place, a new Module has been introduced to the fray.
                    	The <b>App</b> Module allows developers to store a finite amount of dynamic data in the cloud without restraint.
                    </p>
                    <h1 class="global header small">Subscriptions</h1>
                    <p class="developers information">
                    	Subscriptions have, for quite some time have been a core element of the Group.
                    	With <u>Guard</u> 8, we wanted to systematically incorporate and adopt the concept in an objective and programmatic sense.
                    	We wanted to allow developers the freedom to easily distribute and manage exclusive access to their projects.
                    	<u>Guard</u> 8 allows developers to create their own subscription packages and tags (license keys) with ease using it's robust API.
                    </p>
                </div>
                <div id="api" class="interface menu input">
                    <h1 class="global header small">Guard Web API</h1>
                    <p class="developers information">
	                    <u>Guard's</u> web API allows developers to retreive information both easily and efficiently.
	                    As explained in the documentation, all data returned by the <b>Driver</b>, is JSON encoded. This
	                    makes it easy for communication and structures.
	                    </p>
	                    <h1 class="global header small">Guard Driver</h1>
	                    <p class="developers information">
	                    The <b>Driver</b> reads for both <b>GET</b> and <b>POST</b> requests. It determines the type of request,
	                    dependant on the <b>Developer Key</b> parameter request type.
                    </p>
                    <h1 class="global header small">Driver Requests</h1>
                    <p class="developers information">
	                    <b>Driver</b> requests, as explained above, can be created with both GET and POST requests. When creating a
	                    <b>Driver</b> request, the parameter with the most precedence is the <b>Developer Key</b>. Once the Developer Key
	                    is specified, the driver will look for a module to target to execute the command. As it stands there are currently
	                    four public modules,
                    </p>
<pre>
    <code class="language-javascript">
    var MODULES =
    {
        'user'			: Module.User( ... ),
        'app'  			: Module.App( ... ),
        'subscription'	: Module.Subscription( ... ),
        'util'			: Module.Util( ... ) 
    };
    </code>
</pre>
                <p class="developers information">
                	Each module has their own specific set of commands. <b>Driver</b> requests are structured like so,
                </p>
<pre>
    <code class='language-javascript'>
    var PARAMETERS = 
    {
    	
        key : 'developer_key',
       	mod : 'module',
        cmd : 'command',
       	
          a : null,
          b : null,
          c : null,
          d : null,
          e : null,
          f : null
          
    };
    
    Driver.Execute( PARAMETERS );
    
    /*
     * PSUEDO BREAKDOWN
     *
     
       1. Validate Developer Credentials
       2. Check For Module
       3. Interpret Command Parameters(a,b,c,...)
       4. Run Command via Module Namespace
       
     */
    </code>
</pre>          
                <h1 class="global header small">Module Commands</h1>
                <p class="developers information">
                	A more detailed index and explanation of modules can be found here,
	                <br />
	                <a href="http://guard.neetgroup.net/docs/guard-module-commands.html" style="color:#3498DB;">http://guard.neetgroup.net/docs/guard-module-commands.html</a>
                </p>
                </div>
				<div id="php" class="interface menu input">
                    <h1 class="global header small">Guard PHP SDK</h1>
                    <p class="developers information">
                    Among <u>Guard's</u> various development tools, the official PHP SDK is the most developed and versatile.
                    The PHP SDK is also, a respectively public project. The source code can be forked via John's(Veritas)
                    GitHub. Any and all contributions can be officially attached by contacting <a href="mailto:john@neetgroup.net?subject=guard-php-sdk-contribution" style="color:#3498DB;">john@neetgroup.net</a>.
                    </p>
                    <h1 class="global header small"><a href="https://github.com/neetVeritas/guard-sdk-php"><i class="fa fa-github"></i>&nbsp;fork</a></h1>
                </div>
                <div id="jquery" class="interface menu input">
                    <h1 class="global header small">Guard JQuery SDK</h1>
                    <p class="developers information">
                    The JQuery SDK is a very, very small and simple development kit, specifically designed for the use of web developers.
                    As the PHP SDK, this development kit is openly public. The source code can be forked via John's(Veritas)
                    GitHub.
                    </p>
                    <h1 class="global header small"><a href="https://github.com/neetVeritas/guard-sdk-jquery"><i class="fa fa-github"></i>&nbsp;fork</a></h1>
                </div>
            </div>
        </div>
    </div>
    <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/ui/menu.js'); ?>
    <?php if( $user->data->guard['developer'] ): ?>
    <p id='developer-tools' class='input section'>
        <input id='tools' class='input button alert small' type='button' value='Developer Tools' />
    </p>
    <?php endif; ?>
    <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/developers.js'); ?>
</div>
<!-- Marker: Developers End -->