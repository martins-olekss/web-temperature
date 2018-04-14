<?php
/**
 * Returns last recorded temperature
 */

$filePath='data';
echo trim(implode("", array_slice(file($filePath), -1)));