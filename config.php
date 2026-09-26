<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();   // use load() only if .env is guaranteed to exist

$host     = getenv('DB_HOST')     ?: 'db.fr-roub1.bengt.wasmernet.com';
$username = getenv('DB_USERNAME') ?: '20184';
$password = getenv('DB_PASSWORD') ?: 'pw_aMzAQt4GH5SkIjRFEhamIQvO5qgBtnrM';
$dbname   = getenv('DB_NAME')     ?: 'db_5d479898';
$port     = (int) (getenv('DB_PORT') ?: 20184);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $username, $password, $dbname, $port);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    exit('Database connection error.');
}