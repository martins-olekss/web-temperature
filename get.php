<?php
/**
 * Returns last recorded temperature
 * TODO: Expect possibility to return last recorder tenperature for specific sensor
 */

$filePath='data';
echo trim(implode("", array_slice(file($filePath), -1)));