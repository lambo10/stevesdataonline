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
    <link href="css/dropzone.css" rel="stylesheet">
	
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
									<h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">SERVICE IMAGE</h6>
								</div><!-- /.col-md-2 -->


							</div><!-- /.row -->
						</div><!-- /.col-md-12 -->

					</div><!-- /.titlebar-row -->
				</div><!-- /.titlebar-container -->
			</div><!-- /.titlebar-inner -->
			
		</div><!-- /.titlebar -->
	
		
		<main id="content" class="content">
					
			<section class="vc_row pb-50 bg-cover bg-center" style="background: rgb(228, 228, 240);">
				
                <div class="container" style="min-height: 400px;">
                <div class="row" style="padding-left: 20px; padding-right: 20px;">
                <div style="width:100%; padding:20px; background:white">
                <div>Max image size 2MB</div>
                <div id="employee_passport_id" action="../api/upload_service_pic.php" class="dropzone dz-clickable" style="min-height:200px; padding: 1px 1px; ">
                                            <div class="dz-default dz-message" style="margin: 0em 0;">
                                                <span>Drop files or click to upload</span>
                                            </div>
                                        </div>
                                        <br>
                                        <a href="adminDashboardServices.php"><div style="padding: 10px; background:#003879; color:white; text-align:center; cursor:pointer">Done</div></a>
                </div><!-- /.container -->
                </div>
                </div>
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
<script type="text/javascript" src="js/dropzone.js"></script>
<script>
              Dropzone.options.employeePassportId = false;
  Dropzone.options.employeePassportId = {
  paramName: "filesUP00012101", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  maxFiles: 1,
  addRemoveLinks: true,
  method: 'post',
  init: function() {
    clearDropzone = function(){
            this.removeAllFiles(true);
        };
    this.on("sending", function(file, xhr, formData) {
      formData.append("serviceID", "<?php echo $_GET['serviceID']; ?>");
    });
  }
}; 

</script>
<?php
include 'api/footerAdditions.php'
?>
</body>
</html>