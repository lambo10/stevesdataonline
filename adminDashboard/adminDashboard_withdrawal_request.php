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
									<h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">WITHDRAWALS</h6>
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
							
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-10 pb-40">
							<div style="text-align: right;">Click to view details</div>
                            <table id="adminUsers" class="table" data-show-toggle="false" data-paging="true" data-sorting="true" data-filtering="true" data-paging-size="5">
								</table>

							</div><!-- /.lqd-column-inner -->

						</div><!-- /.lqd-column col-md-5 col-md-offset-7 -->

					</div><!-- /.row -->
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
     $.fn.get_Admin_Users = function(){ 
		var resultJson = null;
	$.get('../api/admin_get_withrawal_request.php',{},function(result){
		resultJson = JSON.parse(result);
		$('#adminUsers').footable({
                          "columns": $.get('../json/admin_commission_withdrawal.json'),
                          "rows": resultJson
						});
						
	});
    }
    $.fn.get_Admin_Users();

    $("#adminUsers").on("click","td:not(.footable-first-column)",function(e){
    var row=$( this ).parent();
    if(!row.hasClass('footable-paging')){
      var collected_id = row.closest('tr').children('td:first').text();
	  
	  $.get('../api/admin_get_single_withdrawal_request.php',{
		  id:collected_id
	  },function(result){
		var resultJson_array = JSON.parse(result);
		var resultJson = resultJson_array[0];
		
		var confirm_remove = new jBox('Confirm', {
        confirmButton:"PAID",
        cancelButton:"CANCEL",
		content:`<div style='font-size:18px; text-align:left' class='row'>
		<div class='col-md-5'>Email: `+resultJson.email+` </div>
		<div class='col-md-5'>Account Name: `+resultJson.accountName+`</div><div class='col-md-5'>Bank Name: `+resultJson.bankName+`</div>
		<div class='col-md-5'>Account Number: `+resultJson.accountNo+`</div><div class='col-md-5'>Date: `+resultJson.date+`</div>
		</div>`,
        blockScroll:false,
        confirm: function(){
			$.fn.settle_withdrawal(collected_id);
        }
      });
      confirm_remove.open();
						
	});
      
    }
    return false;
  });
  $.fn.settle_withdrawal = function(id){ 
	$.get('../api/admin_settle_withrawal_req.php',{
		id:id
	},function(result){
		
		if(result == "11111"){
			$.fn.notification("Settled successfully","green");
			$.fn.get_Admin_Users();
		}else if(result == "100112"){
			$.fn.notification("Erro settling request","red");
		}else if(result == "100113"){
			$.fn.notification("Invalid admin user","red");
		}
						
	});
    }

</script>
<?php
include 'api/footerAdditions.php'
?>
</body>
</html>