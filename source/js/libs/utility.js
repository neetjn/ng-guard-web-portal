function str_contains($needle, $haystack) {
    $haystack = $haystack.toString();
    $needle = $needle.toString();
    return $haystack.indexOf($needle) > -1;
}