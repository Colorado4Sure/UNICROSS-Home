<?php
 require '../../main/classes/user.class.php';

   $action = $_GET['action'];
	
   if($action == 'redeem'){
        if(empty($_POST['gift_pin'])){
            echo json_encode(['status' => 'false', 'msg' => 'Gift Pin Is Required']);
        }
        else{
            $app->RedeemGiftPin($_POST['user_id'], $_POST['gift_pin']);
        }
   }

   if($action == 'buy'){
        if(empty($_POST['gift_amount'])){
            echo json_encode(['status' => 'false', 'msg' => 'Amount Must Greater Than 0.00']);
        }
        else if($_POST['gift_amount'] > $_POST['user_balance']){
            echo json_encode(['status' => 'false', 'msg' => 'Insufficient Funds']);
        }
        else{
            $app->BuyGiftPin($_POST['gift_amount'], $_POST['user_id']);
        }
   }
   