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
									<h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">NOTICE</h6>
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
										<div class="lqd-column col-md-12 mb-20">
                                        <textarea class="bg-gray text-dark mb-30" type="number" id="notice" aria-required="true" aria-invalid="false" placeholder="Enter Notice" required></textarea>
										<button id="submitBTN" style="cursor: pointer;" onclick="$.fn.submit_data()" type="button"><span id="submitBtnTxt">SAVE </span><img id="submitBTNLoaderImg" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
										</div><!-- /.col-md-6 -->
									</div><!-- /.row -->
									</form>
									<div class="contact-form-result hidden"></div><!-- /.contact-form-result -->
								</div><!-- /.contact-form -->

							</div><!-- /.lqd-column-inner -->

						</div><!-- /.lqd-column col-md-5 col-md-offset-7 -->

					</div><!-- /.row -->
				</div><!-- /.container -->
            </section>
            
            <section class="vc_row pb-50 bg-cover bg-center" style="background: rgb(228, 228, 240);">
				
				<div class="container">
					<div class="row" style="padding-left: 20px; padding-right: 20px;">
						
                    <div class="lqd-column col-md-12 px-4 pb-30 bg-white box-shadow-1">
							
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-40 pb-40">
                        <div>
                        <h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">Saved</h6>
                        <div id="savedNotice">
                            
                        </div>
                        </div>    
                        </div>
                    </div>

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
	$.get('../api/getNoticeTxt.php',{},function(result){
			getE("savedNotice").innerHTML = result;
	});
    }
    $.fn.get_Admin_Users();

	$.fn.submit_data = function(){
		dispSubmitBtnLoader();
            var notice = $("#notice").val();
				
				$.post( "../api/insertNotice.php",{
                    notice: notice
				
			}, function( data ) {
			if(data === "11111"){
				$.fn.notification("Saved Successfully","green");
                clearSubmitBtnLoader();
                $.fn.get_Admin_Users();
			}else if(data === "100112"){
				$.fn.notification("Erro saving password","red");
				clearSubmitBtnLoader();
			}else if(data === "100111"){
				$.fn.notification("User does not exsist -- Try loging in first","red");
				clearSubmitBtnLoader();
			}
			});
         
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