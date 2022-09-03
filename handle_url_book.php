<?php

require_once 'functions.php';

if ($_POST['url_book']) {

    $url_book = $_POST['url_book'];

    if (filter_var($url_book, FILTER_VALIDATE_URL)) {

        $filter_url = parse_url($url_book);

        if ( $filter_url['host'] == 'fanqienovel.com') {
            
            run_get_book($url_book);

            header("Location: /crawl-content/");

        }

    }
}