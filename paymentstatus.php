<?php
include('./dbConnection.php');
// Header Include from mainInclude 
include('./mainInclude/header.php'); 

$ORDER_ID = "";

if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {
    $ORDER_ID = $_POST["ORDER_ID"];
}
?>  

<div class="container-fluid bg-dark text-white py-5" style="border: 2px solid #ccc; border-radius: 8px;"> <!-- Start Course Page Banner -->
    <div class="row">
        <div class="col text-center">
            <!-- comment <h1 class="display-4">Payment Status</h1>-->
        </div>
    </div>
</div> <!-- End Course Page Banner -->

<div class="container my-5">
    <h2 class="text-center my-4">Check Payment Status</h2>
    <form method="post" action="">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Order ID:</label>
            <div class="col-sm-6">
                <input class="form-control" id="ORDER_ID" tabindex="1" maxlength="20" name="ORDER_ID" autocomplete="off" value="<?php echo htmlspecialchars($ORDER_ID); ?>">
            </div>
            <div class="col-sm-3">
                <input class="btn btn-primary" value="View" type="submit">
            </div>
        </div>
    </form>
</div>

<div class="container">
    <?php
    if (isset($_POST['ORDER_ID'])) { 
        $sql = "SELECT order_id FROM courseorder";
        $result = $conn->query($sql);
        $orderFound = false;

        while ($row = $result->fetch_assoc()) {
            if ($_POST["ORDER_ID"] == $row["order_id"]) {
                $orderFound = true; ?>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">Payment Receipt</h2>
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td><strong>Order ID</strong></td>
                                            <td><?php echo htmlspecialchars($row["order_id"]); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong></td>
                                            <td class="text-success"><strong>Success</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <button class="btn btn-primary" onclick="javascript:window.print();">Print Receipt</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>      
                            </div>
                        </div>
                    </div>
                </div>
    <?php 
            }
        } 
        if (!$orderFound) {
            echo '<div class="alert alert-warning text-center mt-4">Order ID not found. Please try again.</div>';
        }
    }
    ?>
</div>  

<div class="mt-5">
    <?php // Contact Us
    include('./contact.php'); 
    ?> 
</div>

<?php 
// Footer Include from mainInclude 
include('./mainInclude/footer.php'); 
?>  
