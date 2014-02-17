<?php
$scriptStart = microtime(true);

$iterations = 5000;
$longString = str_repeat('0123456789', 102 * 5); // 10 * 102 * 5 = 5k

if (is_file(dirname(__FILE__) . '/config/site.php')) {
	include(dirname(__FILE__) . '/config/site.php');

	if (defined('DB_SERVER')) {
		$db_host = DB_SERVER;
		$db_name = DB_DATABASE;
		$db_user = DB_USERNAME;
		$db_pass = DB_PASSWORD;
	}
}

if (! $db_host) {
	$db_host = 'localhost';
	$db_name = 'c56latest';
	$db_user = 'root';
	$db_pass = '';
}

$results = array('version' => 1, 'server' => array(), 'benchmarks' => array('base_iterations' => $iterations, 'string_len' => strlen($longString), 'func' => array(), 'file' => array(), 'db' => array()));

$results['server']['system'] = php_uname('s');
$results['server']['host'] = php_uname('n');
$results['server']['machine'] = php_uname('m');
$results['server']['php_version'] = phpversion();

/**
 * calling a user-space function recursively
 */
function recursiveFunc($recurse) {
	return ($recurse) ? recursiveFunc(--$recurse) : $recurse;
}

$start = microtime(true);
for ($i = 0; $i < $iterations; $i++) {
	recursiveFunc(10);
}
$end = microtime(true);
$results['benchmarks']['func']['user'] = $end - $start;

/**
 * Calling a native function
 */
$start = microtime(true);
for ($i = 0; $i < $iterations; $i++) {
	$result = md5($longString);
}
$end = microtime(true);
$results['benchmarks']['func']['md5'] = $end - $start;

/**
 * Filesystem writes
 */
$basename = tempnam(sys_get_temp_dir(), 'benchmark_testing_');
$fileIterations = $iterations / 10;

$start = microtime(true);
for ($i = 0; $i < $fileIterations; $i++) {
	file_put_contents($basename . $i, $longString);
}
$end = microtime(true);
$results['benchmarks']['file']['write'] = $end - $start;

$start = microtime(true);
for ($i = 0; $i < $fileIterations; $i++) {
	file_get_contents($basename . $i);
}
$end = microtime(true);
$results['benchmarks']['file']['read'] = $end - $start;

for ($i = 0; $i < $fileIterations; $i++) {
	unlink($basename . $i);
}

/**
 * Mysql
 */
try {
	$start = microtime(true);
	$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	$end = microtime(true);

	$results['server']['db_driver'] = 'pdo';
	$results['benchmarks']['db']['connection'] = $end - $start;

	//create the table
	$pdo->exec('CREATE TEMPORARY TABLE benchmark_testing (id int auto_increment primary key, value text)');

	$dbIterations = $iterations / 2;

	$start = microtime(true);
	for ($i = 0; $i < $dbIterations; $i++) {
		$pdo->exec("INSERT INTO benchmark_testing (value) VALUES ('" . $longString . $i . "')");
	}
	$end = microtime(true);
	$results['benchmarks']['db']['insert'] = $end - $start;

	$dbIterations = $iterations / 350;
	$start = microtime(true);
	for ($i = 0; $i < $dbIterations; $i++) {
		$pdo->query("SELECT COUNT(*) FROM benchmark_testing WHERE value LIKE '%$i%'");
	}
	$end = microtime(true);
	$results['benchmarks']['db']['select_like'] = $end - $start;
} catch (Exception $e) {
	//PDO wasn't available. try mysqli
}

$results['benchmarks']['total'] = microtime(true) - $scriptStart;

if (isset($_GET['json'])) {
	header('Content-Type: application/json');
	echo json_encode($results);
	exit;
}

function tr($label, $value, $isTime = false) {
	$value = ($isTime) ? round($value, 3) : $value;
	echo "<tr><td>$label</td><td>$value</td></tr>";
}

?>
<html>
	<head>
	</head>
	<body>
		<h2>Server</h2>
		<table>
			<tbody>
				<?php
					tr('Hostname', $results['server']['host']);
					tr('System Type', $results['server']['system']);
					tr('Machine Architecture', $results['server']['machine']);
					tr('PHP Version', $results['server']['php_version']);
				?>
			</tbody>
		</table>

		<h2>Benchmarks</h2>
		<table>
			<thead>
				<?php tr('Test', 'Time (seconds)'); ?>
			</thead>
			<tfoot>
				<?php tr('Total', $results['benchmarks']['total'], true); ?>
			</tfoot>
			<tbody>
				<?php
					tr('Function - Recursive', $results['benchmarks']['func']['user'], true);
					tr('Function - MD5', $results['benchmarks']['func']['md5'], true);
					tr('File - Write', $results['benchmarks']['file']['write'], true);
					tr('File - Read', $results['benchmarks']['file']['read'], true);
					tr('MySQL - Insert', $results['benchmarks']['db']['insert'], true);
					tr('MySQL - Search (LIKE)', $results['benchmarks']['db']['select_like'], true);
				?>
			</tbody>
		</table>
	</body>
</html>