$('.blog.input.textarea#content').blur(function() {
    if ( $('.blog.input.textarea#content').val() ) {
        $('.blog.input.textarea#content').active(true);
    } else {
        $('.blog.input.textarea#content').active(false);
    }
});

$hide_comments = true;

$('.input.button#show-comments').click(function(){
    if( $hide_comments ) {
        $('.input.button#show-comments').val('Hide Comments');
        $('.blog.comment.panel').hide();
        $('.blog.header#source').hide();
        $('.blog.comment.wrapper#lower').show(); 
        $hide_comments = false;
    } else {
        $('.input.button#show-comments').val('Show Comments');
        $('.blog.comment.panel').show(); 
        $('.blog.header#source').show();
        $('.blog.comment.wrapper#lower').hide(); 
        $hide_comments = true;
    }
});

$('.input.button#post').click(function() {
    $('.input.button#post').state(false);
    $title = $('.blog.input.textbox#title').val();
    $post = $('.blog.input.textarea#content').val();
    if ($title.length >= 3 && $post.length >= 10) {
        $params =
        {
            act: 'post',
            title: $title,
            post: $post
        };
        $.ajax({
            url: "//guard.neetgroup.net/actions/blog.php",
            type: "POST",
            data: $params,
            success: function(data, textStatus, jqXHR)
            {
                $result = jQuery.parseJSON(data);
                if ($result.result) {
                    window.alert($result.result);
                    setTimeout(function() {
                        window.location.reload();
                    }, 2500);
                } else {
                    window.alert($result.error);
                    $('.input.button#post').state(true);
                    return;
                }
            }
        });
    } else {
        window.alert('Invalid Title or Post Input');
        $('.input.button#post').state(true);
        return;
    }
});

$('.input.button#comment').click(function() {
    if ($post_id) {
        $('.input.button#comment').state(false);
        $comment = $('.blog.input.textarea#content').val();
        if ($comment.length >= 10 && $comment.length <= 140) {
            $params =
            {
                act: 'comment',
                id: $post_id,
                comment: $comment
            };
            $.ajax({
                url: "//guard.neetgroup.net/actions/blog.php",
                type: "POST",
                data: $params,
                success: function(data, textStatus, jqXHR)
                {
                    $result = jQuery.parseJSON(data);
                    if ($result.result) {
                        window.alert($result.result);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    } else {
                        window.alert($result.error);
                        $('.input.button#comment').state(true);
                        return;
                    }
                }
            });
        } else {
            window.alert('Invalid Comment Input');
            $('.input.button#comment').state(true);
            return;
        }
    } else {
        window.alert('Post Not Found');
    }
});