$(".notification.message#register").click(function(){
    $params =
    {
        act: 'register'
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developers.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if($result.result) {
                window.alert($result.result);
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
            else {
                window.alert($result.error);
            }
        }
    });
});

$(".notification.message#query").click(function(){
    var form = document.getElementById('authentication');
    var style = window.getComputedStyle( form );
    if( style.display !== 'none' )
    {
        $('form#authentication').hide();
    }
    else
    {
        $('form#authentication').show();
    }
});

$('.input.button#query').click(function(){
    $('.input.button#query').state(false);
    $params =
    {
        act: 'query',
        password: $('.input.textbox#password').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developers.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR) {
            $result = jQuery.parseJSON(data);
            if($result.result) {
                $('form#authentication').hide();
                $('.message#query').hide();
                $('.message#result').show();
                $('.message#result').append('`' + $result.result + '`');
                window.prompt('Copy to Clipboard: Ctrl+C, Enter', $result.result);
            }
            else {
                window.alert($result.error);
                $('.input.button#query').state(true);
            }
        }
    });
});

$('.input.button#tools').click(function(){
    window.location = 'https://guard.neetgroup.net/developer-tools.doc';
});