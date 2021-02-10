
<?php 
session_start();
if (!isset($_SESSION["user_details"]) || !$_SESSION["user_details"]["admin"]) {
	header("Location: /");
	die();
}

if (isset($_GET['edit'])) {
	$id =$_GET['edit'];

	$rec = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
	$record = mysqli_fetch_array($rec);
	$username= $record['username'];
	$email =  $record['email'];
	$password = $record['password'];
	$passwordConf = $record['passwordConf'];
	$id = $record['id'];
}



 include(__DIR__."/../../controllers/products/users.php"); 

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
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

	<link rel="stylesheet" type="text/css" href="../../assets/css/admin.css">

	<title>Admin Section - Edit Users</title>

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
	<?php include("../../views/forms/adminHeader.php"); ?>


	<div class="admin-wrapper">

		<?php include("../../views/forms/adminSidebar.php"); ?>
		

		<div class="admin-content">
			<div class="button-group">
				<a href="create.php" class="btn btn-big">Add User</a>
				<a href="index.php" class="btn btn-big">Manage User</a>
			</div>

			<div class="content">
				<h2 class="page-title">Edit User</h2>
				<form action="edit.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $id; ?>" class="text-input">
					<div>
						<label>Username</label>
						<input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
					</div>	
					<div>
						<label>Email</label>
						<input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
					</div>
					<div>
						<label>Password</label>
						<input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
					</div>
					<div>
						<label>Confirm Password</label>
						<input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
					</div>
					<div>
						<?php if (isset($admin) && $admin == 1): ?>
							<label>
								<input type="checkbox" name="admin" checked="">
													Admin
							</label>
						<?php else: ?>
							<label>
								<input type="checkbox" name="admin">
									Admin
							</label>
						<?php endif; ?>		
					</div>
					<div>
						<a href="" type="submit" name="update-user" class="btn btn-big">Update</a>
					</div>
				</form>
			</div>
		</div>

	</div>



	<!--JQuery-->
	<script src="https://cndjs.cloudflare.com/ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>				

	<!-- ckeditor -->
	<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

	<!--Custom Script-->
	<script type="../../js/script.js"></script>
</body>
</html>