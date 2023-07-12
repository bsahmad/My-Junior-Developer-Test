<?php
// This PHP block is for turning on the Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Refresh cache
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// connect database
require "storescripts/connect-to-mysql.php";
$check = false;
if (isset($_POST["submit"])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //  if(isset($_POST['submit'])){
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $productType = $_POST['productType'];
        $size = $_POST['size'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $sql = null;
        if ($size != NULL) {
            $sql = mysqli_query($con, "INSERT INTO products(sku, name, price, productType, size, height, width, length, weight) 
            VALUES('$sku', '$name', '$price', '$productType', '$size', NULL, NULL, NULL, NULL)") or die(mysqli_error($con));
        } else if ($length != NULL) {
            $sql = mysqli_query($con, "INSERT INTO products(sku, name, price, productType, size, height, width, length, weight) 
            VALUES('$sku', '$name', '$price', '$productType', NULL, '$height', '$width', '$length', NULL)") or die(mysqli_error($con));
        } else {
            $sql = mysqli_query($con, "INSERT INTO products(sku, name, price, productType, size, height, width, length, weight) 
            VALUES('$sku', '$name', '$price', '$productType', NULL, NULL, NULL, NULL, '$weight')") or die(mysqli_error($con));
        }
        // var_dump($sql);die();
        // echo "Updated Successfully";
        header("Location: ./index.php");
        exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml/1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Product Add</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="margin-for-page" id="pageContent">


        <form name="product_form" action="" method="post" id="product_form">

            <!-- Buttons: Save + Cancel  -->

            <div class='row g-0'>
                <!-- onClick="validateMyForm()" -->
                <div class='col-md-5 w-auto ms-auto'>
                    <button id="Save" type="submit" name="submit" class="btn btn-success btn-sm" onClick="validateMyForm()">Save</button>
                    <button class="btn btn-danger btn-sm" onClick="window.location.href = '/MyTest'">CANCEL</button>
                </div>
            </div>

            <!-- Heading of page  -->

            <h1>Product Add</h1>

            <!-- Form Content - sku, name, price, type switcher, dvd attributes, furniture attributes, book attributes -->

            <div class="form-width-mine">

                <!-- SKU Section -->

                <div class="margin-top-bottom form-group row">

                    <label class="col-sm-2 col-form-label">SKU</label>

                    <div class="col-sm-10">
                        <input name="sku" type="text" class="form-control" id="sku" placeholder="Must be unique" required>

                    </div>

                </div>

                <!-- Name Section -->

                <div class="margin-top-bottom form-group row">

                    <label class="col-sm-2 col-form-label">Name</label>

                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" id="name" required>
                    </div>

                </div>

                <!-- Price Section -->

                <div class="margin-top-bottom form-group row">

                    <label class="col-sm-2 col-form-label">Price ($)</label>

                    <div class="col-sm-10">
                        <input name="price" type="number" class="form-control" id="price" placeholder="Integer only, no decimals." required>
                    </div>

                </div>

                <!-- Type Switcher Section -->

                <div class="margin-top-bottom form-group row">

                    <label class="col-sm-2 col-form-label">Type Switcher</label>

                    <div class="col-sm-10">

                        <select name="productType" class="form-control" id="productType" required>

                            <option value="" disabled selected>Select</option>
                            <option value="DVD">DVD</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Book">Book</option>

                        </select>
                    </div>

                </div>


                <!-- DVD Attributes Section -->

                <div id="DVD" class="not-here form-goup">

                    <label>Size (MB)</label>
                    <input name="size" type="integer" class="form-control" id="size" placeholder="Integer only, no decimals.">

                    <p>Please, provide size</p>

                </div>

                <!-- Furniture Attributes Section -->

                <div id="Furniture" class="not-here form-goup">

                    <label>Height (CM)</label>
                    <input name="height" type="integer" class="form-control" id="height" placeholder="Integer only, no decimals.">

                    <label>Width (CM)</label>
                    <input name="width" type="integer" class="form-control" id="width" placeholder="Integer only, no decimals.">

                    <label>Length (CM)</label>
                    <input name="length" type="integer" class="form-control" id="length" placeholder="Integer only, no decimals.">

                    <p>Please, provide dimensions</p>

                </div>

                <!-- Book Attributes Section -->

                <div id="Book" class="not-here form-goup">

                    <label>Weight (KG)</label>
                    <input name="weight" type="integer" class="form-control" id="weight" placeholder="Integer only, no decimals.">

                    <p>Please, provide weight</p>

                </div>


            </div>

        </form>
    </div>

    <!-- Including Scandiweb Test Footer -->

    <?php include("template-footer.php"); ?>

</body>

</html>



<script type="text/javascript">
    /*

    What is class ProductType?

    My main class that I will be extending below for my DVD, Furniture, Book classes

    In it I have my methods display() and require() which will be present/defined in my classes
    I will be extending ProductType to.
    
    */


    class ProductType {
        display() {
            return 0;
        }

        require() {
            return 0;
        }

    }

    function getOption() {

        /* 
            selecting the element in the above HTML via querySelector with the ID #productType, and storing
             the value in the variable named value 
        */

        let selectElement = document.querySelector('#productType');
        let value = selectElement.value;

        // console.log(value); <- me checking in console to verify

        /*

        Creating a function called catalog that will take its argument myClasses and push it
        into allProductTypes array that is initialized above it.
        
        */

        let allProductTypes = [];

        function catalog(myClasses) {
            allProductTypes.push(myClasses);
        }

        /*

        My first argument I am putting into my catalog function to push into my 
        allProductTypes array - class DVD that extends ProductType.
        
        */

        catalog(class DVD extends ProductType {

            constructor() {
                super();
                this.display();
                this.require();

                /* 

                By putting this.display() and this.require() in the constructor, this ensures
                that when a new instance of this class is called, the two methods are run immediately.

                 */
            }

            display() {
                return document.getElementById("DVD").classList.remove("not-here");

                /*

                Why am I removing not-here class from DVD?

                In my CSS, the class not-here has the styling display:none.

                By removing the class, I am making the DVD visible.

                */
            }

            require() {
                document.getElementById('size').setAttribute('required', '');

                /*

                Why am I adding the attribute required to the element with id size?

                This is to ensure that when the DVD div is visible to the user,
                they cannot save their product to the database without filling in the
                required input in the div, size.

                */
            }
        });

        /*

        My second argument I am putting into my catalog function to push into my 
        allProductTypes array - class Furniture that extends ProductType.
        
        */

        catalog(class Furniture extends ProductType {

            constructor() {
                super();
                this.display();
                this.require();
            }

            display() {
                return document.getElementById("Furniture").classList.remove("not-here");
            }

            require() {
                document.getElementById('height').setAttribute('required', '');
                document.getElementById('width').setAttribute('required', '');
                document.getElementById('length').setAttribute('required', '');
            }

        });

        /*

        My third argument I am putting into my catalog function to push into my 
        allProductTypes array - class Book that extends ProductType.
        
        */

        catalog(class Book extends ProductType {

            constructor() {
                super();
                this.display();
                this.require();
            }

            display() {
                return document.getElementById("Book").classList.remove("not-here");
            }

            require() {
                document.getElementById('weight').setAttribute('required', '');
            }

        });


        // console.log(allProductTypes); <-- me console logging the array to verify

        /*

        The below code is essentially a reset to original settings prior to the 
        for loop below running however many times a user is toggling.

        The reason for the placement being before the for loop: 
        
        To ensure that if the user clicks from the type switcher DVD, Furniture, Book, then for
        example, the user decides that they would instead like to enter a DVD, when the user
        clicks DVD again, the remanant/div of whatever option they were on previously - Furniture or Book-
        is not still visible to the user.
        
        */

        document.getElementById("DVD").classList.add("not-here");
        document.getElementById('size').removeAttribute('required');

        document.getElementById("Furniture").classList.add("not-here");
        document.getElementById('height').removeAttribute('required');
        document.getElementById('width').removeAttribute('required');
        document.getElementById('length').removeAttribute('required');

        document.getElementById("Book").classList.add("not-here");
        document.getElementById('weight').removeAttribute('required');

        /*

        the logic of for loop that is traversing my allProductTypes array:

        if the value (I stored the value of the type switcher in the variable value above)
        is equal to the name of a class inside my allProductTypes array, return
        a new instance of the class.
        
        
        */


        for (let i = 0; i < allProductTypes.length; i++) {
            if (value == allProductTypes[i].name) {
                // console.log(new allProductTypes[i]); <-- me verifying
                return new allProductTypes[i];
            }
        }
    }

    /*

    productTypeElement as a querySelector for the #productType element, 
    I am adding an event listener that runs the function getOption on change to it.
    
    */

    let productTypeElement = document.querySelector('#productType');
    productTypeElement.addEventListener("change", getOption);

    // this function validates that the required values have been inputted
    function validateMyForm() {
        let isValid = true;
        if (document.product_form.sku.value == "") {
            alert("Please provide the sku value");
            isValid = false;
        } else if (document.product_form.name.value == "") {
            alert("Please provide the product name value");
            isValid = false;
        } else if (document.product_form.price.value == "") {
            alert("Please provide the price for the product");
            isValid = false;
        } else if (document.product_form.productType.value == "") {
            alert("Please select a product type");
            isValid = false;
        }
        return isValid;
    }
</script>