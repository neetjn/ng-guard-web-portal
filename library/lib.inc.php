<?php
    
    define(DBG_ENABLED, false);
    define(DBG_KEY, 'SGKr4acd');
    
    set_include_path( str_replace( '/library', null, dirname(__FILE__) ) ); // set root path as include
    require_once( get_include_path() . '/connect.php' ); // open database connection for lib and main

    session_start(); // open+begin session for lib and main

    require_once ( get_include_path() . '/library/tools/communicator.php' );
    require_once ( get_include_path() . '/library/tools/encoding.php' );
    require_once ( get_include_path() . '/library/tools/utility.php' );
    require_once ( get_include_path() . '/library/tools/sql.php' );

    require_once ( get_include_path() . '/library/struct/stats.php' );
    require_once ( get_include_path() . '/library/struct/tag.php' );
    require_once( get_include_path() . '/library/struct/user.php' );
    require_once( get_include_path() . '/library/struct/developer.php' );
    
    require_once( get_include_path() . '/library/applications/user.php' );
    require_once ( get_include_path() . '/library/applications/web2.php' );
    require_once ( get_include_path() . '/library/applications/blog.php' );

?>