$('.input.button#create-app').click(function() {
	$('.input.button#create-app').state(false);
	$params = {
        act: 'app-create',
        key: window.prompt( "Enter Your Developer Key Below" ),
        title: $('.input.textbox#new-app-title').val()
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
                $('.input.button#create-app').state(true);
            }
        }
    });
});
$('.input.button#update-app').click(function() {
    $(this).state(false);
    $app = $(this).attr('app');
    if( $('.input.textbox#app-identifier-' + $app).length <= 0 )
    {
        window.alert('Cannot Find Application Parameters');
        return;
    }
    $title = $('.input.textbox#app-title-' + $app).val();
    $params = {
        act: 'app-update',
        key: window.prompt( "Enter Your Developer Key Below" ),
        app: $app,
        title: $title
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
            setTimeout(function() {
		        window.location.reload();
		    }, 2500);
        }
    });
});
$('.input.button#renew-app').click(function() {
    $(this).state(false);
    $app = $(this).attr('app');
    if( $('.input.textbox#app-identifier-' + $app).length <= 0 )
    {
        window.alert('Cannot Find Application Parameters');
        return;
    }
    $params = {
        act: 'app-renew',
        key: window.prompt( "Enter Your Developer Key Below" ),
        app: $app
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
            setTimeout(function() {
		        window.location.reload();
		    }, 2500);
        }
    });
    $(this).state(true);
});
$('.input.button#delete-app').click(function() {
    $(this).state(false);
    $app = $(this).attr('app');
    if( $('.input.textbox#app-identifier-' + $app).length <= 0 )
    {
        window.alert('Cannot Find Application Parameters');
        return;
    }
    $params = {
        act: 'app-delete',
        key: window.prompt( "Enter Your Developer Key Below" ),
        app: $app
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
            setTimeout(function() {
		        window.location.reload();
		    }, 2500);
        }
    });
});
$('.input.button#create-sub').click(function() {
    $('.input.button#create-sub').state(false);
    $nomenclature = $('.input.textbox#new-sub-nomenclature').val();
    $params = {
        act: 'sub-create',
        key: window.prompt( "Enter Your Developer Key Below" ),
        nomenclature: $nomenclature
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
                $('.input.button#create-sub').state(true);
            }
        }
    });
});
$('.input.button#update-sub').click(function() {
    $(this).state(false);
	$sub = $(this).attr('sub');
	if( $('.input.textbox#sub-identifier-' + $sub).length <= 0 )
    {
        window.alert('Cannot Find Application Parameters');
        return;
    }
	$nomenclature = $('.input.textbox#sub-nomenclature-' + $sub).val();
	$public = $('.input.checkbox#sub-public-' + $sub).prop( 'checked' );
	$expires = $('.input.checkbox#sub-expires-' + $sub).prop( 'checked' );
	$params = {
        act: 'sub-update',
        key: window.prompt( "Enter Your Developer Key Below" ),
        sub: $sub,
        nomenclature: $nomenclature,
        pub: $public,
        expires: $expires
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
            setTimeout(function(){
                window.location.assign( 'https://guard.neetgroup.net/developer-tools.doc' );
            }, 2500);
        }
    });
});
$('.input.button#renew-sub').click(function() {
	$(this).state(false);
	$sub = $(this).attr('sub');
	if( $('.input.textbox#sub-identifier-' + $sub).length <= 0 )
    {
        window.alert('Cannot Find Application Parameters');
        return;
    }
	$params = {
        act: 'sub-renew',
        key: window.prompt( "Enter Your Developer Key Below" ),
        sub: $sub
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
            setTimeout(function(){
                window.location.assign( 'https://guard.neetgroup.net/developer-tools.doc' );
            }, 2500);
        }
    });
});
$('.input.button#delete-sub').click(function() {
	$(this).state(false);
	$sub = $(this).attr('sub');
	$params = {
        act: 'sub-delete',
        key: window.prompt( "Enter Your Developer Key Below" ),
        sub: $sub
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/developer-tools.php",
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
            setTimeout(function() {
		        window.location.assign( 'https://guard.neetgroup.net/developer-tools.doc' );
		    }, 2500);
        }
    });
});
