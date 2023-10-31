<?php
session_start();
require_once('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
$ProdId = $_REQUEST['ProdId'];

// Lấy thông tin sản phẩm
$sqlProd = "SELECT * FROM product where ProdId = $ProdId";
$product = mysqli_query($connection, $sqlProd);
$dataProduct = mysqli_fetch_assoc($product);


// lấy thông tin các danh mục sản phấm 
$sqlcate = "SELECT ProdCategoryName FROM productproperty group by ProdCategoryName;";
$listCate = mysqli_query($connection, $sqlcate);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="./editProduct.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>

<body>
    <div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Sản phẩm</li>
            <li class="breadcrumb-item active">Sửa sản phẩm</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Sửa sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <form action="./editProductAction.php?ProdId=<?php echo $ProdId ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input hidden type="text" name="product_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nhóm sản phẩm</label>
                                <br>
                                <select name="slCid" id="slCid">
                                    <option value="">_________Tên danh mục________</option>
                                    <?php

                                    foreach ($listCate as $key => $value) { ?>
                                        <option value="<?php echo $value['ProdCategoryName'] ?>" <?php echo (($value['ProdCategoryName'] == $dataProduct["ProdCategoryName"]) ? 'selected' : '') ?>> <?php echo $value["ProdCategoryName"] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input required type="text" class="form-control" value="<?php echo $dataProduct['ProdName'] ?>" name="pname">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input required type="number" class="form-control" value="<?php echo $dataProduct['ProdQuantity'] ?>" name="pquantity">
                            </div>
                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input required type="number" class="form-control" value="<?php echo $dataProduct['ProdPrice'] ?>" name="pprice">
                            </div>
                            <div class="form-group">
                                <label>Giá đã được giảm giá</label>
                                <input required type="number" class="form-control" value="<?php echo $dataProduct['ProdPriceSale'] ?>" name="ppricesale">
                            </div>
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <br>
                                <input class="image_prod" type="file" name="pimage">
                                <br>
                                <img class="preview" style="width: 130px; margin: 50px;" src="../../images/<?php echo $dataProduct['ProdImage'] ?>" alt="">
                            </div>
                            <script>
                                const inputImg = document.querySelector("input.image_prod");
                                inputImg.addEventListener("change", function(e) {
                                    const file = e.target.files[0];

                                    if (file) {
                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            document.querySelector("img.preview").src = e.target.result;
                                        };

                                        reader.readAsDataURL(file);
                                    } else {
                                        document.querySelector("img.preview").src = "../../images/<?php echo $dataProduct['ProdImage'] ?>"; // Xóa hình ảnh xem trước nếu không có tệp được chọn
                                    }
                                });
                            </script>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="pdesc" id="editor"><?php echo $dataProduct["ProdDescription"] ?></textarea>
                                <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        ClassicEditor
                                            .create(document.querySelector('#editor'))
                                            .then(editor => {
                                                console.log(editor);
                                            })
                                            .catch(error => {
                                                console.error(error);
                                            });
                                    });
                                </script>
                            </div>
                            <input name="add_product" value="Cập nhật" type="submit" class="btn btn-primary mt-2">
                            <a href="myProduct.php" class="btn btn-danger mt-2">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../includes/footer.php');
    ?>
</body>

</html>