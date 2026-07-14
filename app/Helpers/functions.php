<?php

use Carbon\Carbon;

function formatDateAndTime($value, $format = 'd/m/Y - H:i')
{

    return Carbon::parse($value)->translatedFormat($format);
}

function formatDate($value, $format = 'd/m/Y')
{
    if($value) {
        $value=date_create($value);
        $date = date_format($value,"d/m/Y");
    } else {
        $date = '';
    }
    return $date;
}

function formatMonth($value, $format = 'm/Y')
{
    $explode = explode("-", $value);

    if(isset($explode[1])) {
        $value = date_create($value);
        $date = date_format($value,  'm/Y');
    } else {
        $date = $explode[0];
    }
    return $date;
}

function dateDiffInDays($date1, $date2)
{
    $diff = strtotime($date2) - strtotime($date1);
    return abs(round($diff / 86400));
}

function formatdiffForHumans($value, $format = 'd/m/Y')
{
    return Carbon::parse($value)->diffForHumans();
}

function formatDateDB ($value, $format = 'Y-m-d')
{
    return Carbon::parse($value)->format($format);
}


function formatMoney($value)
{
//    if($value >= 0) {
        return 'R$ '.number_format($value, 2, ',', '.');
//    }
}

function firstName($value)
{
    $name = explode(" ", $value);

    if(count($name) > 1){
        return $name[0] . " ". $name[1];
    } else {
        return $name[0];
    }
}

function formatMoneyInput($value)
{
    return number_format($value, 2, ',', '.');
}
function formatDecimal($value)
{
    return strtr($value, ['.' => '',  ',' => '.', ]);
}

function formatNumber($value)
{
    return round($value, 0);
}

function formatPercentage($value)
{
    return strtr($value, ['.' => ',']). ' %';
}

function formatCoin($value)
{
    $coin = explode('.', $value);
    return $coin[0];
}

function formatCPFCNPJ($value) {

    $value = preg_replace("/[^0-9]/", "", $value);
    $qtd = strlen($value);

    if($qtd >= 11) {
        if($qtd === 11 ) {
            $docFormatado = substr($value, 0, 3) . '.' .
                substr($value, 3, 3) . '.' .
                substr($value, 6, 3) . '-' .
                substr($value, 9, 2);
        } else {
            $docFormatado = substr($value, 0, 2) . '.' .
                substr($value, 2, 3) . '.' .
                substr($value, 5, 3) . '/' .
                substr($value, 8, 4) . '-' .
                substr($value, -2);
        }

        return $docFormatado;

    } else {
        return 'Documento invalido';
    }
}
function formatNameFile($value) {

    $value = preg_replace("/[^0-9]/", "", $value);


        $fileFormatado = substr($value, 0, 1) . '-' .
            substr($value, 1, 14) . '-' .
            substr($value, 15, 4) . '-' .
            substr($value, 19, 2). '-' .
            substr($value, 21, 2). '-' .
            substr($value, 23, 2). '-' .
            substr($value, 25, 2). '-' .
            substr($value, 27, 2). '-' .
            substr($value, 29, 5). '-' .
            substr($value, 34, 4). '' ;


        return $fileFormatado;

}

function dataCPFCNPJ($value) {
    return preg_replace('/[^0-9]/', '', $value);
}


function formatPhone($value) {

    $value = preg_replace('/[^0-9]/','',$value);


    if(strlen($value) > 11) {
        $countryCode = substr($value, 0, strlen($value)-10);
        $areaCode = substr($value, -10, 3);
        $nextThree = substr($value, -7, 3);
        $lastFour = substr($value, -4, 4);

        $value = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($value) == 11) {
        $areaCode = substr($value, 0, 2);
        $nextThree = substr($value, 2, 5);
        $lastFour = substr($value, 6, 4);

        $value = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($value) == 7) {
        $nextThree = substr($value, 0, 2);
        $lastFour = substr($value, 2, 4);

        $value = $nextThree.'-'.$lastFour;
    }

    return $value;

}

function formatZipCode($value) {

    $value = preg_replace('/[^0-9]/','',$value);

    $first = substr($value, 0, 5);
    $digits = substr($value, 5, 3);

    $value = $first.'-'.$digits;


    return $value;

}

function roundDecimal($value)
{
    $terceiraCasa = (int) substr(strval($value * 1000), -1);

    if ($terceiraCasa >= 5) {
        $resultado = ceil($value * 100) / 100;
    } else {
        $resultado = floor($value * 100) / 100;
    }

    return $resultado;
}

function firstAndLastName(?string $fullName): string
{
    $fullName = trim($fullName ?? '');

    if ($fullName === '') {
        return '';
    }

    $parts = preg_split('/\s+/', $fullName);

    if (count($parts) === 1) {
        return $parts[0];
    }

    return $parts[0] . ' ' . $parts[1];
}
