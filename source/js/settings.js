$('.input.button#update-alias').click(function(){
    $('.input.button#update-alias').state(false);
    $params =
    {
        act: 'update-alias',
        alias: $('.input.textbox#alias').val(),
        password: $('.input.textbox#current-password').val(),
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
            }
            else {
                window.alert($result.error);
            }
            $('.input.textbox#current-password').val(null);
            $('.input.button#update-alias').state(true);
        }
    });
});

$('.input.button#update-password').click(function(){
    $('.input.button#update-password').state(false);
    $params =
    {
        act: 'update-password',
        current: $('.input.textbox#current-password').val(),
        update: $('.input.textbox#new-password').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
            }
            else {
                window.alert($result.error);
            }
            $('.input.textbox#current-password').val(null);
            $('.input.textbox#new-password').val(null);
            $('.input.button#update-password').state(true);
        }
    });
});

$('.input.button#update-key-1').click(function(){
    $('.input.button#update-key-1').state(false);
    $params =
    {
        act: 'update-key-1',
        update: $('.input.textbox#gizmo-key-1').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
                $('.input.button#update-key-1').state(true);
            }
        }
    });
});

$('.input.button#update-key-2').click(function(){
    $('.input.button#update-key-2').state(false);
    $params =
    {
        act: 'update-key-2',
        update: $('.input.textbox#gizmo-key-2').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
                $('.input.button#update-key-2').state(true);
            }
        }
    });
});

$('.input.button#update-forum-handle').click(function(){
    $('.input.button#update-forum-handle').state(false);
    $params =
    {
        act: 'update-forum-handle',
        username: $('.input.textbox#forum-username').val(),
        password: $('.input.textbox#forum-password').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if($result.result){
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
                $('.input.button#update-forum-handle').state(true);
            }
        }
    });
});

$('.input.button#wash-forum-handle').click(function(){
    $('.input.button#wash-forum-handle').state(false);
    $params =
    {
        act: 'wash-forum-handle'
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            window.alert($result.result);
            setTimeout(function() {
                window.location.reload();
            }, 2500);
        }
    });
});

$('.input.button#subscribe').click(function(){
    $('.input.button#subscribe').state(false);
    $params =
    {
        act: 'subscribe',
        tag: $('.input.textbox#tag').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
                $('.input.button#subscribe').state(true);
            }
        }
    });
});

$('.input.button#enable-email-use').click(function(){
    $('.input.button#enable-email-use').state(false);
    $params =
    {
        act: 'enable-email-use'
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
                $('.input.button#enable-email-use').state(true);
            }
        }
    });
});

$('.input.button#disable-email-use').click(function(){
    $('.input.button#disable-email-use').state(false);
    $params =
    {
        act: 'disable-email-use'
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
                $('.input.button#disable-email-use').state(true);
            }
        }
    });
});

$('.input.button#view-cred-secret').click(function(){
    $('.input.button#view-cred-secret').state(false);
    $params =
    {
        act: 'validate-forum-handle'
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if($result.result)
            {
                $params =
                {
                    act: 'get-cred-secret',
                    password: $('.input.textbox#foro-password').val()
                }; // reset params var for request
                $.ajax({
                    url: "//guard.neetgroup.net/actions/ucp.php",
                    type: "POST",
                    data: $params,
                    success: function(data, textStatus, jqXHR) {
                        $result = jQuery.parseJSON(data);
                        if($result.result)
                        {
                            $('p#foro-authentication').hide();
                            $('.input.button#view-cred-secret').hide();
                            $('.input.textbox#cred-secret').val($result.result);
                            $('p.input.section#cred-secret').show();
                        }
                        else
                        {
                            window.alert( $result.error );
                            $('.input.button#view-cred-secret').state(true);
                        }
                    }
                });
            }
            else
            {
                $('.input.button#view-cred-secret').state(true);
                window.alert( "Please Link Your Forum Profile Before Continuing" );
            }
        }
    });
});

$('.input.button#update-phrase').click(function(){
    $('.input.button#update-phrase').state(false);
    $params =
    {
        act: 'phrase'
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/ucp.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            window.alert($result.result);
            setTimeout(function() {
                window.location.reload();
            }, 2500);
        }
    });
});