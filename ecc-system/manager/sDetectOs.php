<?php
$os_type = PHP_OS;
$os_type = mb_convert_case($os_type, MB_CASE_LOWER);

$file_envment_ini = fopen("././ecc-system/infos/ecc_local_envment_info.ini", "a") or die("Can't open file");

fwrite($file_envment_ini, "os_type=" . $os_type . "\n"); 

fclose($file_envment_ini);
?>

