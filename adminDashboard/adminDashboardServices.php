<?php
include '../api/connect.php';
session_start();
$email = $_SESSION["email"];
if(verifyAdmin($conn,$email) <= 0){
    header("location: ./adminLogin.php");
}
function verifyAdmin($conn,$email){
    $handle2 = "SELECT email  FROM admin_users WHERE email='$email'";
    $result2 = $conn->query($handle2);
    $exisit=0;
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
         $big4 = $row["email"];
         
        if($email==$big4){
        $exisit = $exisit+1;
        }
        }
    }
    return $exisit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="theme-color" content="#3ed2a7">
	
	<link rel="shortcut icon" href="./favicon.png" />
	
	<title>smartvtu</title>

	<link rel="stylesheet" href="https://use.typekit.net/scc6wwx.css">
	<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="assets/vendors/liquid-icon/liquid-icon.min.css" />
	<link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="assets/css/theme-vendors.min.css" />
	<link rel="stylesheet" href="assets/css/theme.min.css" />
	<link rel="stylesheet" href="assets/css/themes/seo.css" />
	<link rel="stylesheet" href="css/jBox.all.min.css" />
    <link rel="stylesheet" href="css/nl_addition.css" />
    <link href="css/footable.standalone.min.css" rel="stylesheet">
	
	<!-- Head Libs -->
    <script async src="assets/vendors/modernizr.min.js"></script>
    
    <style>
		.btn > span {display: -webkit-inline-box;display: inline-flex;padding: 0px;border-radius: inherit;border-color: inherit;-webkit-box-orient: horizontal;-webkit-box-direction: normal;flex-flow: row wrap;-webkit-box-align: center;align-items: center;}
	</style>
	
</head>
<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-align="left" data-mobile-nav-style="modern" data-mobile-nav-shceme="gray" data-mobile-header-scheme="gray" data-mobile-nav-breakpoint="1199">
	
	<div id="wrap">
	<div class="titlebar scheme-light" data-parallax="true" data-parallax-options='{ "parallaxBG": true }' style="background-color:var(--color-primary)">
			
		<?php
		include 'adminDashboardHeader.php'
		?>

<br><br>

			<div class="titlebar-inner py-0 mt-0" >
				<div class="container titlebar-container">
					<div class="row titlebar-container" style="padding-left: 20px; padding-right: 20px;">

						<div class="titlebar-col col-md-12 bg-white pt-10 bg-white box-shadow-1">
							<div class="row">

								<div class="col-md-2 col-md-offset-1">
									<h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">NEW SERVICE</h6>
								</div><!-- /.col-md-2 -->


							</div><!-- /.row -->
						</div><!-- /.col-md-12 -->

					</div><!-- /.titlebar-row -->
				</div><!-- /.titlebar-container -->
			</div><!-- /.titlebar-inner -->
			
		</div><!-- /.titlebar -->
	
		
		<main id="content" class="content">
					
			<section class="vc_row pb-50 bg-cover bg-center" style="background: rgb(228, 228, 240);">
				
				<div class="container">
					<div class="row" style="padding-left: 20px; padding-right: 20px;">
						
						<div class="lqd-column col-md-12 px-4 pb-30 bg-white box-shadow-1">
							
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-40 pb-40">

                            <div class="contact-form contact-form-button-block font-size-14">
									<form novalidate="novalidate">

                                        <div class="row d-flex flex-wrap">
                                            <div class="lqd-column col-md-6 mb-20">
											<select id="netWorkSelection" class="bg-gray text-dark mb-30" aria-required="true" aria-invalid="false" >
                                                <option>-Select Network Provider-</option>
                                                <?php 
                                                $handle2 = "SELECT name,status FROM networks";
                                                $result2 = $conn->query($handle2);
                                                if ($result2->num_rows > 0) {
                                                    while($row = $result2->fetch_assoc()) {
                                                        $status = $row["status"];
                                                        if((int)$status == 1){
                                                            echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                                        }
                                                    }
                                                }
                                                ?>
											</select>
                                                <input class="bg-gray text-dark mb-30" id="type" type="text" name="type" aria-required="true" aria-invalid="false" placeholder="TYPE" required>
                                                <input id="cost" class="bg-gray text-dark mb-30" type="number" name="cost" aria-required="true" aria-invalid="false" placeholder="COST" required>
                                                <input id="slashPrice" class="bg-gray text-dark mb-30" type="number" name="cost" aria-required="true" aria-invalid="false" placeholder="SLASH PRICE" required>
                                                
                                            </div><!-- /.col-md-6 -->
                                            <div class="lqd-column col-md-6 mb-20">
											<input id="validity" class="bg-gray text-dark mb-30" type="text" name="validity" aria-required="true" aria-invalid="false" placeholder="VALIDITY" required>
                                                <input id="extAPI_ID" class="bg-gray text-dark mb-30" type="text" name="extAPI_ID" aria-required="true" aria-invalid="false" placeholder="EXT API ID" required>
                                               <select id="serviceType" class="bg-gray text-dark mb-30" aria-required="true" aria-invalid="false" >
												<option>-Service Type-</option>
												<option value="DATA">DATA</option>
                                                <option value="AIRTIME">AIRTIME</option>
                                                <option value="TVSUB">TVSUB</option>
												<option value="POWER">POWER</option>
											</select>
                                            </div><!-- /.col-md-12 -->
											<input type="text" id="sericeID" style="display: none;" />
                                            <div class="lqd-column text-md-right" style="width: 100%;">
											<button id="submitBTN" class="lamboSubmitBTN" style="cursor: pointer;" onclick="$.fn.submit_data()" type="button"><span id="submitBtnTxt">SAVE </span><img id="submitBTNLoaderImg" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
                                            </div><!-- /.col-md-6 -->

                                        </div><!-- /.row -->
                                        
									</form>
									<div class="contact-form-result hidden"></div><!-- /.contact-form-result -->
								</div><!-- /.contact-form -->

							</div><!-- /.lqd-column-inner -->

						</div><!-- /.lqd-column col-md-5 col-md-offset-7 -->

                    </div><!-- /.row -->
                    <br><br>
                    <div class="row" style="padding-left: 20px; padding-right: 20px;">
						
						<div class="lqd-column col-md-12 px-4 pb-30 bg-white box-shadow-1">
                        
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-10 pb-40">
                            <div><h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">SERVICES</h6></div><br>
                            <div class="row">
                            <div class="col-md-12">
                                            <table id="added_services" class="table" data-show-toggle="false" data-paging="true" data-sorting="true" data-filtering="true" data-paging-size="5">
								</table>
                                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <br><br>
                    <div class="row" style="padding-left: 20px; padding-right: 20px;">
						
						<div class="lqd-column col-md-12 px-4 pb-30 bg-white box-shadow-1">
                        
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-10 pb-40">
                            <div><h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">ACTIVE NETWORKS</h6></div><br>
                            <div class="row">
                                <?php
                                function create_network_options($conn){
                                    $handle2 = "SELECT name,status FROM networks";
                                    $result2 = $conn->query($handle2);
                                    if ($result2->num_rows > 0) {
                                        while($row = $result2->fetch_assoc()) {
                                            $status = $row["status"];
                                            if((int)$status == 1){
                                                echo '<span class="col-md-3"><input type="checkbox" id="'.$row["name"].'" value="'.$row["name"].'" name="network" checked><span> '.$row["name"].'</span></span>';
                                            }else{
                                                echo '<span class="col-md-3"><input type="checkbox" id="'.$row["name"].'" value="'.$row["name"].'" name="network" ><span> '.$row["name"].'</span></span>';
                                            }
                                        }
                                    }else{
                                        echo '<span class="col-md-3"><input type="checkbox" id="MTN" value="MTN" name="network" checked><span> MTN</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="GLO" value="GLO" name="network" checked><span> GLO</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="AIRTEL" value="AIRTEL" name="network" checked><span> AIRTEL</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="9MOBILE" value="9MOBILE" name="network" checked><span> 9MOBILE</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="DSTV" value="DSTV" name="network" checked><span> DSTV</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="GOTV" value="GOTV" name="network" checked><span> GOTV</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="StarTimes" value="StarTimes" name="network" checked><span> StarTimes</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="EKED" value="EKED" name="network" checked><span> EKED</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="IKEDC" value="IKEDC" name="network" checked><span> IKEDC</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="AEDC" value="AEDC" name="network" checked><span> AEDC</span></span>
                                        <span class="col-md-3"><input type="checkbox" id="IBEDC" value="IBEDC" name="network" checked><span> IBEDC</span></span>';
                                    }
                                }
                                create_network_options($conn);
                                ?>
                                     </div>

                            </div>
                            <div class="lqd-column text-md-right">
											<button id="submitBTN2" class="lamboSubmitBTN" style="cursor: pointer;" onclick="$.fn.save_activeNetwork()" type="button"><span id="submitBtnTxt2">SAVE </span><img id="submitBTNLoaderImg2" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
                                            </div><!-- /.col-md-6 -->
                        </div>
                    </div>
                    <br><br>
                    <div class="row" style="padding-left: 20px; padding-right: 20px;">
						
						<div class="lqd-column col-md-12 px-4 pb-30 bg-white box-shadow-1">
                        
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-10 pb-40">
                            <div><h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">ACCOUNT TYPE PERCENTAGE DISCOUNT</h6></div><br>
                            <div class="row">
                            
                                
                            <div class="contact-form contact-form-button-block font-size-14">
									<form novalidate="novalidate">

                                        <div class="row d-flex flex-wrap">
                                            <div class="lqd-column col-md-12 mb-20">
                                                <div class="font-size-14 font-weight-medium ltr-sp-2">Enduser</div>
                                                <input class="bg-gray text-dark mb-30" id="enduser_acc_t_p" type="number" name="type" aria-required="true" aria-invalid="false" value="<?php $handle2 = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='endUser'";
                                                                                                                                                                                                $result2 = $conn->query($handle2);
                                                                                                                                                                                                $dbData = array();
                                                                                                                                                                                                if ($result2->num_rows > 0) {
                                                                                                                                                                                                    while($row = $result2->fetch_assoc()) {
                                                                                                                                                                                                        echo $row["instruction_or_data"];
                                                                                                                                                                                                    }
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>" required>
                                                <div class="font-size-14 font-weight-medium ltr-sp-2">Reseller</div>
                                                <input id="reseller_acc_t_p" class="bg-gray text-dark mb-30" type="number" name="cost" aria-required="true" aria-invalid="false" value="<?php $handle2 = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='reseller'";
                                                                                                                                                                                                $result2 = $conn->query($handle2);
                                                                                                                                                                                                $dbData = array();
                                                                                                                                                                                                if ($result2->num_rows > 0) {
                                                                                                                                                                                                    while($row = $result2->fetch_assoc()) {
                                                                                                                                                                                                        echo $row["instruction_or_data"];
                                                                                                                                                                                                    }
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>" required>

<div class="font-size-14 font-weight-medium ltr-sp-2">Portal-Owner</div>
                                                <input id="portalOwner_acc_t_p" class="bg-gray text-dark mb-30" type="number" name="cost" aria-required="true" aria-invalid="false" value="<?php $handle2 = "SELECT instruction_or_data FROM site_operation_var WHERE operation_name='Portal-Owner'";
                                                                                                                                                                                                $result2 = $conn->query($handle2);
                                                                                                                                                                                                $dbData = array();
                                                                                                                                                                                                if ($result2->num_rows > 0) {
                                                                                                                                                                                                    while($row = $result2->fetch_assoc()) {
                                                                                                                                                                                                        echo $row["instruction_or_data"];
                                                                                                                                                                                                    }
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>" required>

                                                <!-- <div class="font-size-14 font-weight-medium ltr-sp-2">Portal-Owner</div>
                                                <input id="" class="bg-gray text-dark mb-30" type="number" name="cost" aria-required="true" aria-invalid="false" value="12" required> -->

                                            </div><!-- /.col-md-6 -->
                                            <div class="lqd-column text-md-right" style="width: 100%;">
											<button id="submitBTN4" class="lamboSubmitBTN" style="cursor: pointer;" onclick="$.fn.save_acc_t_pd()" type="button"><span id="submitBtnTxt4">SAVE </span><img id="submitBTNLoaderImg4" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
                                            </div><!-- /.col-md-6 -->

                                        </div><!-- /.row -->
                                        
									</form>
									<div class="contact-form-result hidden"></div><!-- /.contact-form-result -->
								</div><!-- /.contact-form -->

                                     </div>

                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row" style="padding-left: 20px; padding-right: 20px;">
						
						<div class="lqd-column col-md-12 px-4 pb-30 bg-white box-shadow-1">
                        
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-10 pb-40">
                            <div><h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">Profit Margins</h6></div><br>
                            <div class="row">
                                <div>
                                <table id="profitsMargin" class="table" data-show-toggle="false" data-paging="true" data-sorting="true" data-filtering="true" data-paging-size="5">
								</table>
                                
                                </div>
                                <br>
                            <div class="contact-form contact-form-button-block font-size-14">
									<form novalidate="novalidate">

                                        <div class="row d-flex flex-wrap">
                                         <div class="lqd-column col-md-12 mb-20">
                                         <div><h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">NEW PROFIT MARGIN</h6></div><br>
                                         <select id="profitMargin_netWorkSelection" class="bg-gray text-dark mb-30" aria-required="true" aria-invalid="false" >
                                                <option>-Select Network Provider-</option>
                                                <?php 
                                                $handle2 = "SELECT name,status FROM networks";
                                                $result2 = $conn->query($handle2);
                                                if ($result2->num_rows > 0) {
                                                    while($row = $result2->fetch_assoc()) {
                                                        $status = $row["status"];
                                                        if((int)$status == 1){
                                                            echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <select id="profitMargin_serviceType" class="bg-gray text-dark mb-30" aria-required="true" aria-invalid="false" >
												<option>-Service Type-</option>
												<option value="DATA">DATA</option>
                                                <option value="AIRTIME">AIRTIME</option>
                                                <option value="TVSUB">TVSUB</option>
												<option value="POWER">POWER</option>
											</select>
                                                <input id="profitMargin_cost" class="bg-gray text-dark mb-30" type="number" name="cost" aria-required="true" aria-invalid="false" placeholder="PROFIT" required>  
                                            </div><!-- /.col-md-12 -->
                                            <div class="lqd-column text-md-right" style="width: 100%;">
											<button id="submitBTN3" class="lamboSubmitBTN" style="cursor: pointer;" onclick="$.fn.save_profitMargin()" type="button"><span id="submitBtnTxt3">SAVE </span><img id="submitBTNLoaderImg3" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
                                            </div><!-- /.col-md-6 -->
                                        </div><!-- /.row -->
									</form>
									<div class="contact-form-result hidden"></div><!-- /.contact-form-result -->
								</div><!-- /.contact-form -->

                            
                            </div>
                            </div>
                        </div>
                    </div>
				</div><!-- /.container -->
            </section>
            
			
		</main><!-- /#content.content -->
		
		<?php
        include 'footer.php';
        ?>
	
</div><!-- /#wrap -->

<script src="js/jquery.min.js"></script>
<script src="js/jbox.all.min.js"></script>
<script src="js/footable.min.js" type="text/javascript"></script>
<script src="js/generalOp.js"></script>
<script src="./assets/js/theme-vendors.js"></script>
<script src="./assets/js/theme.min.js"></script>
<script src="./assets/js/liquidAjaxMailchimp.min.js"></script>
<script>
    $.fn.save_acc_t_pd = function(){
		dispSubmitBtnLoader4();
			var enduser_acc_t_p = $("#enduser_acc_t_p").val();
			var reseller_acc_t_p = $("#reseller_acc_t_p").val();
            var portalOwner_acc_t_p = $("#portalOwner_acc_t_p").val();
            $.post( "../api/process_insert_site_operation_var.php",{
                    operation_name: "Enduser",
                    instruction_or_data: enduser_acc_t_p
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Saved EndUser Discount Successfully","green");
                clearSubmitBtnLoader4();
                $("#enduser_acc_t_p").val(enduser_acc_t_p);
            }else{
                $.fn.notification("Erro Saving EndUser Discount","red");
                clearSubmitBtnLoader4();
            }
            });

            $.post( "../api/process_insert_site_operation_var.php",{
                operation_name: "Reseller",
                instruction_or_data: reseller_acc_t_p
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Saved Reseller Discount Successfully","green");
                clearSubmitBtnLoader4();
                $("#reseller_acc_t_p").val(reseller_acc_t_p);
            }else{
                $.fn.notification("Erro Saving Reseller Discount","red");
                clearSubmitBtnLoader4();
            }
            });

            $.post( "../api/process_insert_site_operation_var.php",{
                operation_name: "Portal-Owner",
                instruction_or_data: portalOwner_acc_t_p
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Saved Portal-Owner Discount Successfully","green");
                clearSubmitBtnLoader4();
                $("#portalOwner_acc_t_p").val(portalOwner_acc_t_p);
            }else{
                $.fn.notification("Erro Saving Portal-Owner Discount","red");
                clearSubmitBtnLoader4();
            }
            });

    }

        $.fn.delete_services = function(id){
            $.get( "../api/admin_delete_service.php",{
                id:id
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Deleted Successfully","green");
                $.fn.get_added_services();
			}else if(data === "100111"){
				$.fn.notification("Erro Deleting service","red");
			}else if(data === "100112"){
				$.fn.notification("Access Denied","red");
			}
			});
       
    }
    $.fn.delete_profit_margin = function(id){
            $.get( "../api/admin_delete_profit_margin.php",{
                id:id
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Deleted Successfully","green");
                $.fn.get_profits_margin();
			}else if(data === "100111"){
				$.fn.notification("Erro Deleting service","red");
			}else if(data === "100112"){
				$.fn.notification("Access Denied","red");
			}
			});
       
    }
    $.fn.save_profitMargin = function(){
        dispSubmitBtnLoader3();
        var netWorkSelection = $("#profitMargin_netWorkSelection").val();
			var serviceType = $("#profitMargin_serviceType").val();
            var cost = $("#profitMargin_cost").val();
            if(netWorkSelection === "-Select Network Provider-"){
                $.fn.confirm("Pls select -Network Provider-","red",function(){});
                clearSubmitBtnLoader3();
            }else if(serviceType === "-Service Type-"){
                $.fn.confirm("Pls select -Service Type-","red",function(){});
                clearSubmitBtnLoader3();
            }else if(cost.length <= 0){
                $.fn.confirm("Enter cost","red",function(){});
                clearSubmitBtnLoader3();
            }else{
                $.post( "../api/process_insertNewProfitMargin.php",{
                    network: netWorkSelection,
                    serviceType: serviceType,
                    profit: cost
				
			}, function( data ) {
			if(data === "11111"){
				$.fn.notification("Saved Successfully","green");
                clearSubmitBtnLoader3();
                $.fn.get_profits_margin();
			}else if(data === "100111"){
				$.fn.notification("Erro saving network","red");
				clearSubmitBtnLoader3();
			}else if(data === "100112"){
				$.fn.notification("Access Denied","red");
				clearSubmitBtnLoader3();
			}
			});
            }
       
    }
    $.fn.save_activeNetwork = function(){
        var active_network = "[";
            $.each($("input[name='network']:checked"), function(){
                active_network = active_network + '"'+$(this).val()+'",';
            });
            active_network = active_network + '""]';
            dispSubmitBtnLoader2();
            $.post( "../api/process_activate_networks.php",{
                    networks: active_network
				
			}, function( data ) {
			if(data === "11111"){
				$.fn.notification("Saved Successfully","green");
                location.reload();
			}else if(data === "100111"){
				$.fn.notification("Erro saving network","red");
				clearSubmitBtnLoader2();
			}else if(data === "100112"){
				$.fn.notification("Access Denied","red");
				clearSubmitBtnLoader2();
			}
			});
    }
    $.fn.submit_data = function(){
		dispSubmitBtnLoader();
            var netWorkSelection = $("#netWorkSelection").val();
			var type = $("#type").val();
			var cost = $("#cost").val();
            var validity = $("#validity").val();
            var extAPI_ID = $("#extAPI_ID").val();
			var serviceType = $("#serviceType").val();
            var slashPrice = $("#slashPrice").val();
				
				$.post( "../api/process_insertNewService.php",{
                    network: netWorkSelection,
                    cost: cost,
                    slashPrice: slashPrice,
                    type: type,
                    validity: validity,
                    extAPI_ID: extAPI_ID,
                    serviceType: serviceType
				
			}, function( data ) {
			if(data === "100111"){
				$.fn.notification("Erro saving service","red");
				clearSubmitBtnLoader();
			}else if(data === "100112"){
				$.fn.notification("Access Denied","red");
				clearSubmitBtnLoader();
			}else{
				$.fn.notification("Saved Successfully","green");
                clearSubmitBtnLoader();
                $.fn.get_added_services();
                window.location = "photo_upload.php?serviceID="+data;
			}
			});
         
         }

    $.fn.get_profits_margin = function(){ 
		var resultJson = null;
	$.get('../api/admin_get_profits_margin.php',{},function(result){
		resultJson = JSON.parse(result);
		$('#profitsMargin').footable({
                          "columns": $.get('../json/admin_profitsMargin.json'),
                          "rows": resultJson
						});
						
	});
    }
    $.fn.get_profits_margin();
         
     $.fn.get_added_services = function(){ 
		var resultJson = null;
	$.get('../api/admin_get_added_services.php',{},function(result){
		resultJson = JSON.parse(result);
		$('#added_services').footable({
                          "columns": $.get('../json/admin_added_services.json'),
                          "rows": resultJson
						});
						
	});
    }
    $.fn.get_added_services();


    $("#added_services").on("click","td:not(.footable-first-column)",function(e){
    var row=$( this ).parent();
    if(!row.hasClass('footable-paging')){
      var collected_id = row.closest('tr').children('td:first').text();
	  
	  $.get('../api/admin_get_single_service.php',{
		  id:collected_id
	  },function(result){
		var resultJson_array = JSON.parse(result);
		var resultJson = resultJson_array[0];
		
		var confirm_remove = new jBox('Confirm', {
        confirmButton:"OK",
        cancelButton:"CANCEL",
        content:`<div style='font-size:18px; text-align:left' class='row'>
        <div>Click ok if you want to delete this record</div><br>
		<div class='col-md-5'>Network: `+resultJson.network+` </div><div class='col-md-5'>Service Type: `+resultJson.serviceType+` </div>
		<div class='col-md-5'>Type: `+resultJson.type+`</div><div class='col-md-5'>Cost: `+resultJson.cost+`</div>
		<div class='col-md-5'>Validity: `+resultJson.validity+`</div><div class='col-md-5'>Date: `+resultJson.date+`</div>
        <div class='col-md-5'><div><img style='width:80px;height:50px' alt="No Image" src='../api/uploads/service_pics/`+collected_id+`/post_pic.jpg?ref=`+Math.floor(Math.random()*90000) + 10000+`'></div>
        <div><a href="photo_upload.php?serviceID=`+collected_id+`";><div style='padding: 5px; background:#003879; color:white; text-align:left; cursor:pointer; font-size:13px; width:fit-content;'>change</div></a></div>
        </div>
		</div>`,
        blockScroll:false,
        confirm: function(){
            $.fn.delete_services(collected_id);
        }
      });
      confirm_remove.open();
						
	});
      
    }
    return false;
  });

  $("#profitsMargin").on("click","td:not(.footable-first-column)",function(e){
    var row=$( this ).parent();
    if(!row.hasClass('footable-paging')){
      var collected_id = row.closest('tr').children('td:first').text();
	  
		var confirm_remove = new jBox('Confirm', {
        confirmButton:"OK",
        cancelButton:"CANCEL",
        content:`<div style='font-size:18px; text-align:left' class='row'>
        <div>Are you sure you want to delete record</div>
		</div>`,
        blockScroll:false,
        confirm: function(){
            $.fn.delete_profit_margin(collected_id);
        }
      });
      confirm_remove.open();
			
      
    }
    return false;
  });

  function dispSubmitBtnLoader4(){
			 getE("submitBTNLoaderImg4").style.display = "block";
			 getE("submitBtnTxt4").style.display = "none";
			 getE("submitBTN4").disabled = true;
			 getE("submitBTN4").style.cursor = "not-allowed";
		 }

		 function clearSubmitBtnLoader4(){
			 getE("submitBTNLoaderImg4").style.display = "none";
			 getE("submitBtnTxt4").style.display = "block";
			 getE("submitBTN4").disabled = false;
			 getE("submitBTN4").style.cursor = "pointer";
		 }

  function dispSubmitBtnLoader3(){
			 getE("submitBTNLoaderImg3").style.display = "block";
			 getE("submitBtnTxt3").style.display = "none";
			 getE("submitBTN3").disabled = true;
			 getE("submitBTN3").style.cursor = "not-allowed";
		 }

		 function clearSubmitBtnLoader3(){
			 getE("submitBTNLoaderImg3").style.display = "none";
			 getE("submitBtnTxt3").style.display = "block";
			 getE("submitBTN3").disabled = false;
			 getE("submitBTN3").style.cursor = "pointer";
         }

  function dispSubmitBtnLoader2(){
			 getE("submitBTNLoaderImg2").style.display = "block";
			 getE("submitBtnTxt2").style.display = "none";
			 getE("submitBTN2").disabled = true;
			 getE("submitBTN2").style.cursor = "not-allowed";
		 }

		 function clearSubmitBtnLoader2(){
			 getE("submitBTNLoaderImg2").style.display = "none";
			 getE("submitBtnTxt2").style.display = "block";
			 getE("submitBTN2").disabled = false;
			 getE("submitBTN2").style.cursor = "pointer";
         }
         

         function dispSubmitBtnLoader(){
			 getE("submitBTNLoaderImg").style.display = "block";
			 getE("submitBtnTxt").style.display = "none";
			 getE("submitBTN").disabled = true;
			 getE("submitBTN").style.cursor = "not-allowed";
		 }

		 function clearSubmitBtnLoader(){
			 getE("submitBTNLoaderImg").style.display = "none";
			 getE("submitBtnTxt").style.display = "block";
			 getE("submitBTN").disabled = false;
			 getE("submitBTN").style.cursor = "pointer";
		 }

		 function getE(id){
			 return document.getElementById(id);
		 }

</script>
<?php
include 'api/footerAdditions.php'
?>
</body>
</html>