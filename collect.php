<?php
/**
 * Reads temperature sensor file, extracts temperature value and stores in file
 */

//Directory for reading temperature:
// /sys/bus/w1/devices/28-0000039f74f6

// file name:
// w1_slave

// Sensor serial
// 0000039f74f6

$sensorId = '39f74f6';
$fullFilePath = '/sys/bus/w1/devices/28-00000'.$sensorId.'/w1_slave';

//$fullFilePath = 'dummy_reading';
$resultFile = 'data';
$sleep = 10;

function readTempRaw($file) {
    return implode(' ', file($file));
}

function readTemp($file) {
    $rawResult = readTempRaw($file);
    $result = explode(' ',$rawResult);
    return end($result);
}

function writeResult($resultFile, $result) {
    $resultFile = fopen($resultFile, "a") or die("Unable to open file!");
    fwrite($resultFile, $result);
    fclose($resultFile);
}

while(true) {
    $cleanTemp = readTemp($fullFilePath);
    $tempValue = substr($cleanTemp, 2);
    $temp = $tempValue / 1000.00;
    $time = date('d-m-Y H:i');

    $data = array(
        'id' => $sensorId,
        'time' => $time,
        'value' => $temp
    );

    writeResult($resultFile, json_encode($data) . "\n");
    sleep($sleep);
}