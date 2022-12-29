<?php
include('../server/connection.php');
include('../products/upload.php');
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
        include('../error.php');
        if ($success) {
            echo '<script>swal("Successful","Added a product successfully","success");</script>';
        }
        ?>
        <div class="row ">
            <div class="col-12 ">
                <h1 class="ms-5 mt-1"><i class="fa-solid fa-file-import"></i> Import CSV_file of Products</h1>
                <hr class="mb-0 mt-1">
            </div>
            <div class="row">
                <div class="col-12 col-md-8 ms-md-0 mt-4 pe-md-5 text-md-end text-center ">
                    <div class="card text-center ms-4 me-4 shadow-sm">
                        <div class="card-header admin_background">
                            <h2 >Important Reminder!</h2>
                        </div>
                        <div class="card-body text-start overflow-auto pb-1 pt-1 " >
                        <p class="mb-0">
						In importing CSV file: <br> 
                        <span class="text-danger">--</span> Please ensure that your excel or spreadsheet file has all the columns present in order as shown on the left. <br>
                        <span class="text-danger">--</span> Please make sure the required(<span class="text-danger">*</span>) is filled up in your excel file or spreadsheet.<br/>
                        <span class="text-danger">--</span> Ensure the supplier of a product is added to the system before adding the product. <br> <small class="text-danger">Suppliers that have been added to the system show up in the supplier dropdown field.</small> <br> 
                        <span class="text-danger">--</span> Product must be either Small, Medium, Large, X-Large or Custom as shown in the product size dropdown field <br>
                        <span class="text-danger">--</span> Image name not required so you can edit the products anytime.
					</p>  

                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="size" class="form-control-sm" value="1000000">
                                
                                <p class="bg-danger mt-3">
                        </div>
                        <div class="admin_background card-footer ">
                        <i class="fas fa-file-upload"></i> Select CSV file: <input class="form-control-sm" type="file" name="file" required> 
                        <div class="container p-1 pt-2">
                        <button type="submit" name="upload_product" class="admin_background btn btn-outline-dark w-100"><i class="fa-solid fa-upload"></i> Upload</button>
                    </div>
				</div>
                    </div>
                </div>
                <div class="col-12 col-md-4 ps-5 ms-5 ps-md-0  ms-md-0">
                    <table class="table-responsive mt-5 text-md-start">
                        <tbody>
                            <tr>
                                <td valign="baseline">Barcode:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="barcode" class="form-control-sm form-control" title="Enter barcode" readonly><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Product Name:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="name" class="form-control-sm form-control" title="Name must not contain numbers or spaces e.g John12" readonly><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Product Size:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
                                        <select class="form-control-sm form-control" name="size" title="product size should include one of the following" aria-label="Default select example">
                                            <option value="Custom">Custom</option>
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                            <option value="X-Large">X-Large</option>
                                        </select><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Supplier:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
                                        <select class="form-control-sm form-control" name="supplier" title="Supplier of a product must be enter in the system before adding product" aria-label="Default select example">
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <option <?= 'value="' . $row['supplier_id'] . '"' ?>><?php echo $row["company_name"]; ?></option>
                                            <?php
                                            } ?>
                                        </select><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Cost Price:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="cost_price" class="form-control form-control-sm" title="Costprice in decimal eg 10.45" readonly><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Profit:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="profit" class="form-control form-control-sm" title="Profit in decimal eg 10.45" readonly> <span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                          
                            <tr>
                                <td valign="baseline">Unit per price:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="unit" class="form-control form-control-sm" title="The price for how many product" readonly><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Min Stocks:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="min_stock" class=" form-control form-control-sm" title="The number of stocks the quantity total must not go below" readonly><span class="text-danger">*</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="baseline">Remarks:</td>
                                <td class="ps-2 pb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="remarks" class=" form-control form-control-sm" title="Name must not contain numbers or spaces e.g John12" readonly> <span class="text-light">_</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
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