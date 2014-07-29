<?php

return array(
    'debug' => true,
    'secret_key' => 'af0c554a-16f8-11e4-b32d-e780e0c04c68',

    'base_urls' => '',
    'urls' => include 'urls.php',

    // Mongrel2
    'server_conf' => array(
        'pub_addrs' => array('tcp://127.0.0.1:9014'),
        'pull_addrs' => array('tcp://127.0.0.1:9015'),
    ),

    //  Log
    'log_handlers' => array(
        '\photon\log\ConsoleBackend',
    ),
    
    // Template
    'template_folders' => array(
        'template',
    ),
);
