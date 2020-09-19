<?php
require_once("ModelManager.php");

$mm = new ModelManager();
$mm->loadModel("Offer");
$result = $mm->getList()->addWhere("city=1")->execute();
print_r($result);