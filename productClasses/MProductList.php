<?php
abstract class MProductList
{
    protected $sku;
    protected $name;
    protected $price;
    protected $size;
    protected $height;
    protected $width;
    protected $length;
    protected $weight;

    abstract public function setValues($sku, $name, $price, $size, $height, $width, $length, $weight);
    abstract public function getInfo();
}
