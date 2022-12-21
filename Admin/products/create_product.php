<?php
include('../server/connection.php');
include('../products/add.php');
include '../set.php';

$sql  = "SELECT * FROM `supplier`";
$result = mysqli_query($db, $sql);
if (!$result->num_rows > 0) {
    echo '<script>swal("No Supplier","Products needs suppliers","error");</script>';
}
$success = isset($_GET['success']);

?>
<!DOCTYPE html>
<html>

<head>
    <?php include('../../templates/head1.php'); ?>
</head>

<body>
    <div class="contain h-100">
        <?php
        include('../products/base.php');
        include('../products/alert.php');
        if ($success) {
            echo '<script>swal("Successful","Added a product successfully","success");</script>';
        }
        ?>
        <div class="row ">
            <div class="col-12 ">
                <h1 class="ms-5 mt-1"><i class="fa-solid fa-circle-plus"></i> Add Products</h1>
                <hr class="mb-0 mt-1">
            </div>
            <div class="row">
                <div class="col-12 col-md-6 ms-md-0 mt-4 pe-md-5 text-md-end text-center ">
                    <img class="img-fluid p-1  " style="border:1px dashed black; width: 250px;height: 250px;" src="../../images/add-product.png">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="size" class="form-control-sm" value="1000000">
                        <input class="form-control-sm" type="file" name="image" required>
                        <p class="bg-danger mt-3">
                </div>
                <div class="col-12 col-md-6 ps-5 ms-5 ps-md-0  ms-md-0">
                    <table class="table-responsive mt-2  text-md-start">
                        <tbody>
                            <tr>
                                <td valign="baseline">Barcode:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="barcode" class="form-control-sm form-control" title="Enter barcode" placeholder="Enter product barcode" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Product Name:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="name" class="form-control-sm form-control" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter product name" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Product Size:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
                                        <select class="form-control-sm form-control" name="size" title="Select the product size" aria-label="Default select example">
                                            <option value="Custom">Custom</option>
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                            <option value="X-Large">X-Large</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Supplier:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
                                        <select class="form-control-sm form-control" name="supplier" title="Select the product size" aria-label="Default select example">
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <option <?= 'value="' . $row['supplier_id'] . '"' ?>><?php echo $row["company_name"]; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Cost Price:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="cost_price" class="form-control form-control-sm" title="Costprice in decimal eg 10.45" placeholder="Enter cost price" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Profit:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="profit" class="form-control form-control-sm" title="Profit in decimal eg 10.45" placeholder="Enter Profit" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Sell Price:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" readonly name="sel_price" class="form-control form-control-sm" title="Name must not contain numbers or spaces e.g John12" placeholder="SP= CP + P" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Unit per price:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="unit" class="form-control form-control-sm" title="The price for how many product" placeholder="Enter unit per price">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Min Stocks:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="min_stock" class=" form-control form-control-sm" title="The number of stocks the quantity total must not go below" placeholder="Enter minimum stock">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Remarks:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="remarks" class=" form-control form-control-sm" title="Name must not contain numbers or spaces e.g John12" placeholder="Enter remarks">
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="container p-1">
                        <button type="submit" name="add_product" class="admin_background btn btn-warning"><i class="fas fa-thumbs-up"></i> Submit</button>
                        <button class="admin_background btn btn-warning" onclick="window.location.href='../products/create_product.php'"><i class="fas fa-ban"></i> Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../../bootstrap4/jquery/jquery.min.js"></script>
    <script src="../../bootstrap4/js/bootstrap.bundle.min.js"></script>
    <script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
	</script>
</body>

</html>