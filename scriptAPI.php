<?php

function get($resource, array $params = array()){
    $apiUrl = 'http://cci.votre-webmaster-freelance.fr/wp-json';

    $json = file_get_contents($apiUrl . $resource . '?' . http_build_query($params));

    $result = json_decode($json);

    return $result;
}

$pages = get('/wp/v2/pages', array(
    'orderby' => 'id',
    'order' => 'asc',
    //'search' => '',
));

foreach ($pages as $page) {
    echo 'Page ' . $page->id . ' : ' . $page->slug . '<br>';
    echo substr($page->excerpt->rendered, 0, 100) . '...';
    echo '<hr>';
}
