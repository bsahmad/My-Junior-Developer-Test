<?php

// Connect to the file connect-to-mysql.php

require "connect-to-mysql.php";

$sqlCommand = "CREATE TABLE products(
    sku varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    price int(11) unsigned NOT NULL,
    productType varchar(255) NOT NULL,
    size int(11) unsigned,
    height int(11) unsigned,
    width int(11) unsigned,
    length int(11) unsigned,
    weight int(11) unsigned
    )";

/* 

sku -> various character field

name -> Name of Book, Furniture or DVD

price -> unsigned means this can only be a positive number

productType -> Book, Furniture or DVD

size -> unsigned means this can only be a positive number

height -> unsigned means this can only be a positive number

width -> unsigned means this can only be a positive number

length -> unsigned means this can only be a positive number

weight -> unsigned means this can only be a positive number 

*/

// This will now execute to create the table if valid

if (mysqli_query($con, $sqlCommand)) {
    echo "Your products table has been created successfully!";
} else {
    echo "CRITICAL ERROR: products table has not been created";
}
