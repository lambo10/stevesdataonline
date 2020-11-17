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
									<h6 class="font-size-14 font-weight-medium text-uppercase ltr-sp-2">NEW ADVERT</h6>
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
							
                            <div class="contact-form contact-form-button-block font-size-14">
									<div id="makePost_container">
                                    <form novalidate="novalidate" id="make_post_form">

                                    <div class="row d-flex flex-wrap">
                                        <div class="lqd-column col-md-12 mb-20">
                                        
                                            <input maxlength="100" class="bg-gray text-dark mb-30" id="name" type="text" name="name" aria-required="true" aria-invalid="false" placeholder="Title" required>
                                            <input id="ad_link" class="bg-gray text-dark mb-30" type="text" name="ad_link" aria-required="true" aria-invalid="false" placeholder="Advert Link" required>
                                            <!-- <input id="phone" class="bg-gray text-dark" type="number" name="phone"  placeholder="Phone No" required>
                                             -->
                                        </div><!-- /.col-md-6 -->
                                        <div class="lqd-column text-md-right" style="width: 100%;">
                                        <button id="submitBTN" class="lamboSubmitBTN" style="cursor: pointer;" onclick="$.fn.submit_data()" type="button"><span id="submitBtnTxt">NEXT </span><img id="submitBTNLoaderImg" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
                                        </div><!-- /.col-md-6 -->

                                    </div><!-- /.row -->



                                    </form>
                                    </div>
                                    <div id="uploadPicContainer" style="display: none;">
                                    <form novalidate="novalidate" action="api/upload_advert_pic.php" class="dropzone">

                                        <div class="row d-flex flex-wrap">
                                            <div class="lqd-column col-md-12 mb-20">
											
                                                <div id="employee_passport_id" action="api/upload_advert_pic.php" class="dropzone dz-clickable" style="min-height:200px; padding: 1px 1px; border: none;">
                                            <div class="dz-default dz-message" style="margin: 0em 0;">
                                                <span>Drop files or click to upload</span>
                                            </div>
                                        </div> 

                                            </div><!-- /.col-md-6 -->
                                            

                                        </div><!-- /.row -->

                                        
                                        
                                    </form><br>
                                    <div class="lqd-column text-md-right" style="width: 100%;">
											<button class="lamboSubmitBTN" style="cursor: pointer;" onclick="reset_blog_post_form()" type="button"><span id="submitBtnTxt">FINISH </span><img id="submitBTNLoaderImg" src="images/loading.gif" style="width: 50px; height:50px; display:none" /></button>
                                            </div><!-- /.col-md-6 -->
                            </div>
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
							
							<div class="lqd-column-inner bg-white border-radius-6 px-3 px-md-4 pt-10 pb-40">
							<br>
                            <div class="row" data-liquid-masonry="true">
                                
                            <div class="lqd-column col-md-12">

							<div class="liquid-blog-posts">
								<div class="liquid-blog-grid row" data-liquid-masonry="true">
								<?php
								if (isset($_GET['pageno'])) {
									$pageno = $_GET['pageno'];
								} else {
									$pageno = 1;
								}
								$no_of_records_per_page = 6;
								$offset = ($pageno-1) * $no_of_records_per_page;

								
								$total_pages_sql = "SELECT COUNT(*) FROM adverts";
								$result = mysqli_query($conn,$total_pages_sql);
								$total_rows = mysqli_fetch_array($result)[0];
								$total_pages = ceil($total_rows / $no_of_records_per_page);


								$handle2 = "SELECT * FROM adverts ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
								$result2 = $conn->query($handle2);
								if ($result2->num_rows > 0) {
									while($row = $result2->fetch_assoc()) {
										$shortend_title = substr($row["title"],0,50);
										echo '<div class="lqd-column col-md-4 col-sm-6 masonry-item">

										<article class="liquid-lp mb-40">
								
                                            <figure class="liquid-lp-media">
                                            <button type="button" onclick="$.fn.delete_services('.$row["id"].')" class="btn ld_sf_button px-4" style="padding-top:10px; padding-bottom:10px"><span class="fa fa-trash">Delete</span></button>
												<a href="'.$row["ad_link"].'">
													<img style="height: 250px;" src="./api/uploads/avert_pics/'.$row["id"].'/post_pic.jpg" alt="Lates Post">
												</a>
											</figure>
										
											<header class="liquid-lp-header" style="height: 50px;">
												<h3 class="liquid-lp-title h4 font-size-19"><a href="'.$row["ad_link"].'" style="color:#808291">'.$shortend_title.'</a></h3>
											</header>
										
										</article>
								
									</div><!-- /.col-md-3 col-sm-6 -->';
									}
								}
								?>
									
	
									
								</div><!-- /.liquid-blog-grid row -->
								<ul class="pagination">
								<li><a href="?pageno=1">First</a></li>
								<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
									<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
								</li>
								<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
									<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
								</li>
								<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
							</ul>
							</div><!-- /.liquid-blog-posts -->

						</div><!-- /.col-md-12 -->
									
	
									
                                </div><!-- /.liquid-blog-grid row -->

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
<script type="text/javascript" src="js/dropzone.js"></script>
<script src="./assets/js/theme-vendors.js"></script>
<script src="./assets/js/theme.min.js"></script>
<script src="./assets/js/liquidAjaxMailchimp.min.js"></script>
<script> 

var static_vars = {
    postID:""
}

$.fn.delete_services = function(id){
            $.get( "../api/admin_delete_advert.php",{
                id:id
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Deleted Successfully","green");
                location.reload();
			}else if(data === "100111"){
				$.fn.notification("Erro Deleting service","red");
			}else if(data === "100112"){
				$.fn.notification("Access Denied","red");
			}
			});
       
    }

	$.fn.submit_data = function(){
		
            var name = $("#name").val();
			var ad_link = $("#ad_link").val();
            // var phone = $("#phone").val();
            
			if(name.length <= 0){
                $.fn.confirm("Pls Enter Title","red",function(){});
				clearSubmitBtnLoader();
			}else{

                dispSubmitBtnLoader();
                    $.post( "../api/admin_process_advert_post.php",{
                        title: name,
                        ad_link: ad_link
                        // phone: phone
				
			}, function( data ) {
			if(data === "100112"){
				$.fn.notification("Erro making post","red");
				clearSubmitBtnLoader();
			}else if(data === "100111"){
				$.fn.notification("User does not exsist -- Try loging in first","red");
				clearSubmitBtnLoader();
			}else{
                clearSubmitBtnLoader();
                static_vars.postID = data;
                getE("makePost_container").style.display = "none";
                getE("uploadPicContainer").style.display = "block";
            }
			});

			}
         
         }
         
  function reset_blog_post_form(){
        getE("uploadPicContainer").style.display = "none";
        getE("make_post_form").reset();
        getE("makePost_container").style.display = "block";
        location.reload();
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
         
         Dropzone.options.employeePassportId = false;
  Dropzone.options.employeePassportId = {
  paramName: "filesUP00012101", // The name that will be used to transfer the file
  maxFilesize: 5, // MB
  maxFiles: 1,
  addRemoveLinks: true,
  method: 'post',
  init: function() {
    clearDropzone = function(){
            this.removeAllFiles(true);
        };
    this.on("sending", function(file, xhr, formData) {
      formData.append("postID", static_vars.postID);
    });
  }
};



</script>
<?php
include 'api/footerAdditions.php'
?>
</body>
</html>