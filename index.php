<?php

// This PHP block is for turning on the Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// To turn off error messages, comment the above code and use following
// ini_set('display_errors', 0);
// error_reporting(0);

// The PHP block will Parses data from the form to put into the products database

// Refresh cache
// Refresh the cache
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// Connect to the file connect-to-mysql.php
require "storescripts/connect-to-mysql.php";

// This is to Parse form data and add inventory to database

if (isset($_GET['sku'])) {

    $sku = mysqli_real_escape_string($con, $_GET['sku']);
    $name = mysqli_real_escape_string($con, $_GET['name']);
    $price = mysqli_real_escape_string($con, $_GET['price']);
    $productType = mysqli_real_escape_string($con, $_GET['productType']);
    $size = mysqli_real_escape_string($con, $_GET['size']);
    $height = mysqli_real_escape_string($con, $_GET['height']);
    $width = mysqli_real_escape_string($con, $_GET['width']);
    $length = mysqli_real_escape_string($con, $_GET['length']);
    $weight = mysqli_real_escape_string($con, $_GET['weight']);

    //This is to see if there is a duplicate sku already exists in the database

    $sql = mysqli_query($con, "SELECT sku FROM products WHERE sku='$sku'LIMIT 1");

    // This is to count the output amount and if there is an sku match then the below value will be 1

    $skuMatch = mysqli_num_rows($sql);

    if ($skuMatch > 0) {
        echo 'Sorry you tried to place a product in the database with an sku that already exists, 
        please view the inventory <a href="/">Return to Inventory </a>';

        exit();
    }

    // This is to otherwise add this product into the products database

    $sql = mysqli_query($con, "INSERT INTO products(sku, name, price, productType, size, height, width, length, weight) 
    VALUES('$sku', '$name', '$price', '$productType', '$size', '$height', '$width', '$length', '$weight')") or die(mysqli_error($con));
}


// What does this php block do: Grabs all the children of MProductList into an array

//including the main php that 

include_once 'productClasses/MProductList.php'; // Where my main class is that the below php files are extending
include_once 'productClasses/Book.php';
include_once 'productClasses/DVD.php';
include_once 'productClasses/Furniture.php';

/*

what is the logic for this foreach loop:

for each declared class that is a subclass of MProductList, add that class to the children array that is declared above it.

*/

$children = array();

foreach (get_declared_classes() as $class) {
    if (is_subclass_of($class, 'MProductList')) {
        $children[] = $class;
    }
}


// What does this php block do: Deletes items when Mass Delete button is clicked

if (isset($_POST["please_delete"])) {
    if (isset($_POST['delete'])) {
        $in_str = "'" . implode('\', \'', $_POST['delete']) . "'";
        $delete = $con->query("DELETE FROM products WHERE sku IN (" . $in_str . ")");
        header("Location: ./index.php");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml/1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Products List</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <main>
        <div class="margin-for-page" id="pageContent">
            <form method="post" action="./index.php">
                <!-- Buttons: Add + MASS DELETE  -->
                <div class='row g-0'>
                    <div class='col-md-5 w-auto ms-auto'>
                        <button type="button" class="btn btn-success btn-sm" onClick="redirectMe()">ADD</button>

                        <input id="delete-product-btn" type="submit" value="MASS DELETE" name="please_delete" class="btn btn-danger btn-sm">
                    </div>
                </div>

                <h2>Products List</h2>

                <?php
                // print_r($children) <-- me checking + printing to verify the children array
                ?>

                <div class="d-flex flex-row bd-highlight mb-3 flex-wrap">

                    <?php
                    //to now go through the array
                    $ascorder = "SELECT * FROM products ORDER BY name ASC";
                    $sql = mysqli_query($con, $ascorder);
                    $productCount = mysqli_num_rows($sql);

                    if ($productCount > 0) {

                        while ($row = mysqli_fetch_object($sql)) {

                            $key = array_search("$row->productType", $children);
                            $ourNewProduct = new $children[$key]();
                            $ourNewProduct->setValues(
                                "$row->sku",
                                "$row->name",
                                "$row->price",
                                "$row->size",
                                "$row->height",
                                "$row->width",
                                "$row->length",
                                "$row->weight"
                            );
                            echo $ourNewProduct->getInfo();
                        }
                    }
                    ?>
                </div>
            </form>
        </div>

        <!-- Including Scandiweb Test Footer -->

        <?php include_once("template-footer.php"); ?>
    </main>

    <script type="text/javascript">
        // What does this javascript block do: holds the redirect function that is used for the Add button below

        function redirectMe() {
            window.location = 'add-product.php';
            // console.log('clicked!')
        }
    </script>

</body>

</html>