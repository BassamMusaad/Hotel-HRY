<?php

// detect any script adding with the input
function filtering_string($string) {
    // delete any script within string
    $filter_data=filter_var($string,FILTER_SANITIZE_STRING);
    return empty($filter_data) ? false : $filter_data;
}

// check if the phone in valid format
function filtering_phone($phone){
    // delete anything does not a number
    $phone=preg_replace('/[^0-9]/', '', $phone);
    // check if the number contain 9 digit
    if(strlen($phone)!=9){
        return false;
    }
    return $phone;
}

// check if the date is a valid date
// notes: the input format is Y-m-d, for chrome user.
function filtering_date($date){
    // current date
    $current_date=date('Y-m-d');
    if($current_date <= $date){
        return $date;
    }
    return false;
}

