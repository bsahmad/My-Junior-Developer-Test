<?php
class Furniture extends MProductList
{

    public function setValues($sku, $name, $price, $size, $height, $width, $length, $weight)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
        $this->weight = $weight;
    }

    public function getInfo()
    {
        echo '<div class="card-box-order-mine p-2 bd-highlight">';
        echo '<input class="delete-checkbox" type="checkbox" name="delete[]" value=' . $this->sku . '>';
        echo '<p>' . $this->sku . '</p>';
        echo '<p>' . $this->name . '</p>';
        echo '<p>' . $this->price . '.00 $</p>';
        echo '<p>Dimension: ' . $this->height . 'x' . $this->width . 'x' . $this->length . '</p>';
        echo '</div>';
    }
};
