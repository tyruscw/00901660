<?php
include("config.php");
ini_set('display_errors', 'On');
error_reporting(E_ALL);
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Event($connString);

	switch($action) {
	 default:
	 $empCls->getEmployees($params);
	 return;
	}
	class Event {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getEvents($params) {
    
    $this->data = $this->getRecords($params);
    
    echo json_encode($this->data);
  }
	
	function getRecords($params) {
    $rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
    
    if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
    
    $sql = $sqlRec = $sqlTot = $where = '';
    
    if( !empty($params['searchPhrase']) ) {   
      $where .=" WHERE ";
      $where .=" ( eventName LIKE '".$params['searchPhrase']."%' ";    
      $where .=" OR eventDate LIKE '".$params['searchPhrase']."%' ";

      $where .=" OR employee_age LIKE '".$params['searchPhrase']."%' )";
     }
     
     // getting total number records without any search
    $sql = "SELECT * FROM event ";
    $sqlTot .= $sql;
    $sqlRec .= $sql;
    
    //concatenate search sql if value exist
    if(isset($where) && $where != '') {

      $sqlTot .= $where;
      $sqlRec .= $where;
    }
    if ($rp!=-1)
    $sqlRec .= " LIMIT ". $start_from .",".$rp;
    
    
    $qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot event data");
    $queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch event data");
    
    while( $row = mysqli_fetch_assoc($queryRecords) ) { 
      $data[] = $row;
    }

    $json_data = array(
      "current"            => intval($params['current']), 
      "rowCount"            => 10,      
      "total"    => intval($qtot->num_rows),
      "rows"            => $data   // total data array
      );
    
    return $json_data;
  }
?>