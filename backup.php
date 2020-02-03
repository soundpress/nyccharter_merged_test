<pre><?php
// ====================================================================================
$backupRoot = '\\\\ATX\\backups\\';
$backupWrkDir = '\\\\ATX\\backups\\_wrk\\';
$ignore = [
	'srv',
//	'data',
];
$zipExe = 'c:/Program Files/7-Zip/7z.exe';
// ====================================================================================

if (file_exists('../include/loader.php'))
	require_once '../include/loader.php';

if (!defined('ROOTDIR'))
	define('ROOTDIR', dirname(__DIR__));

$stationName = exec('hostname');

$backupRoot = "{$backupRoot}{$stationName}\\";
$backupFile = preg_replace('~^.*\\\domains\\\~si', $backupRoot, ROOTDIR);
$backupDir = dirname($backupFile);
$backupFn = basename($backupFile) . '.zip';
$backupWrkFile = $backupWrkDir . "{$backupFn}";
$ignoreRg = sprintf('~^(%s|\.|\.\.)$~si', implode('|', $ignore));
if (file_exists($backupWrkFile))
	unlink($backupWrkFile);
foreach (scandir(ROOTDIR) as $fn)
	if (!preg_match($ignoreRg, $fn))
	{
		echo ROOTDIR . "\\{$fn}\n"; flush();
		if (is_file(ROOTDIR . "/{$fn}"))
			$cmd = sprintf('"%s" a %s %s\\%s', $zipExe,  $backupWrkFile, ROOTDIR, $fn);
		elseif(is_dir(ROOTDIR . "/{$fn}"))
			$cmd = sprintf('"%s" a %s %s\\%s\\', $zipExe,  $backupWrkFile, ROOTDIR, $fn);
		$output = myexec($cmd, '~Add new data|Everything is~si');
		echo implode("\n", $output) . "\n\n";
		flush();
	}

if (!is_dir($backupDir))
	myexec("mkdir {$backupDir}");

for ($i=0; $i<=2; $i++)
{
	$r = rename($backupWrkFile, $backupDir . '\\' . $backupFn);
	if ($r)
		break;
	else
		sleep(3);
}
echo $r ? "Archive succesfully moved to {$backupDir}\n" : "Archive moving failed\n";
//print_r([$backupFn, $backupDir, $ignoreRg, $backupWrkFile, $stationName, $backupFile]);


function myexec($cmd, $rg='~QQQQQQQQQ~si')
{
	exec($cmd, $output, $res);
	if ($res)
		return false;
	$rr = [];
	foreach ($output as $r)
		if (preg_match($rg, $r))
			$rr[] = $r;
	return $rr;
}