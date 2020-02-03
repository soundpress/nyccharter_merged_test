<pre><?php
require_once '../ini.php';
require_once '../include/loader.php';
use ScrapingClub\Crawler\Packages\Curl\Curl;

$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter?f=templates$fn=default.htm$3.0$vid=amlegal:newyork_ny');
file_put_contents('mappingAdmincode1-frameset.html', $html);

$p = [CURLOPT_REFERER => 'http://library.amlegal.com/nxt/gateway.dll/New%20York/charter/newyorkcitycharter?f=templates$fn=contents-frame-js.htm$3.0&cp=/New%20York/charter/newyorkcitycharter&sel=0&tf=main&tt=document-frameset.htm&t=contents-frame-js.htm&och=onClick&global=hitdoc_g_&hitdoc_g_dt=document-frameset.htm'];

sleep(10);
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll?f=xmlcontents&command=getchildren&basepathid=New%20York/admin&maxnodes=75&minnodesleft=1&maxgrandchildren=200', $p);
file_put_contents('mappingAdmincode2-tocLong.html', $html);

sleep(11);
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/admin/title30emergencymanagement/chapter1officeofemergencymanagement', $p);
file_put_contents('mappingAdmincode5-page30.html', $html);

sleep(12);
$html = Curl::exec('http://library.amlegal.com/nxt/gateway.dll/New%20York/admin/title32laborandemployment/chapter2divisionofpaidcare', $p);
file_put_contents('mappingAdmincode4-page32.html', $html);
