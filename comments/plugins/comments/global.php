<?php
$permissions_checks['ÇáÊÚáíÞÇÊ'] = "comments";

if(!class_exists('sec_img_verification')){
require(CWD . '/class_security_img.php');
$sec_img = new sec_img_verification();
}

if(!function_exists('iif')){
   function iif($expression, $returntrue, $returnfalse = '')
{
    return ($expression ? $returntrue : $returnfalse);
}
}

?>
