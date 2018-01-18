<?php
    
    global $user;
    
    global $web;
    // $web->utility->debug->__invoke();

?>
<!-- Marker: UCP Begin -->
<div id="settings" class="page panel wrapper">
    <div class="interface menu wrapper">
        <div class="interface menu left">
            <h1 class="interface menu header">Your Account</h1>
            <ul class="interface menu list">
                <li id="profile" class="interface menu item">Profile</li>
                <li id="gizmo" class="interface menu item">Gizmo</li>
                <li id="forum" class="interface menu item">Forum</li>
                <li id="subscriptions" class="interface menu item">Subscriptions</li>
                <li id="credentials" class="interface menu item">Credentials</li>
            </ul>
        </div>
        <div class="interface menu right">
            <div class="interface menu content">
                <div id="profile" class="interface menu input">
                    <form class='menu panel form' name='profile'>
                        <p class='input section'>
                            <label class='input label' for='name'>
                                Alias<br>
                                <input id='alias' class='input textbox info' type='text' name='alias' value='<?php echo $user->data->guard['alias']; ?>' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-alias' class='input button valid small' type='button' value='Update' />
                        </p>
                        <p class='input section'>
                            <label class='input label' for='new-password'>
                                New Password<br>
                                <input id='new-password' class='input textbox info' type='password' name='new-password' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-password' class='input button valid small' type='button' value='Update' />
                        </p>
                        <p class='input section'>
                            <label class='input label' for='current-password'>
                                Password<br>
                                <input id='current-password' class='input textbox valid' type='password' name='current-password' />
                            </label>
                        </p>
                    </form>
                </div>
                <div id="gizmo" class="interface menu input">
                    <form class='menu panel form' name='gizmo'>
                        <?php if( !$user->data->guard['key_1'] ): ?>
                        <p class='input section'>
                            <label class='input label' for='gizmo-key-1'>
                                Gizmo Key (1)<br>
                                <input id='gizmo-key-1' class='input textbox info' type='text' name='gizmo-key-1' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-key-1' class='input button valid small' type='button' value='Update' />
                        </p>
                        <?php else: ?>
                            <?php if( $user->data->guard['key_1_time'] < time() ): ?>
                        <p class='input section'>
                            <label class='input label' for='gizmo-key-1'>
                                Gizmo Key (1)<br>
                                <input id='gizmo-key-1' class='input textbox info' type='text' value='<?php echo $user->data->guard['key_1']; ?>' name='gizmo-key-1' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-key-1' class='input button valid small' type='button' value='Update' />
                        </p>
                            <?php else: ?>
                        <p class='input section'>
                            <label class='input label' for='gizmo-key-1'>
                                Gizmo Key (1)<br>
                                <input id='gizmo-key-1' class='input textbox alert' type='text' value='<?php echo $user->data->guard['key_1']; ?>' name='gizmo-key-1' readonly />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-key-1' class='input button valid small disabled' type='button' value='Update' disabled=true />
                        </p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if( !$user->data->guard['key_2'] ): ?>
                        <p class='input section'>
                            <label class='input label' for='gizmo-key-2'>
                                Gizmo Key (2)<br>
                                <input id='gizmo-key-2' class='input textbox info' type='text' name='gizmo-key-2' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-key-2' class='input button valid small' type='button' value='Update' />
                        </p>
                        <?php else: ?>
                            <?php if( $user->data->guard['key_2_time'] < time() ): ?>
                        <p class='input section'>
                            <label class='input label' for='gizmo-key-2'>
                                Gizmo Key (2)<br>
                                <input id='gizmo-key-2' class='input textbox info' type='text' value='<?php echo $user->data->guard['key_2']; ?>' name='gizmo-key-2' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-key-2' class='input button valid small' type='button' value='Update' />
                        </p>
                            <?php else: ?>
                        <p class='input section'>
                            <label class='input label' for='gizmo-key-2'>
                                Gizmo Key (2)<br>
                                <input id='gizmo-key-2' class='input textbox alert' type='text' value='<?php echo $user->data->guard['key_2']; ?>' name='gizmo-key-2' readonly />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-key-2' class='input button valid small disabled' type='button' value='Update' disabled=true />
                        </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>
                <div id="forum" class="interface menu input">
                    <form class="menu panel form" name="forum">
                        <p class='input section'>
                            <label class='input label' for='forum-username'>
                                Username<br>
                                <?php if($user->data->foro): ?>
                                <input id='forum-username' class='input textbox info' type='text' value='<?php echo $user->data->foro['username']; ?>' name='forum-username' />
                                <?php else: ?>
                                <input id='forum-username' class='input textbox info' type='text' name='forum-username' />
                                <?php endif; ?>
                            </label>
                        </p>
                        <p class='input section'>
                            <label class='input label' for='forum-password'>
                                Password<br>
                                <input id='forum-password' class='input textbox valid' type='password' name='forum-password' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-forum-handle' class='input button valid small' type='submit' value='Link' onclick="return false;" />
                            <input id='wash-forum-handle' class='input button alert small' type='button' value='Wash' />
                        </p>
                    </form>
                </div>
                <div id="subscriptions" class="interface menu input">
                    <form class='menu panel form' name='subscriptions'>
                        <p class='input section'>
                            <label class='input label' for='tag'>
                                Tag<br>
                                <input id='tag' class='input textbox valid' type='text' name='tag' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='subscribe' class='input button valid small' type='submit' value='Subscribe' onclick="return false;" />
                        </p>
<pre>
    <code class="language-javascript">
    <?php
    
        if( $user->data->subscriptions ):
            $data;
            $index = 0;
            foreach( $user->data->subscriptions as $identifier=>$properties ):
                /*
                    
                    $properties =
                    {
                        access : true || false,
                        expires : timestamp in seconds
                    }
                
                 */
                 $index++;
                 $mesh = str_split( $identifier );
                 $secure_id;
                 foreach( $mesh as $key=>$value ):
                     if( $key == 0 ):
                         $secure_id .= $value . '#';
                         continue;
                     elseif( $key >= 10 ):
                         $secure_id .= $value;
                     endif;
                 endforeach;
                 $props = array
                 (
                    'access' => $properties->access === true?'true':'false'
                 );
                 if( $properties->expires_on ):
                     $props['expires'] = date( "F j, Y, g:i a", $properties->expires_on );
                 endif;
                 $props = 'array' . str_replace( '{', '(', str_replace( '}', ')', json_encode( $props ) ) );
                 $data .=
        "        $secure_id :
        {
            $props
        }";
                 $secure_id = null;
                 if( $index < sizeof( $user->data->subscriptions ) ):
                     $data .= 
                     ',
';
                 endif;
                 
            endforeach;
        else:
            $data = 'null';
        endif;
        
        $structure =
    "var data =
    {
$data
    };";
        
        echo $structure;
    
    ?>
    
    </code>
</pre>
                        <?php if( $user->data->guard['use_email'] ): ?>
                        <p class='input section'>
                            <input id='disable-email-use' class='input button alert small' type='button' value='Disable Email Use' />
                        </p>
                        <?php else: ?>
                        <p class='input section'>
                            <input id='enable-email-use' class='input button valid small' type='button' value='Enable Email Use' />
                        </p>
                        <?php endif; ?>
                    </form>
                </div>
                <div id="credentials" class="interface menu input">
                    <form class='menu panel form' name='credentials'>
                        <p id='cred-secret' class='input section' style='display:none;'>
                            <label class='input label' for='cred-secret'>
                                Credit Secret<br>
                                <input id='cred-secret' class='input textbox alert' type='text' value='#' name='cred-secret' readonly />
                            </label>
                        </p>
                        <p id='foro-authentication' class='input section'>
                            <label class='input label' for='foro-password'>
                                Password(Forum)<br>
                                <input id='foro-password' class='input textbox valid' type='password' name='foro-password' />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='view-cred-secret' class='input button info small' type='submit' value='Credit Secret' onclick="return false;" />
                        </p>
                        <p class='input section'>
                            <label class='input label' for='phrase'>
                                Auth Phrase<br>
                                <input id='phrase' class='input textbox alert' type='text' value='<?php echo $user->data->guard['auth_phrase']; ?>' name='phrase' readonly />
                            </label>
                        </p>
                        <p class='input section'>
                            <input id='update-phrase' class='input button valid small' type='button' value='Renew Phrase' />
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/ui/menu.js'); ?>
    <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/settings.js'); ?>
</div>
<!-- Marker: UCP End -->