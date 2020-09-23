<?php

function formatDateAndTime($value, $format = 'd/m/Y'){
    return \Carbon\Carbon::parse($value)->format($format);
}

function formataDiaSemanaTreino(string $value){

    if ($value == 'SE'){
        $value = 'SEGUNDA';
    } else if ($value == 'TE'){
        $value = 'TERCA';
    }else if ($value == 'QA'){
        $value = 'QUARTA';
    }else if ($value == 'QI'){
        $value = 'QUINTA';
    }else if ($value == 'SX'){
        $value = 'SEXTA';
    }else if ($value == 'SA'){
        $value = 'SABADO';
    }
    return $value;
}


function formataFoneFixo($value){
   $fone = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1)$2-$3', $value);
   return $fone;
}