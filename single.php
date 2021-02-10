<?php 

session_start();
include ('controllers/confiq.php'); 
include ('controllers/products/posts.php');

if (isset($_GET['id'])) {
	$post = selectOne('posts', ['id' => $_GET['id']]);
}

$topics = selectAll('topics');
$posts = selectALL('posts', ['published' => 1]);


error_reporting(0); // for not showing any error

if (isset($_POST['submit'])) {  //check press or not Post comment button
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];


	$sql = "INSERT INTO comments (name, email, comment)
			VALUES ('$name', '$email', '$comment')";
	$result = mysqli_query($conn, $sql);
	if($result) {
		echo "<script>alert('Comment added successfully.')</script>";
	} else {
		echo  "<script>alert('Comment does not add.')</script>";
	}

}

$query = "SELECT image FROM posts WHERE id = ?";
$stmt = $conn -> stmt_init();
if (!$stmt -> prepare($query)) {
	echo "error";
	die();
}
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$image = $stmt->get_result()->fetch_assoc();
if (count($image) < 0) {
	echo "not found";
	die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!--fONT Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

	<!--goggle fonts-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	
	<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Merriweather&display=swap" rel="stylesheet">

	<!--style,css-->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<title><?php echo $post['title']; ?> |  Memelogy</title>

	<!--
                             ,
                             B
                            BMB.
                          3BBBMBX
                       .PMBMBMBMBBD,
                     7MBMBMBMBMBMBMBMs
                  :EBMBMBMBMx iMBMBMBMBO:
                7BMBMBBBMBJ     vBBBBBMBMBs
              xMBMBBBMBH,    .    .UBMBMBMBBF
 .          .BMBBBMBX:      :Br      .FBMBMBBB:
 LR;,.:rUOBMBMBMBM;       ;MBMBBr       :OBMBMBBBRSr:.,:EU
  MBMBMBBBMBMBMM.      :0BMBBEMBMBD:       WMBBBMBMBMBMBM
  HMB.::.  BBMc     .HBMBMBK   FBBBMBZ,     ;BBB  .::.BBM
  MBM      UMP    .BMBMBZ:       ,HBMBMB:    LBM      MBM
  BBB   BMBMBr   cBMBW:     0BM     .0BMBF   .BMBMB   BMB:
 WBBx   cBL.iB   BMR     cMBM1MBM3     PMB   M7,;BK   ;BMB
 MBM    BM:  .J  BB    RBMB;   :RMBM    RM  c:   MB    MBM
:BM7    BB     , ,M   MBr         ;BM   Or .     BM:   :MBi
:MB,   7B7        .i  B             B  ::        :BS    BM
 BMG    BK             :           .,            cM:   2MB
  BMH   .Mi     : :                 E:          :M:   sMB
   ;MRui  ;:.   :Fui:;  :;;7i   .;;;rS:,  rr   ,:  :7EO:
        ::::::,   .UUi:77;::37s7Lv7;  ,;3SD,....:;;,
     BM: ..:i7rJLxS:  .      rs: 7   ..;LxxUWRFU;::7OW
      S2r:::iis0r;J3Or.:rvLi:::rBL.  .:;,  .   :ri:.,
                    .ZL. .:L;,r7;i7r;7:
                            xMc     ,
                           :. 3v
                           :S  ;
                            LB;
                             7
-->
</head>
<body>
	<?php include("views/partials/nav.php"); ?>


	<div class="page-wrapper">

		<div class="content clearfix">
			<div class="main-content-wrapper">
				<div class="main-content single">
						<img src="<?php echo($image["image"])?>" class="center">
					<h1 class="post-title"><?php echo $post['title']; ?></h1>
					<div class="post-content">
						<?php echo html_entity_decode($post['body']) ?>
					</div>
					<div class="wrapper">
						<form action="" method="POST" class="form">
							<div class="row">
								<div class="input-group">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" placeholder="Enter your Name" required>
								</div>
								<div class="input-group">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" placeholder="Enter your Email" required>
								</div>
							</div>
							<div class="input-group textarea">
								<label for="comment">Comment</label>
								<textarea id="comment" name="comment" placeholder="Enter your Comment" required></textarea>
							</div>
							<div class="input-group">
								<button name="submit" class="btn"><!-- <a href="single.html"></a> -->Post Comment</button>
							</div>
						</form>
						<div class="prev-comments">
							<?php 
							
							$sql = "SELECT * FROM comments";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {

							?>
							<div class="single-item">
								<h4><?php echo $row['name']; ?></h4>
								<a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
								<p><?php echo $row['comment']; ?></p>
								<td>
									
								</td>
							<a href="/controllers/products/comment_delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                Delete
                            </a>
							</div>

							
							<?php

								}
							}
							
							?>
						</div>
					</div>
				</div>
			</div>	

			<!--Side bar-->	
			<!-- <div class="sidebar single">
				
				<div class="section popular">	
					<h2 class="section-title"></h2>

					<?php foreach ($posts as $post): ?>
						<div class="post clearfix">
							<img src="<?php echo 'assets/img' .$p[''] ?>" alt="">
							<a href="" class="title"><h4><?php echo $p['post']; ?></h4></a>	
						</div>
					<?php endforeach; ?>	
					
				</div>



				<div class="section topics">
					<h2 class="section-title">Topics</h2>
					<ul>
						<?php foreach ($topics as $key => $topic): ?>
							<li><a href="<?php echo 'index.php?_id=' . $topic['id'] ?>"><?php echo $topic['name']; ?></a></li>
						<?php endforeach; ?>	
						
					</ul>
				</div>
			</div> -->
		</div>
	</div>	


	

	<?php header('') ?>

	<?php include("views/partials/footer.php"); ?>		

	<!--JQuery-->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<!-- Slick Carousel -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
				

	<!--Custom Script-->
	<script type="js/script.js"></script>
</body>
</html>