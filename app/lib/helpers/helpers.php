<?php

function dnd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();//kills the page
}

function sanitize($dirty){
    return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}