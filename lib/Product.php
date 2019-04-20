<?php

use Base\Product as BaseProduct;

/**
 * Skeleton subclass for representing a row from the 'product' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Product extends BaseProduct
{
    public function getAttributes(){
        $name = $this -> getName();
        $productID = $this -> getProductid();
        $description = $this -> getDescription();
        $categoryName =$this -> getCategory()
                        -> getName();

        return ["name" => $name, "productID" => $productID, "description" => $description, "category" => $categoryName];
    }

}
