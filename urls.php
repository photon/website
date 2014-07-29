<?php

$urls = array();

// Media query: css, js, img
$urls[] = array('regex' => '#^/media/(.*)$#',
                'view' => array('\photon\views\AssetDir', 'serve'),
                'name' => 'photonweb_assets',
                'params' => 'media/');

// Simple template, rendered by photon build-in view
$simpleTemplate = array(
    '/' => 'home',
    '/doc' => 'doc',
    '/about' => 'about',
    '/download' => 'download',
    '/community' => 'community',
);
foreach($simpleTemplate as $path => $template) {
    $urls[] = array('regex' => '#^'. $path . '$#',
                    'view' => array('\photon\views\Template', 'simple'),
                    'params' => $template . '.html',
                    'name' => 'photonweb_' . $template);
}

// Markdown help page
$urls[] = array('regex' => '#^/doc/(.*)$#',
                'view' => array('\Markdown\Views', 'autodoc'),
                'name' => 'photonweb_autodoc');

// ↑↑↓↓←→←→BA
$urls[] = array('regex' => '#^/hello$#',
                'view' => function ($req, $match) {
                    return new \photon\http\Response('Hello World!', 'text/plain');
                },
                'name' => 'photonweb_hello');     
                
return $urls;

