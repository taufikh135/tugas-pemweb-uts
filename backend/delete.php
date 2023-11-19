<?php
require_once __DIR__ . "/../config/db.php";

if (!isset($_GET["id"]))
    exit("data tidak ditemukan");

$id = (int) $_GET["id"];

$checkProduct = $db_connect->query("SELECT name, image FROM products WHERE id = '$id' LIMIT 1");
$dataProduct = $checkProduct->fetch_assoc();

if (!$checkProduct->num_rows)
    exit("Product tidak ditemukan");

$file = __DIR__ . "/..{$dataProduct['image']}";

if (!is_file($file))
    exit("File tidak ditemukan");

unlink($file);

$db_connect->query("DELETE FROM products WHERE id = $id");

exit("data {$dataProduct['name']} berhasil dihapus");
