<?php

    global $user;
    
    global $web;
    
?>
<!-- Marker: Profile Begin -->
<div id='profile' class="page panel wrapper">
    <div id='profile' class="page panel left">
        <div class="profile avatar block">
            <?php if( $user->data->foro ): ?>
            <a href="https://forum.neetgroup.net/members/<?php echo $user->data->foro['username']; ?>.<?php echo $user->data->guard['forum_id']; ?>/">
                <img class="profile avatar image" src="<?php echo $user->data->foro['avatar']; ?>"></img>
            </a>
            <?php else: ?>
            <img class="profile avatar image" src="https://forum.neetgroup.net/avatar.php"></img>
            <?php endif; ?>
        </div>
        <div class="profile info block">
            <dl>
                <dt>Username: </dt>
                    <dd><?php echo $user->data->guard['username']; ?></dd>
            </dl>
            <dl>
                <dt>Forum Handle: </dt>
                <?php if( $user->data->foro ): ?>
                    <dd><?php echo $user->data->guard['forum_id']; ?></dd>
                <?php else: ?>
                    <dd>?</dd>
                <?php endif; ?>
            </dl>
        </div>
    </div>
    <div id='profile' class="page panel right">
        <div class="profile interface tab wrapper">
            <ul class="interface tab list">
                <li id="Guard" class="interface tab">Guard</li>
                <li id="Forum" class="interface tab">Forum</li>
                <li id="Tags" class="interface tab">Tags</li>
            </ul>
            <div class="profile interface tab content">
                <div id="Guard" class="interface tab input">
                    <h1 class='profile content header'>Guard Profile</h1>
                    <div class="profile content block">
                        <dl>
                            <dt>Username:</dt>
                                <dd><?php echo $user->data->guard['username']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Last Login:</dt>
                                <dd><?php echo $user->data->guard['last_login']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Developer Status:</dt>
                            <?php if ($user->data->guard['developer']): ?>
                                <dd><i class='fa fa-check-square-o'></i></dd>
                            <?php else: ?>
                                <dd><i class='fa fa-square-o'></i></dd>
                            <?php endif; ?>
                        </dl>
                        <dl>
                            <dt>Admin Status:</dt>
                            <?php if ($user->data->guard['admin']): ?>
                                <dd><i class='fa fa-check-square-o'></i></dd>
                            <?php else: ?>
                                <dd><i class='fa fa-square-o'></i></dd>
                            <?php endif; ?>
                        </dl>
                        <?php if( $user->data->guard['key_1'] ): ?>
                        <dl>
                            <dt>Gizmo Key(1):</dt>
                                <dd class="profile bold label"><?php echo $user->data->guard['key_1']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Gizmo Key(1) Updated:</dt>
                                <dd><?php echo date( 'D j/n/Y', $user->data->guard['key_1_time'] ); ?></dd>
                        </dl>
                        <?php endif; ?>
                        <?php if( $user->data->guard['key_2'] ): ?>
                        <dl>
                            <dt>Gizmo Key(2):</dt>
                                <dd class="profile bold label"><?php echo $user->data->guard['key_2']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Gizmo Key(2) Updated:</dt>
                                <dd><?php echo date( 'D j/n/Y', $user->data->guard['key_2_time'] ); ?></dd>
                        </dl>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="Forum" class="interface tab input">
                    <?php if( $user->data->foro ): ?>
                    <h1 class='profile content header'>Forum Profile</h1>
                    <div class="profile content block">
                        <dl>
                            <dt>Username:</dt>
                                <dd><?php echo $user->data->foro['username']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Email:</dt>
                                <dd><?php echo $user->data->foro['email']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Registered:</dt>
                                <dd><?php echo date( 'D j/n/Y', $user->data->foro['register_date'] ); ?></dd>
                        </dl>
                        <dl>
                            <dt>Message Count(Posts):</dt>
                                <dd><?php echo $user->data->foro['message_count']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Conversations Unread:</dt>
                                <dd><?php echo $user->data->foro['conversations_unread']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Alerts Unread:</dt>
                                <dd><?php echo $user->data->foro['alerts_unread']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Warning Points:</dt>
                                <dd><?php echo $user->data->foro['warning_points']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Trophy Points:</dt>
                                <dd><?php echo $user->data->foro['trophy_points']; ?></dd>
                        </dl>
                        <dl>
                            <dt>Credits:</dt>
                                <dd><?php echo $user->data->foro['credits']; ?></dd>
                        </dl>
                    </div>
                    <?php else: ?>
                    <h1 class="error" id="profile-tab-message"><i class="fa  fa-exclamation-circle"></i>&nbsp&nbsp;Forum Link Not Established</h1>
                    <?php endif; ?>
                </div>
                <div id="Tags" class="interface tab input">
                    <?php if( sizeof( $user->tags ) > 0 ): ?>
                    <h1 class='profile content header'>Tag List(<?php echo sizeof( $user->tags ); ?>)</h1>
                    <div class="profile content block">
                        <table id="Tags" class="profile table">
                            <tr>
                                <th>Tag</td>
                                <th>Subscription</td>
                                <th>Span</td>
                            </tr>
                        <?php for( $i = 0; $i < sizeof( $user->tags ); $i++ ): ?>
                            <?php $tag = new \Library\Struct\Tag( $user->tags[$i]['tag'] ); ?>
                            <tr>
                                <td><?php echo $tag->data['tag']; ?></td>
                                <td><?php echo $tag->data['secure_id']; ?></td>
                                <td><?php echo $tag->data['span']; ?>&nbsp;Day(s)</td>
                            </tr>
                        <?php endfor; ?>
                        </table>
                    </div>
                    <?php else: ?>
                        <h1 class="error" id="profile-tab-message"><i class="fa  fa-exclamation-circle"></i>&nbsp&nbsp;User Does Not Own Any Tags</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/ui/tabs.js'); ?>
    </div>
</div>
<!-- Marker: Profile End -->