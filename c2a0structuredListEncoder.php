<pre><?php
require_once '../ini.php';
require_once '../include/loader.php';

$html = file_get_contents('c2a0structuredListEncoder.html');
$html = preg_replace(
	['~>(\xC2\xA0){6}~si'	, '~>(\xC2\xA0){3}~si'	, '~(\xC2\xA0){3}~si'], 
	[">    "				, ">"					, " "], 
	$html
);
file_put_contents('c2a0structuredListEncoderRes.html', $html);