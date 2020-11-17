<?php
include 'connect.php';

$extAPI_username = "lambo10";
$extAPI_Password = "Lambo7438_92398";
$extAPI_phone_no = "07068497582";

$mtn_pin = "1837";
$airtel_pin = "1097";
$glo_pin = "23227";
$et_9mobile_pin = "1998";



if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER) ) {
    // only a post with paystack signature header gets our attention
    exit();
}

// Retrieve the request's body
$input = @file_get_contents("php://input");
define('PAYSTACK_SECRET_KEY','sk_test_35c7a5becad95c1862310c5cccfbc85c8c6ab5c8');

if(!$_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] || ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))){
  // silently forget this ever happened
  exit();
}


http_response_code(200);

// parse event (which is json string) as object
// Do something - that will not take long - with $event
$event = json_decode($input);

switch($event->event){
    // subscription.create
    case 'subscription.create':
        break;

    // charge.success
    case 'charge.success':
        $costumer_email = $event->data->customer->email;
        $paid_amount = $event->data->amount;
        $refID = $event->data->reference;
        if(strcmp($costumer_email,"support@stevesdataonline.com") == 0){
            $splitedRef = explode("_",$refID);
            
            $serviceID = $splitedRef[1];
            $type = $splitedRef[2];
            $phoneNo = $splitedRef[3];
            $smartCard_iucNo = $splitedRef[3];
            $meterNumber = $splitedRef[3];
            $meterType = $splitedRef[4];
            $ElectricCompany = $splitedRef[5];

            if(strcmp($type,"POWER") == 0){
              buyPower($conn,"",$cost,$type,"","",$meterNumber,$extAPI_Password,$extAPI_username,$ElectricCompany,"",$extAPI_phone_no,((float)$paid_amount/100),$meterType);
            }else if(strcmp($type,"ACCUPGRADE") == 0){
              if((float)$paid_amount >= 100 && (float)$paid_amount < 500){
                UpgradeAcc($conn,"Enduser",$email);
                $prev_user_balance = getUserBalance ($conn,$costumer_email);
                if(strcmp($prev_user_balance,"null") == 0){
                }else{
                    if(updateUserBalance($conn,(((float)$paid_amount/100) + (float)$prev_user_balance),$costumer_email)){
                        insertTransaction($conn,$costumer_email,((float)$paid_amount/100),"FUND",$refID,"No","","","","");
                    }
                    pay_upline_bonus($conn,$costumer_email);
                }

              }else if((float)$paid_amount >= 500 && (float)$paid_amount < 2000){
                UpgradeAcc($conn,"Reseller",$email);
                if(strcmp($prev_user_balance,"null") == 0){
                }else{
                    if(updateUserBalance($conn,(((float)$paid_amount/100) + (float)$prev_user_balance),$costumer_email)){
                        insertTransaction($conn,$costumer_email,((float)$paid_amount/100),"FUND",$refID,"No","","","","");
                    }
                    pay_upline_bonus($conn,$costumer_email);
                }

              }else if((float)$paid_amount >= 2000){
                UpgradeAcc($conn,"Portal-Owner",$email);
                if(strcmp($prev_user_balance,"null") == 0){
                }else{
                    if(updateUserBalance($conn,(((float)$paid_amount/100) + (float)$prev_user_balance),$costumer_email)){
                        insertTransaction($conn,$costumer_email,((float)$paid_amount/100),"FUND",$refID,"No","","","","");
                    }
                    pay_upline_bonus($conn,$costumer_email);
                }
                
              }
              
            }else{
              process_data_or_airtime_or_tvSub($conn,$serviceID,$phoneNo,$extAPI_username,$extAPI_Password,$mtn_pin,$airtel_pin,$glo_pin,$et_9mobile_pin,$paid_amount,$smartCard_iucNo,$extAPI_phone_no,$paid_amount);
            }
            

        }else{
        $prev_user_balance = getUserBalance ($conn,$costumer_email);
        if(strcmp($prev_user_balance,"null") == 0){
        }else{
             if(updateUserBalance($conn,(((float)$paid_amount/100) + (float)$prev_user_balance),$costumer_email)){
                insertTransaction($conn,$costumer_email,((float)$paid_amount/100),"FUND",$refID,"No","","","","");
            }
            pay_upline_bonus($conn,$costumer_email);
        }
        }

        break;

    // subscription.disable
    case 'subscription.disable':
        break;

    // invoice.create and invoice.update
    case 'invoice.create':
    case 'invoice.update':
        break;

}

exit();

function UpgradeAcc($conn,$accType,$email){
  $updateHandle = "UPDATE users SET accType='$accType' WHERE email='$email'";
  if ($conn->query($updateHandle) === TRUE) {
      echo "11111";
  }else{
      echo "100112";
  }
}

function pay_upline_bonus($conn,$email){
    $handle2 = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='referral_bonus'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $refID = get_upline_refID($conn,$email);
            $instruction_or_data = $row["instruction_or_data"];

           if(strcmp($refID,"null")){
           }else{
            $handle3 = "SELECT commission,AccBalance FROM users WHERE referralID='$refID'";
            $result3 = $conn->query($handle3);
            if ($result3->num_rows > 0) {
                while($row = $result3->fetch_assoc()) {
                    $commission_string = $row["commission"];
                    $commission = (int)$commission_string;
                    $AccBalance = $row["AccBalance"];
                    
                    if((int)$AccBalance >= (int)$instruction_or_data){
                        $new_commission_bal = (int)$instruction_or_data + $commission;
        
                    $updateHandle = "UPDATE users SET commission='$new_commission_bal' WHERE referralID='$refID'";
                    if ($conn->query($updateHandle) === TRUE) {
                        return true;
                    }else{
                        return false;
                    }
                    }else{
                        return false;
                    }
        
                    
                }
            }
           }
         }
        
            

        }
    }

    function get_upline_refID($conn,$email){
        $handle2 = "SELECT whoReferredID FROM users WHERE email='$email' AND minimun_1k_fund='0'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            return $row["whoReferredID"];
        }
    }else{
        return "null";
    }
    }

function updateUserBalance ($conn,$accountBal,$email){
    $updateHandle = "UPDATE users SET AccBalance='$accountBal',minimun_1k_fund='1' WHERE email='$email'";
    if ($conn->query($updateHandle) === TRUE) {
        return true;
    }else{
        return false;
    }
}

function getUserBalance ($conn,$email){
    $handle2 = "SELECT AccBalance FROM users WHERE email='$email'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            return $row["AccBalance"];
        }
    }else{
        return "null";
    }
}

function insertTransaction($conn,$userEmail,$cost,$type,$refID,$autoRenew,$network,$validity,$phoneNo,$output){
    
        $sql = "INSERT INTO transactions (userEmail,cost,type,refID,network,meter_pnone_iuc_No,output)
    VALUES ('$userEmail','$cost','$type','$refID','$network','$phoneNo','$output')";
    
    if ($conn->query($sql) === TRUE) {
     }
    
}

function process_data_or_airtime_or_tvSub($conn,$serviceID,$phoneNo,$extAPI_username,$extAPI_Password,$mtn_pin,$airtel_pin,$glo_pin,$et_9mobile_pin,$airTime_amount,$smartCard_iucNo,$extAPI_phone_no,$payedAmount){
  
    $handle2 = "SELECT cost,serviceType,network,validity,extAPI_ID  FROM services WHERE id='$serviceID'";
    $result2 = $conn->query($handle2);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row = $result2->fetch_assoc()) {
            $cost = $row["cost"];
            $serviceType = $row["serviceType"];
            $network = $row["network"];
            $validity = $row["validity"];
            $plan = $row["extAPI_ID"];
            
              $profit_margin = getProfitMargin($conn,$serviceType,$network);
              $profit_margin = (float)$profit_margin;
              if($profit_margin <= -1){
                $profit_margin = 0;
              }
    
              $calculatedCost = (float)$cost + $profit_margin;

              if(strcmp($serviceType,"DATA") == 0){
               buydata($conn,"",$calculatedCost,$serviceType,"",$validity,$phoneNo,$network,$plan,$mtn_pin,$glo_pin,$airtel_pin,$et_9mobile_pin,$payedAmount);
              }else if(strcmp($serviceType,"AIRTIME") == 0){
                buyAirtime($conn,"",$calculatedCost,$serviceType,"","",$phoneNo,$network,(((float)$airTime_amount/100)-$profit_margin),$mtn_pin,$glo_pin,$airtel_pin,$et_9mobile_pin);
              }else if(strcmp($serviceType,"TVSUB") == 0){
                tv_sub($conn,"",$calculatedCost,$serviceType,"",$validity,$smartCard_iucNo,$extAPI_Password,$extAPI_username,$network,$plan,$extAPI_phone_no,$payedAmount);
              }
            
        }
    }else{
        echo "100111";
    }

}

function buyPower($conn,$email,$cost,$serviceType,$autoRenew,$validity,$meterNumber,$extAPI_Password,$extAPI_username,$ElectricCompany,$plan,$extAPI_phone_no,$payedAmount,$meterType){

  if(((float)$payedAmount/100) >= (float)$cost){
    $url = 'https://vtu.ng/wp-json/api/v1/electricity?username='.$extAPI_username.'&password='.$extAPI_Password.'&phone='.$extAPI_phone_no.'&meter_number='.$meterNumber.'&service_id='.$ElectricCompany.'&variation_id='.$meterType.'&amount='.$payedAmount;
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $apiResponse = curl_exec($ch);
   
    curl_close($ch);
    
    $dec_jsonAPI_response = json_decode($apiResponse,true);
    $raw_result = $dec_jsonAPI_response["data"];
    $refID = $raw_result["order_id"];
    $output = "";
    if(strcmp($dec_jsonAPI_response["code"],"success") == 0){
        insertTransaction($conn,$email,$cost,$serviceType,$autoRenew,$ElectricCompany,$validity,$meterNumber,$refID,$output);
    }else{
        echo "100111";
    }
  }else{
    echo "100111";
}
}

function tv_sub($conn,$email,$cost,$serviceType,$autoRenew,$validity,$smartCard_iucNo,$extAPI_Password,$extAPI_username,$network,$plan,$extAPI_phone_no,$payedAmount){

  if(((float)$payedAmount/100) >= (float)$cost){
    $url = 'https://vtu.ng/wp-json/api/v1/tv?username='.$extAPI_username.'&password='.$extAPI_Password.'&phone='.$extAPI_phone_no.'&service_id='.$network.'&smartcard_number='.$smartCard_iucNo.'&variation_id='.$plan;
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $apiResponse = curl_exec($ch);
   
    curl_close($ch);
    
    $dec_jsonAPI_response = json_decode($apiResponse,true);
    $raw_result = $dec_jsonAPI_response["data"];
    $refID = $raw_result["order_id"];
    $output = "";
    if(strcmp($dec_jsonAPI_response["code"],"success") == 0){
        insertTransaction($conn,$email,$cost,$serviceType,$autoRenew,$network,$validity,$smartCard_iucNo,$refID,$output);
    }else{
        echo "100111";
    }
  }else{
    echo "100111";
}
}

function buydata($conn,$email,$cost,$serviceType,$autoRenew,$validity,$phoneNo,$network,$plan,$mtn_pin,$glo_pin,$airtel_pin,$et_9mobile_pin,$payedAmount){
  
  if(((float)$payedAmount/100) >= (float)$cost){

  $refID = genarateToken(8);
  $ussd_string = "";
 
  if(strcmp($plan,"1GB 1 Day") == 0 && strcmp($network,"9MOBILE")==0){
    
    $ussd_string = "*200*3*5*1*4*1*1*".$phoneNo."#";

  }else if(strcmp($plan,"2GB 1 Day") == 0 && strcmp($network,"9MOBILE")==0){
  
    $ussd_string = "*200*3*5*1*5*1*1*".$phoneNo."#";

  }else if(strcmp($plan,"7GB 7 Days") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*2*".$phoneNo."#";

  }else if(strcmp($plan,"500MB") == 0 && strcmp($network,"9MOBILE")==0){
    
    $ussd_string = "*229*2*12*".$phoneNo."#";

  }else if(strcmp($plan,"1.5GB") == 0 && strcmp($network,"9MOBILE")==0){
  
    $ussd_string = "*229*2*7*".$phoneNo."#";

  }else if(strcmp($plan,"2GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*25*".$phoneNo."#";

  }else if(strcmp($plan,"3GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*3*".$phoneNo."#";

  }else if(strcmp($plan,"4.5GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*8*".$phoneNo."#";

  }else if(strcmp($plan,"11GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*36*".$phoneNo."#";

  }else if(strcmp($plan,"15GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*36*".$phoneNo."#";

  }else if(strcmp($plan,"40GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*4*1*".$phoneNo."#";

  }else if(strcmp($plan,"75GB") == 0 && strcmp($network,"9MOBILE")==0){

    $ussd_string = "*229*2*4*".$phoneNo."#";

  }

  else if(strcmp($plan,"1.35GB (800MB + 550MB night)") == 0 && strcmp($network,"GLO")==0){

    $ussd_string = "*127*57*".$phoneNo."#";
    
    } else if(strcmp($plan,"2.9GB (1.9GB + 1GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*53*".$phoneNo."#";
    
    }else if(strcmp($plan,"4.1GB(3.5GB+600MB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*53*".$phoneNo."#";
    
    }else if(strcmp($plan,"5.8GB (5.2GB + 600MB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*55*".$phoneNo."#";
    
    }else if(strcmp($plan,"7.7GB (6.8GB + 750MB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*58*".$phoneNo."#";
    
    }else if(strcmp($plan,"10GB (9GB + 1GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*54*".$phoneNo."#";
    
    }else if(strcmp($plan,"13.25GB (12.25GB + 1GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*59*".$phoneNo."#";
    
    }else if(strcmp($plan,"18.25GB (177GB + 1.25GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*2*".$phoneNo."#";
    
    }else if(strcmp($plan,"29.5GB (27.5GB + 2GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*1*".$phoneNo."#";
    
    }else if(strcmp($plan,"50GB (46GB + 4GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*11*".$phoneNo."#";
    
    }else if(strcmp($plan,"93GB (86GB + 7GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*12*".$phoneNo."#";
    
    }else if(strcmp($plan,"119GB (109GB + 10GB night)") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*13*".$phoneNo."#";
    
    }else if(strcmp($plan,"138GB (126GB + 12GB night) ") == 0 && strcmp($network,"GLO")==0){
    
    $ussd_string = "*127*33*".$phoneNo."#";
    
    }

  else if(strcmp($plan,"2.5gb-N450/2 Days") == 0 && strcmp($network,"MTN")==0){
    $ussd_string = "131-7-2-5-".$phoneNo;

  }else if(strcmp($plan,"1GB-N300/1 Day") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "131-7-2-4-".$phoneNo;

  }else if(strcmp($plan,"1GB-N450/1 Week") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "131-7-2-2-3-".$phoneNo;

  }else if(strcmp($plan,"6GB-N1350/1 Week") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "461-3-3-".$phoneNo."-".$mtn_pin."";

  }
  
  else if(strcmp($plan,"500MB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "SMEB ".$phoneNo." 500 ".$mtn_pin;

  }else if(strcmp($plan,"1GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "SMEC ".$phoneNo." 1000 ".$mtn_pin;

  }else if(strcmp($plan,"2GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "SMED ".$phoneNo." 2000 ".$mtn_pin;

  }else if(strcmp($plan,"5GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "SME ".$phoneNo." 5000 ".$mtn_pin;

  }
  
  else if(strcmp($plan,"4.5GB") == 0 && strcmp($network,"MTN")==0){
    
    $ussd_string = "3-3-".$phoneNo."";

  }else if(strcmp($plan,"6GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "3-4-".$phoneNo."";

  }else if(strcmp($plan,"10GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "3-5-".$phoneNo."";

  }else if(strcmp($plan,"15GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "3-6-".$phoneNo."";

  }else if(strcmp($plan,"40GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "3-7-".$phoneNo."";

  }else if(strcmp($plan,"75GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "3-8-".$phoneNo."";

  }else if(strcmp($plan,"110GB") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "99-9-".$phoneNo."";

  }else if(strcmp($plan,"2gb -N450 /2 Days") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "1-5-".$phoneNo."";

  }else if(strcmp($plan,"1gb-N300/1day") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "1-4-".$phoneNo."";

  }else if(strcmp($plan,"1gb-N450/1week") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "2-3-".$phoneNo."";

  }else if(strcmp($plan,"6gb-N1350/ 1 week") == 0 && strcmp($network,"MTN")==0){

    $ussd_string = "2-4-".$phoneNo."";

  }

  else if(strcmp($plan,"1.5GB") == 0 && strcmp($network,"AIRTEL")==0){

    $ussd_string = "1-7-".$phoneNo."-".$airtel_pin;
    
    } else if(strcmp($plan,"2GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "1-6-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"3GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "1-5-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"4.5GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "1-4-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"6GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "1-3-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"8GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "1-2-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"11GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "1-1-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"15GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "4-4-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"40GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "4-3-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"75GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "4-2-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"120GB") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "4-1-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"6GB/1 WEEK") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "2-1-".$phoneNo."-".$airtel_pin;
    
    }else if(strcmp($plan,"750mb/1 WEEK") == 0 && strcmp($network,"AIRTEL")==0){
    
    $ussd_string = "2-3-".$phoneNo."-".$airtel_pin;
    
    }
    


  $sql = "INSERT INTO data_airtime_purchase_bucket (userEmail,type,network,phone,refID,sms_usd_string)
  VALUES ('$email','$serviceType','$network','$phoneNo','$refID','$ussd_string')";
  
  if ($conn->query($sql) === TRUE) {
      
    $output = "";
      insertTransaction($conn,$email,$cost,$serviceType,$refID,$autoRenew,$network,$validity,$phoneNo,$output);

    }else{
        echo "100111";
    }

}else{
  echo "100111";
}
}

function buyAirtime($conn,$email,$cost,$serviceType,$autoRenew,$validity,$phoneNo,$network,$plan,$mtn_pin,$glo_pin,$airtel_pin,$et_9mobile_pin){
  
  $refID = genarateToken(8);
  $sms_string = "";
  
  if(strcmp($network,"AIRTEL")==0){
    $sms_string = "605-2-1-".$phoneNo."-".$plan."-".$airtel_pin;
  }if(strcmp($network,"MTN")==0){
    $sms_string = "Transfer ".$phoneNo." ".$plan." ".$mtn_pin;
  }else if(strcmp($network,"9MOBILE")==0){
    $sms_string = "223*".$et_9mobile_pin."*".$plan."*".$phoneNo;
  }else if(strcmp($network,"GLO")==0){
    $sms_string = "202-2-".$phoneNo."-".$plan."-".$glo_pin."-1";
  }

  $sql = "INSERT INTO data_airtime_purchase_bucket (userEmail,type,network,phone,refID,sms_usd_string)
  VALUES ('$email','$serviceType','$network','$phoneNo','$refID','$sms_string')";
  
  if ($conn->query($sql) === TRUE) {
      
    $output = "";
      insertTransaction($conn,$email,$cost,$serviceType,$autoRenew,$network,$validity,$phoneNo,$refID,$output);

    }else{
        echo "100111";
    }

}

function getProfitMargin($conn,$serviceType,$networkProvider){
    $handle2 = "SELECT profit FROM profits WHERE serviceType='$serviceType' AND network='$networkProvider'";
$result2 = $conn->query($handle2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $profit = $row["profit"];
        return (float)$profit;
    }
    
}else{
    return -1;
}
}

function genarateToken($len = 32){
    return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }

?>