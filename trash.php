<pre><?php
require_once '../ini.php';
require_once '../include/loader.php';

$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter?f=templates$fn=default.htm$3.0$vid=amlegal:newyork_ny');
file_put_contents('', $html);