$pages = ['home', 'login', 'register', 'profile', 'activity', 'settings', 'developers', 'developer-tools', 'logout'];
for ($i = 0; $i < $pages.length; $i++) {
    if (str_contains('guard.neetgroup.net/index.php?page=' + $pages[$i], window.location)) {
        $('.header.navigation.tab.link#' + $pages[$i]).active( true );
        break;
    } else if (str_contains('guard.neetgroup.net/' + $pages[$i] + '.doc', window.location)) {
        $('.header.navigation.tab.link#' + $pages[$i]).active( true );
        break;
    }
}