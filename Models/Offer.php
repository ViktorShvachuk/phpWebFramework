<?php  
require_once("model.php");
class OfferModel extends Model{
    protected $fields = [
        "id" => 1,
        "name" => 1,
        "city" => 1,
    ],
    $config = [
        "name" => "offer",
    ];

}