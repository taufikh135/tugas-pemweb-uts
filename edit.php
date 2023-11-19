<?php
require_once __DIR__ . "/config/db.php";

if (!isset($_GET["id"]))
    exit("product tidak ditemukan");

$id = (int) $_GET["id"];

$checkProduct = $db_connect->query("SELECT name, price, image FROM products WHERE id = '$id' LIMIT 1");

if (!$checkProduct->num_rows)
    exit("product tidak ditemukan");

$countProduct = $checkProduct->num_rows;
$dataProduct = $checkProduct->fetch_assoc();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="./backend/update.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="<?= $dataProduct['name'] ?>" class="form-control"
                            id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="pirce" class="form-label">Price</label>
                        <input type="number" name="price" value="<?= $dataProduct['price'] ?>" class="form-control"
                            id="pirce">
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="flex-grow-1">
                            <label for="formFile" class="form-label">Gambar</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div style="width: 200px;">
                            <img src=".<?= $dataProduct['image'] ?>" class="img-fluid" alt="blank" srcset="">
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>