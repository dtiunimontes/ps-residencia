<?php

// PEGA UMA DATA EM FORMATO BRASILEIRO E TRANSFORMA EM FORMATO AMERICANO
if(!function_exists('formatarDataUSA')){

    function formatarDataUSA($data_brasileira){

        $date = DateTime::createFromFormat('d/m/Y H:i:s', $data_brasileira);

        return $date->format('Y-m-d H:i:s');
    }
}

// PEGA UMA DATA NO FORMATO AMERICANO E COLOCA O MÊS POR EXTENSO
if(!function_exists('formatarDataHoraExtensoUSA')){

    function formatarDataHoraExtensoUSA($data_americana){

        return date('Y-m-d H:i', strtotime(date('d F Y H:i', strtotime($data_americana))));
    }
}

// PEGA UMA DATA AMERICANA E COLOCA NO FORMATO BRASILEIRO
if(!function_exists('formatarDataUSAParaBR')){

    function formatarDataUSAParaBR($data_americana){

        return date('d/m/Y à\\s H:i', strtotime($data_americana));
    }
}

// PEGA UMA DATA AMERICANA E COLOCA NO FORMATO BRASILEIRO
if(!function_exists('formatarDataUSAParaBRData')){

    function formatarDataUSAParaBRData($data_americana){

        return date('d/m/Y', strtotime($data_americana));
    }
}
