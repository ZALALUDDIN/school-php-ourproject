<?php
    class crud{
        private $conn;

        public function __construct(){
            $this->conn=new mysqli("localhost","root","","schoolp");
        }

        public function common_select($table,$data="*",$where=false,$orderby=false,$order="ASC",$limit=false,$offset=false){
            /* init return value */
            $selectdata=$error=$msg=false;
            $numrows=0;

            $sql="select $data from $table "; // start query
            if($where && is_array($where)){
                $sql.= "where "; //select * from auth where
                foreach($where as $k=>$v){
                    $sql.= "$k='$v' and "; // get data and set query
                }
                $sql=rtrim($sql,"and "); // remove last , from query
            }

            if($orderby){
                $sql.= " order by $orderby $order";
            }
            
            if($limit){
                $sql.= " limit $limit , $offset";
            }
           
            $res=$this->conn->query($sql); // execute query
            if($res->num_rows > 0){
				$data = array();
				while($singleData = $res->fetch_object()){
					$data[] = $singleData;
				}
			
                $selectdata=$data;
                $numrows=$res->num_rows;
                $msg="data found";
            }else{
                $msg="No data found";
                $error=true;
                $numrows=$res->num_rows;
            }
        
            $return=array("msg"=>$msg,"error"=>$error,"selectdata"=>$selectdata,"numrows"=>$numrows);
            return $return;
        }

	public function common_select_single($table,$data="*",$where=false,$orderby=false,$order="ASC",$limit=false,$offset=false){
            /* init return value */
            $selectdata=$error=$msg=false;
            $numrows=0;

            $sql="select $data from $table "; // start query
            if($where && is_array($where)){
                $sql.= "where "; //select * from auth where
                foreach($where as $k=>$v){
                    $sql.= "$k='$v' and "; // get data and set query
                }
                $sql=rtrim($sql,"and "); // remove last , from query
            }

            if($orderby){
                $sql.= " order by $orderby $order";
            }
            
            if($limit){
                $sql.= " limit $limit , $offset";
            }
           
            $res=$this->conn->query($sql); // execute query
            if($res->num_rows > 0){
				while($singleData = $res->fetch_object()){
					$data = $singleData;
				}
                $selectdata=$data;
                $numrows=$res->num_rows;
                $msg="data found";
            }else{
                $msg="No data found";
                $error=$this->conn->error;
                $numrows=$res->num_rows;
            }
        
            $return=array("msg"=>$msg,"error"=>$error,"selectdata"=>$selectdata,'numrows'=>$numrows);
            return $return;
        }

        public function common_create($table,$data){
            /* init return value */
            $insert_id=$error=$msg=false;

            if(is_array($data)){ // check if data is array or not
                $sql="insert into $table set "; // start query
                foreach($data as $k=>$v){
                    $sql.= "$k='$v',"; // get data and set query
                }
                $sql=rtrim($sql,","); // remove last , from query
                $res=$this->conn->query($sql); // execute query
                if($res){ // check if query run successfully
                    $msg="Data saved";
                    $insert_id=$this->conn->insert_id;
                }else{
                    $msg="Data not saved. Please try again";
                    $error=$this->conn->error;
                }
            }else{
                $msg="Data should be sent as array";
            }
            $return=array("msg"=>$msg,"error"=>$error,"insert_id"=>$insert_id);
            return $return;
        }

        public function common_update($table,$data,$where){
            /* init return value */
            $affected_rows=$error=$msg=false;

            if(is_array($data)){ // check if data is array or not
                $sql="update $table set "; // start query
                foreach($data as $k=>$v){
                    $sql.= "$k='$v',"; // get data and set query
                }
                $sql=rtrim($sql,","); // remove last , from query

                
                $sql.= " where "; //select * from auth where
                foreach($where as $k=>$v){
                    $sql.= "$k='$v' and "; // get data and set query
                }
                $sql=rtrim($sql,"and "); // remove last , from query

                $res=$this->conn->query($sql); // execute query
                if($res){ // check if query run successfully
                    $msg="Data updated";
                    $affected_rows=$this->conn->affected_rows;
                }else{
                    $msg="Data not updated. Please try again";
                    $error=$this->conn->error;
                }
            }else{
                $msg="Data should be sent as array";
            }
            $return=array("msg"=>$msg,"error"=>$error,"affected_rows"=>$affected_rows);
            return $return;
        }

        public function common_delete($table,$where){
            /* init return value */
            $affected_rows=$error=$msg=false;

            $sql="delete from $table "; // start query

            $sql.= " where "; //select * from auth where
            foreach($where as $k=>$v){
                $sql.= "$k='$v' and "; // get data and set query
            }
            $sql=rtrim($sql,"and "); // remove last , from query

            $res=$this->conn->query($sql); // execute query
            if($res){ // check if query run successfully
                $msg="Data deleted";
                $affected_rows=$this->conn->affected_rows;
            }else{
                $msg="Data not deleted. Please try again";
                $error=$this->conn->error;
            }

            $return=array("msg"=>$msg,"error"=>$error,"affected_rows"=>$affected_rows);
            return $return;
        }

        public function custom_select($sql){
            /* init return value */
            $selectdata=$error=$msg=false;
            $numrows=0;
           
            $res=$this->conn->query($sql); // execute query
            if($res->num_rows > 0){
                $data = array();
                while($singleData = $res->fetch_object()){
                    $data[] = $singleData;
                }
                
                $selectdata=$data;
                $numrows=$res->num_rows;
                $msg="data found";
            }else{
                $msg="No data found";
                $error=$this->conn->error;
                $numrows=$res->num_rows;
            }
        
            $return=array("msg"=>$msg,"error"=>$error,"selectdata"=>$selectdata,"numrows"=>$numrows);
            return $return;
        }
    }

?>