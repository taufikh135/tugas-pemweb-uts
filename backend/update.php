<?php
require_once __DIR__ . "/../config/db.php";

if (!isset($_POST['submit']))
    exit('error');

$id = (int) $_POST['id'];
$name = $db_connect->real_escape_string(htmlspecialchars($_POST['name']));
$price = (int) $_POST["price"];
$fileImage = $_FILES["image"];

$checkProduct = $db_connect->query("SELECT image FROM products WHERE id = '$id' LIMIT 1");
$dataProduct = $checkProduct->fetch_assoc();

if (!$checkProduct->num_rows)
    exit("produk tidak ditemukan");
if (empty($name))
    exit("name tidak boleh kosong");
if (!($price > 0))
    exit("price  tidak boleh kurang dari 0");

if (!$fileImage['error']) {
    $nameFileImage = $fileImage['name'];
    $tmpFileImage = $fileImage["tmp_name"];

    $allowEkstension = ["jpg", "jpeg", "png"];

    $ekstensionFileImage = explode(".", $nameFileImage);
    $ekstensionFileImage = $ekstensionFileImage[count($ekstensionFileImage) - 1];

    $newNameFileImage = "/upload/" . uniqid("product", true) . ".$ekstensionFileImage";

    if (!in_array($ekstensionFileImage, $allowEkstension))
        exit("ekstensi tidak $ekstensionFileImage tidak diizinkan.");

    $isDelete = unlink(__DIR__ . "/..{$dataProduct['image']}");
    $isUpdate = $db_connect->query("UPDATE products SET image = '$newNameFileImage' WHERE id = '$id' LIMIT 1");
    $result = move_uploaded_file($tmpFileImage, __DIR__ . "/..$newNameFileImage");

    if (!$result || !$isUpdate || !$isDelete)
        exit("image gagal diupdate");

    echo "image & ";
}

$query = $db_connect->query("UPDATE products SET name = '$name', price = '$price' WHERE id = '$id' LIMIT 1");

if (!$query)
    exit("gagal diupdate");

echo "data berhasil diupdate";
?>