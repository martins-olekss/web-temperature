<?php
/**
 * Example file
 */

//Directory for reading temperature:
// /sys/bus/w1/devices/28-0000039f74f6

// file name:
// w1_slave

// Sensor serial
// 0000039f74f6

$fullFilePath = '/sys/bus/w1/devices/28-0000039f74f6/w1_slave';

function readTempRaw($file) {
    return implode(' ', file($file));
}

function readTemp($file) {
    $rawResult = readTempRaw($file);
    $result = explode(' ',$rawResult);
    return end($result);
}

while(true) {
    $cleanTemp = readTemp($fullFilePath);
    $tempValue = substr($cleanTemp, 2);
    $temp = $tempValue / 1000.00;
    echo $temp . PHP_EOL;

    sleep(0.5);
}

// Sample content of the file
/*
48 01 4b 46 7f ff 08 10 ad : crc=ad YES
48 01 4b 46 7f ff 08 10 ad t=20500
*/