<?php
include('../server/connection.php');
include('../products/add.php');
include '../set.php';

$sql  = "SELECT * FROM `supplier`";
$result = mysqli_query($db, $sql);
if(!$result->num_rows >0){
    echo '<script>swal("No Supplier","Products needs suppliers","error");</script>';
}
$success = isset($_GET['success']);
    
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('../../templates/head1.php');?>
</head>
<body>
<div class="contain h-100">
    <?php
    include('../products/base.php');
    include('../products/alert.php');
    if($success){
        echo '<script>swal("Successful","Added a product successfully","success");</script>';
    }
    ?>
    <div class="main">
        <div class="side">
            <h1 class="ml-4"><i class="fas fa-user-friends"></i> Product Management</h1>
            <hr>
        </div>
        <div class="first_side ml-5 mt-5 mr-3">
            <div style="border:1px dashed black; width: 250px;height: 250px;">
                <img class="img-fluid p-2 h-100 w-100" src="../images/customer.png">
            </div>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="size" class="form-control-sm" value="1000000">
                <input class="form-control-sm" type="file" name="image" required>
                <p class="bg-danger mt-3">
        </div>
        <div class="second_side">
            <table class="table-responsive mt-5">
                <tbody>
                <tr>
                    <td  valign="baseline">Barcode:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="barcode" class="form-control-sm form-control"  title="Enter barcode" placeholder="Enter product barcode" required></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Product Name:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="name" class="form-control-sm form-control"  title="Name must not contain numbers or spaces e.g John12" placeholder="Enter product name" required></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Product Size:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
                    <select class="form-control-sm form-control" name="size" title="Select the product size" aria-label="Default select example">
                        <option value="Custom">Custom</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                        <option value="X-Large">X-Large</option>
                    </select></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Supplier:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
                    <select class="form-control-sm form-control" name="supplier" title="Select the product size" aria-label="Default select example">
                        <?php while($row = $result->fetch_assoc())
			            {?>
                        <option <?='value="'. $row['supplier_id'] . '"'?> ><?php echo $row["company_name"];?></option>
                        <?php 
			            }?>
                    </select></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Cost Price:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="cost_price" class="form-control-sm form-control"  title="Costprice in decimal eg 10.45" placeholder="Enter cost price" required></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Profit:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="profit" class="form-control-sm form-control"  title="Profit in decimal eg 10.45" placeholder="Enter Profit" required></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Sell Price:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" readonly name="sel_price" class="form-control-sm form-control"  title="Name must not contain numbers or spaces e.g John12" placeholder="SP= CP + P" required></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Unit per price:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="unit" class="form-control-sm form-control"  title="The price for how many product" placeholder="Enter unit per price" ></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Min Stocks:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="number" name="min_stock" class="form-control-sm form-control"  title="The number of stocks the quantity total must not go below" placeholder="Enter minimum stock" ></div></td>
                </tr>
                <tr>
                    <td  valign="baseline">Remarks:</td>
                    <td class="pl-5 pb-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div><input type="text" name="remarks" class="form-control-sm form-control"  title="Name must not contain numbers or spaces e.g John12" placeholder="Enter remarks" ></div></td>
                </tr>

                </tbody>
            </table>
            <div class="container p-5">
                <button type="submit" name="add_product" class="btn btn-secondary"><i class="fas fa-thumbs-up"></i> Submit</button>
                <button class="btn btn-danger" onclick="window.location.href='../products/create_product.php'" ><i class="fas fa-ban"></i> Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="../bootstrap4/jquery/jquery.min.js"></script>
<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
</body>
</html>