<?php
class Model{
    protected $fields = [];
    protected $config = [];

    public function getFields(){
        return $this->fields;
    }

    public function getTableName()
    {
        # code...
        return $this->config["name"];
    }
}