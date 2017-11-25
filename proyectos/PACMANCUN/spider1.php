<?php
error_reporting( E_ERROR );

define( "CRAWL_LIMIT_PER_DOMAIN", 50 );

$domains = array();

$urls = array();

function crawl( $url )
{
    global $domains, $urls;
    $parse = parse_url( $url );
    $domains[ $parse['host'] ]++;
    $urls[] = $url;

    $content = file_get_contents( $url );
    if ( $content === FALSE ){
        echo "Error: No content";
        return;
}

    $content = stristr( $content, "body" );
    preg_match_all( '/http:\/\/[^ "\']+/', $content, $matches );

    // do something with content.
    echo $content;

    foreach( $matches[0] as $crawled_url ) {
        $parse = parse_url( $crawled_url );
        if ( count( $domains[ $parse['http://lahabichuela.com/menu2017/'] ] ) < CRAWL_LIMIT_PER_DOMAIN && !in_array( $crawled_url, $urls ) ) {
            sleep( 1 );
            crawl( $crawled_url );
        }
    }
}

crawl('http://lahabichuela.com/menu2017/');
?>
