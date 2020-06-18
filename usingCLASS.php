<?php
require ('ConditionClass.php');
if(isset($_POST['datapack'])){
    $data = $_POST['datapack'];
    $useCLASS = new ConditionClass();
    if($useCLASS->checkRegisterCondition($data['username'],$data['password']) == true){
        echo 0;
    }else{
        echo 1;
    }
}elseif (isset($_POST['datalogin'])){
    $data = $_POST['datalogin'];
    $useCLASS = new ConditionClass();
    if($useCLASS->checkLoginCondition($data['username'],$data['password']) == 0){
        echo 0;
    }else{
        echo $useCLASS->checkLoginCondition($data['username'],$data['password']);
    }

}else{
    echo 5;
}