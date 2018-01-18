<?php

    global $user;

?>
<!-- Marker: Activity Begin -->
<div class="page panel wrapper">
    
    <?php if( sizeof( $user->logs ) > 0 ): ?>
    <table>
        <tr>
            <th>Username</th>
            <th>iP Address</th>
            <th>Event</th>
            <th>Time</th>
        </tr>
    <?php if( sizeof( $user->logs ) > 15 ): ?>
        <?php foreach( array_splice( array_reverse( $user->logs ), 0, 15 ) as $log ): ?>
        <tr>
            <td><?php echo $user->data->guard['username']; ?></td>
            <td><?php echo $log['ip']; ?></td>
            <td><?php echo $log['event']; ?></td>
            <td><?php echo $log['time']; ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <?php foreach( array_reverse( $user->logs ) as $log ): ?>
        <tr>
            <td><?php echo $user->data->guard['username']; ?></td>
            <td><?php echo $log['ip']; ?></td>
            <td><?php echo $log['event']; ?></td>
            <td><?php echo $log['time']; ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </table>
    <?php else: ?>
    <h1 class="error" id="activity"><i class="fa  fa-exclamation-circle"></i>&nbsp&nbsp;No User Activity Logged</h1>
    <?php endif; ?>
</div>
<!-- Marker: Activity End -->