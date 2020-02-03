<pre><?php
require_once '../ini.php';
require_once '../include/loader.php';
use ScrapingClub\Crawler\Packages\Curl\Curl;

$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter?f=templates$fn=default.htm$3.0$vid=amlegal:newyork_ny');
file_put_contents('initMapping1-frameset.html', $html);
/*
sleep(1);
$p = [CURLOPT_REFERER => 'http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter?f=templates$fn=contents-frame-js.htm$3.0&cp=/New%20York/charter/newyorkcitycharter&sel=0&tf=main&tt=document-frameset.htm&t=contents-frame-js.htm&och=onClick&global=hitdoc_g_&hitdoc_g_dt=document-frameset.htm'];
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll?f=xmlcontents&command=getchildren&basepathid=/&maxnodes=1500&minnodesleft=1&maxgrandchildren=200&depth=2', $p);
file_put_contents('initMapping2-tocShort.html', $html);
*/
$p = [CURLOPT_REFERER => 'http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter?f=templates$fn=contents-frame-js.htm$3.0&cp=/New%20York/charter/newyorkcitycharter&sel=0&tf=main&tt=document-frameset.htm&t=contents-frame-js.htm&och=onClick&global=hitdoc_g_&hitdoc_g_dt=document-frameset.htm'];

sleep(1);
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll?f=xmlcontents&command=getchildren&basepathid=New%20York/charter&maxnodes=75&minnodesleft=1&maxgrandchildren=200', $p);
file_put_contents('initMapping2-tocLong.html', $html);

sleep(1);
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter/chapter13-aofficeofeconomicandfinancialo', $p);
file_put_contents('initMapping5-page13a.html', $html);

sleep(1);
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter/chapter8cityplanning', $p);
file_put_contents('initMapping4-page8.html', $html);
