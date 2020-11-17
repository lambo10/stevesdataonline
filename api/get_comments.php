<?php
include 'connect.php';
$id = $_GET["id"];
$handle3 = "SELECT * FROM comments WHERE postID='$id' ORDER BY id DESC";
					$result3 = $conn->query($handle3);
					if ($result3->num_rows > 0) {
						while($row = $result3->fetch_assoc()) {
							
							echo '<div class="col-md-8 col-md-offset-2">
								
							<ol class="comment-list">
								
								<li class="comment">
									<article class="comment-body">
										<footer class="comment-meta">
											<div class="comment-author vcard">
                                            <img alt="Avatar" src="./assets/demo/avatars/avatar-4.jpg" class="avatar">
												<b class="fn">
													<a href="#" rel="external nofollow" class="url">'.$row["name"].'</a>
												</b>
												<span class="says">says:</span>
											</div> <!-- .comment-author -->
											
											<div class="comment-metadata">
												<a href="#">
													<time datetime="'.$row["date"].'">'.$row["date"].'</time>
												</a>
											</div> <!-- .comment-metadata -->
										</footer> <!-- .comment-meta -->
										
										<div class="comment-content">
											<p>'.$row["comment"].'</p>
										</div> <!-- .comment-content -->
										
									</article> <!-- .comment-body -->
								</li> <!-- #comment-## -->
							</ol>
							
						</div>';
						}
					}
?>