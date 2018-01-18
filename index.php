<?php
    
    require_once ( './library/lib.inc.php' );

    $web = new \Library\Application\Web();
    
    if ( $web->utility->filtered->__invoke() ):
        header( 'Location: http://you-are-banned.com' ); // redirect filtered users
    endif;
    
    $_SESSION['LOCAL_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP']; // using cloudflare to find visitor ip
    
    $page = $web->cmd->page->__invoke( $_GET['page'] );
    $statistics = new \Library\Struct\Statistics();

    $username = $_SESSION['GUARD_SESHU'];
    if ( $username ):
        $user = new \Library\Struct\User($username);
        if ( !$page->name ):
            header('Location: https://guard.neetgroup.net/home.doc'); // redirect to home if page not found
            exit;
        endif;
        if ( $page->name == 'login' || $page->name == 'register' ):
            header( 'Location: https://guard.neetgroup.net/home.doc' ); // redirect to home if already logged in
            exit;
        endif;
        if ( $page->name == 'developer-tools' ):
            if( !$user->data->guard['developer'] ):
                header( 'Location: https://guard.neetgroup.net/developers.doc' ); // redirect if user not developer
            endif;
        endif;
        if ( !$web->utility->online->__invoke() ):
            if ( $user->data->guard['disabled'] || $user->data->guard['banned'] ):
                session_destroy();
                header( 'Location: https://guard.neetgroup.net/login.doc' ); // redirect to login after logout if user banned
                exit;
            endif;
            if ( $page->name !== 'offline' && $page->name !== 'logout' ):
                if ( !$user->data->guard['admin'] ):
                    header( 'Location: https://guard.neetgroup.net/offline.doc' ); // redirect if offline and not admin
                    exit;
                endif;
            endif;
        else:
            if( $page->name == 'offline' ):
                header( 'Location: https://guard.neetgroup.net/home.doc' ); // redirect to home if online
                exit;
            endif;
        endif;
        if ( $web->utility->maintenance->__invoke() ):
            if ( $user->data->guard['disabled'] || $user->data->guard['banned'] ):
                session_destroy();
                header( 'Location: https://guard.neetgroup.net/login.doc' ); // redirect to login after logout if user banned
                exit;
            endif;
            if ( $page->name !== 'maintenance' && $page->name !== 'logout' ):
                if ( !$user->data->guard['admin'] ):
                    header( 'Location: https://guard.neetgroup.net/maintenance.doc' ); // redirect if maintenance and not admin
                    exit;
                endif;
            endif;
        else:
            if( $page->name == 'maintenance' ):
                header( 'Location: https://guard.neetgroup.net/home.doc' ); // redirect to home if online
                exit;
            endif;
        endif;
        if ( $user->data->guard['banned'] ):
            session_destroy();
            header( 'Location: https://guard.neetgroup.net/login.doc' ); // redirect to login after logout if user banned
            exit;
        endif;
    else:
        if ( $page->name !== 'login' && $page->name !== 'register' ):
            header( 'Location: https://guard.neetgroup.net/login.doc' ); // redirect to login if no session found
            exit;
        endif;
    endif;
    
    class Doc
    {
        static function load_uncached_style($src)
        {
            $time = time();
            echo "<link rel='stylesheet' href='//$src?t=$time' type='text/css'>";
        }
        
        static function load_uncached_script($src)
        {
            $time = time();
            echo "<script src='//$src?t=$time'></script>";
        }
    }
    
    $page->load->__invoke();
