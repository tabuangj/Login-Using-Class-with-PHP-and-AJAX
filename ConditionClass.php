<?php
require ('MasterClass.php');
class ConditionClass extends MasterClass
{
    public function checkRegisterCondition($username,$password){
        $connection =  $this->connectionDB();
        $dataToInsert = array(
            'username'=>$username,
            'password'=>$password,
            'connection'=>$connection
        );
        $resultUserNameCheck = $this->checkUserName($username);
        if($resultUserNameCheck['result'] == true){
            $resultOfInsert = $this->insertDataRegister($dataToInsert);
            if($resultOfInsert == true){
                $dataBo = true;
            }else{
                $dataBo = false;
            }
        }else{
            $dataBo = false;
        }
        return $dataBo;
    }
    private function insertDataRegister($data){
        if($data['username'] != '' && $data['password'] != ''){
            $sql = "INSERT INTO member (username,password)VALUE ('".$data['username']."','".$data['password']."')";
            $connection = $data['connection'];
            $resultSQL = $connection->query($sql);
            if($resultSQL == true){
                $dataTextINSERT = true;
            }else{
                $dataTextINSERT = false;
            }
        }else{
            $dataTextINSERT = false;
        }
        return $dataTextINSERT;
    }
    private function checkUserName($username){
        $sql = "SELECT * FROM member WHERE username = '".$username."'";
        $sqlResult = $this->connectionDB()->query($sql);
        if($sqlResult->num_rows == 0){
            $dataCheck = array(
                'result'=>true
            );
        }else{
            $dataCheck = array(
                'result'=>false,
                'data'=>$sqlResult
            );
        }
        return $dataCheck;
    }

    public function checkLoginCondition($username,$password){
        $condition = $this->checkUserName($username);
        if($condition['result'] == true){
            $dataResult = 1;
        }else{
            foreach ($condition['data'] as $item){
                $queryPass = $item['password'];
            }
            if($queryPass == $password){
                $dataResult = 0;
            }else{
                $dataResult = 2;
            }
        }
        return $dataResult;
    }

}