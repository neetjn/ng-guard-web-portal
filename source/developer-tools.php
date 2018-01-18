<?php
    
    global $user;
    
    global $web;
    // $web->utility->debug->__invoke();
    
?>
<!-- Marker: Developer Tools Begin -->
<?php

    if( $user->data->guard['developer'] ):
        $developer = new \Library\Struct\Developer( $user->data->guard['developer_key'] );
        
?>
<div id="developer-tools" class="page panel wrapper">
    <div class="interface menu wrapper">
        <div class="interface menu left">
            <h1 class="interface menu header">Developer Tools</h1>
            <ul class="interface menu list">
                <li id="apps" class="interface menu item">Applications</li>
                <li id="subs" class="interface menu item">Subscriptions</li>
            </ul>
        </div>
        <div class="interface menu right">
            <div class="interface menu content">
            	<!-- Marker: Applications Begin -->
                <div id="apps" class="interface menu input">
                    <h1 class='global header small'>New Application</h1>
                    <br />
                    <form id='new' class='tools menu panel form'>
                        <div class='tools panel left'>
                            <p class='input section'>
                                <label class='input label' for='new-app-title'>
                                    Title<br>
                                    <input id='new-app-title' class='input textbox info' type='text' name='new-app-title' />
                                </label>
                            </p>
                            <p class='input section'>
                                <input id='create-app' class='input button valid small' type='submit' value='Create' onclick='return false;' />
                            </p>
                        </div>
                        <div class='tools panel right'>
                            <h1 id='new' class='tools icon'><i class='fa fa-cloud-upload'></i></h1>
                        </div>
                    </form>
                <?php if( $developer->apps ): ?>
                	<br />
                    <h1 class='global header small'>Existing Application(s)</h1>
                <?php
                	foreach( $developer->apps as $identifier=>$application ):
                    	// var_dump( $application );
                ?>
                    <br />
                    <form app='<?php echo $identifier; ?>' class='tools menu panel form' name=''>
                        <div class='tools panel left'>
                            <p class='input section'>
                                <label for='app-title-<?php echo $identifier; ?>'>
                                    Title<br>
                                    <input id='app-title-<?php echo $identifier; ?>' class='input textbox info' type='text' value='<?php echo $application['title']; ?>' />
                                </label>
                            </p>
                            <p class='input section'>
                                <input id='update-app' app='<?php echo $identifier; ?>' class='input button valid small' type='submit' value='Update' onclick="return false;" />
                            </p>
                            <p class='input section'>
                                <label for='app-identifier-<?php echo $identifier; ?>'>
                                    Identifier<br>
                                    <input id='app-identifier-<?php echo $identifier; ?>' class='input textbox valid' type='text' value='<?php echo $identifier; ?>' readonly />
                                </label>
                            </p>
                            <p class='input section'>
                                <input id='renew-app' app='<?php echo $identifier; ?>' class='input button info small' type='button' value='Renew' />
                                <input id='delete-app' app='<?php echo $identifier; ?>' class='input button alert small' type='button' value='Delete' />
                            </p>
                        </div>
                        <div class='tools panel right'>
                            <h1 id='existing' class='tools icon'><i class='fa fa-cogs'></i></h1>
                        </div>
                    </form>
                <?php endforeach ?>
                <?php endif; ?>
                </div>
                <!-- Marker: Applications End -->
                <!-- Marker: Subscriptions Begin -->
                <div id="subs" class="interface menu input">
                	<h1 class='global header small'>New Subscription</h1>
                    <br />
                	<form id='new' class='tools menu panel form'>
                        <div class='tools panel left'>
                            <p class='input section'>
                                <label class='input label' for='new-sub-nomenclature'>
                                    Nomenclature<br>
                                    <input id='new-sub-nomenclature' class='input textbox info' type='text' name='new-sub-nomenclature' />
                                </label>
                            </p>
                            <p class='input section'>
                                <input id='create-sub' class='input button valid small' type='submit' value='Create' onclick='return false;' />
                            </p>
                        </div>
                        <div class='tools panel right'>
                            <h1 id='new' class='tools icon'><i class='fa fa-cloud-upload'></i></h1>
                        </div>
                    </form>
                <?php if( $developer->subs ): ?>
                	<br />
                    <h1 class='global header small'>Existing Subscription(s)</h1>
                <?php
                	foreach( $developer->subs as $identifier=>$subscription ):
                	    // var_dump( $subscription ); // for debugging
                ?>
                <br />
                <form sub='<?php echo $identifier; ?>' class='tools menu panel form' name=''>
                    <div class='tools panel left'>
                        <p class='input section'>
                            <label for='sub-nomenclature-<?php echo $identifier ?>'>
                                Nomenclature<br>
                                <input id='sub-nomenclature-<?php echo $identifier ?>' class='input textbox info' type='text' value='<?php echo $subscription['nomenclature']; ?>' name='sub-nomenclature-<?php echo $identifier ?>'>
                            </label>
                        </p>
                        <p class='input section'>
                            <label for='sub-expires-<?php echo $identifier ?>'>
                                <input id='sub-expires-<?php echo $identifier ?>' class='input checkbox' type='checkbox' name='sub-expires-<?php echo $identifier ?>' <?php echo ( $subscription['expires'] === true?'checked':null ); ?>>
                                &nbsp;Expires
                            </label>
                            &nbsp;
                            <label for='sub-public-<?php echo $identifier ?>'>
                                <input id='sub-public-<?php echo $identifier ?>' class='input checkbox' type='checkbox' name='sub-public-<?php echo $identifier ?>' <?php echo ( $subscription['public'] === true?'checked':null ); ?>>
                                &nbsp;Public
                            </label>
                        </p>
                        <!-- left here, update js and action to update sub data for expires and public -->
                        <p class='input section'>
                            <input id='update-sub' sub='<?php echo $identifier; ?>' class='input button valid small' type='button' value='Update'>
                        </p>
                        <p class='input section'>
                            <label for='sub-identifier-<?php echo $identifier ?>'>
                                Identifier<br>
                                <input id='sub-identifier-<?php echo $identifier ?>' class='input textbox valid' type='text' value='<?php echo $identifier; ?>' name='sub-identifier-<?php echo $identifier ?>' readonly>
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='renew-sub' sub='<?php echo $identifier; ?>' class='input button info small' type='button' value='Renew'>
                            <input id='delete-sub' sub='<?php echo $identifier; ?>' class='input button alert small' type='button' value='Delete'>
                        </p>
                    </div>
                    <div class='tools panel right'>
                        <h1 id='existing' class='tools icon'><i class='fa fa-cogs'></i></h1>
                    </div>
                </form>
                <?php endforeach; ?>
                <?php else: ?>
                <?php endif; ?>
                </div>
                <!-- Marker: Subscriptions End -->
            </div>
        </div>
    </div>
</div>
<?php Doc::load_uncached_script('guard.neetgroup.net/source/js/ui/menu.js'); ?>
<?php Doc::load_uncached_script('guard.neetgroup.net/source/js/developer-tools.js'); ?>
<?php endif; ?>
<!-- Marker: Developer Tools End -->