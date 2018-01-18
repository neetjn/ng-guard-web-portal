$('.input.button#verify').click(function() {
    window.prompt("Copy key to clipboard: Ctrl+C, Enter", $key);
    $('.input.section.validation').show();
});

$('.input.button#register').click(function() {
    $(".input.button#register").state( false );
    if ($('.input.textbox#key').val() !== $key) {
        window.alert('Complete Validation Before Continuing');
        $(".input.button#register").state( true );
        return;
    }
    $username = $('.input.textbox#username').val();
    $password = $('.input.textbox#password').val();
    $params =
    {
        username: $username,
        password: $password
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/register.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR)
        {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                $.cookie('GUARD_SAVEU', $username);
                window.alert($result.result);
                $('.notification.wrapper#free').hide();
                $('.registration.panel.wrapper').hide();
                $('.dialog.panel.wrapper').show();
                setTimeout(function() {
                    window.location = "https://guard.neetgroup.net/index.php?page=login";
                }, 2500);
            } else {
                window.alert($result.error);
                $(".input.button#register").state( true );
                return;
            }
        }
    });
});