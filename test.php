<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/lib/class/class.helper.php');

$h = new Helper();

$number = "(321)6549870";
$locale = 237;

$x = $h->format_PhoneNumber($number, $locale);
echo $x.'<br />';

$n2 = "987-6546540";
$y = $h->format_PhoneNumber($n2, $locale);
echo $y.'<br />';




?>