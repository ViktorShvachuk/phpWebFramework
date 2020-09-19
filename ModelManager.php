<?php 
require_once("model.php");
require_once("configDB.php");

class ModelManager{
	private $db;
	private $model;
	private $selectedFields;
	private $tableName;
	private $where = [];

	function __construct(){
		// connect to db if not connnected
		
	}

	public function getList(){
		$tableName = $this->model->getTableName();
		$fields = $this->model->getFields();
		$fieldsNames = array_keys($fields);
		$fieldsNameString = implode(", ", $fieldsNames);
		
		$this->selectedFields = $fieldsNameString;
		$this->tableName = $tableName;

		return $this;
	}

	public function addWhere($condition){
		$this->where[] = $condition;

		return $this;
	}

	public function execute()
	{
		$fields = $this->model->getFields();
		$fieldsNames = array_keys($fields);
		$where = array_values($this->where);
		$where = implode(" AND ", $where);
		
		if(empty($this->selectedFields)) return false;
		if(empty($this->tableName)) return false;

		$sql = "SELECT " . $this->selectedFields . " FROM " . $this->tableName;
		
		if(!empty($where)){
			$sql .= " WHERE " . $where;
		}

		$sql .= ";";

		$conn = new mysqli(configDB::$servername, configDB::$username, configDB::$password, configDB::$dbName);
		$queryResult = $conn->query($sql);
		$result = [];
		if ($queryResult->num_rows > 0) {
			while($row = $queryResult->fetch_assoc()) {
				$currentRow = [];
				foreach($fieldsNames as $fieldName){
					$currentRow[$fieldName] = $row[$fieldName];
				}
				$result[] = $currentRow;
			}
		}
		else {
			echo "0 results";
		}
		$conn->close();

		return $result;
	}

	public function loadModel($modelName) {
		include "Models/" . $modelName . '.php';
		$className = $modelName . 'Model';
		$this->model = new $className();
	}
}