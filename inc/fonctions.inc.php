<?php 

function debug($param){
    echo '<pre>';
        var_dump($param);
    echo '</pre>';
}

function detail($argPost, $argQuery){
    $detail = array();
    $detail['nb_semaines'] = $argPost['nb_semaines'];
    $detail['nb_vacanciers']  = $argPost["nb_vacanciers"];
    $detail['email'] = $argPost['email'];
    $detail['prix'] = $argQuery;
    $detail['total'] = ($detail['prix'] * $detail['nb_vacanciers']) * $detail['nb_semaines'];

    return $detail;
}