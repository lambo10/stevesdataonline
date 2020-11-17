<?php

include'connect.php';

$pageno = 1;
$no_of_records_per_page = $_GET["no_of_records_per_page"];
$offset = ($pageno-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM blog_posts";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);


$handle2 = "SELECT * FROM blog_posts ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
$result2 = $conn->query($handle2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo '<div class="nl_col-md-3" style="padding-top: 10px;"><div class="nl_row"><div class="nl_col-md-1"><img src="./api/uploads/blog_post_pic/'.$row["id"].'/post_pic.jpg" onerror="this.src=`images/userALT.png`;" style="max-width: 40px; height: 40px; border-radius: 50px;" ></div><div class="nl_col-md-6"><div style="font-size: 15px;"><b>'.$row["title"].'</b></div><div>'.$row["date"].'</div> </div></div>
        <div>'.$row["body"].'</div>
        </div>';
    }
}
?>