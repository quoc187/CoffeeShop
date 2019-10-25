<!doctype html>
<?php session_start(); 
header('Content-Type: text/html; charset=UTF-8');
?>
<html lang="en">
  <head>
    <title>Hệ thống quản lý</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css?v=2.1.1" rel="stylesheet" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

	<script type='text/javascript'>
		$( document ).ready(function() {
			$('#datetimepicker1').datetimepicker();
		});
	</script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-success sticky-top">
      <div class="container">
        <a class="navbar-brand">HỆ THỐNG QUẢN LÝ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        	<ul class="navbar-nav col-auto mr-auto"></ul>
          <ul class="navbar-nav col-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php 
                include ('sql_conn.php');
                if (isset($_SESSION['account']) && $_SESSION['account']){ //Kiểm tra session
                       $name = "SELECT * FROM employees WHERE account = '".$_SESSION['account']."'";
                       $queryName = mysqli_query($conn, $name); //Thực hiện câu truy vấn
                        if ($queryName->num_rows > 0) { //Kiểm tra số dòng
                         while ($row = mysqli_fetch_assoc($queryName)) { //Nếu có kết quả thì đưa tất cả vào bảng
                          echo "Xin chào ".$row['fullname']; //Đúng thì cho phép truy cập và hiện xin chào
                        }
                       }        
                     }else{
                    header('Location: login.php'); 
                }
                ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
              </li>
          </ul>
        </div>
      </div>
    </nav>
<main role="main" class="container md">                                  
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="card card-nav-tabs card-plain">
      <div class="card-header card-header-warning">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#shift" data-toggle="tab"><i class="material-icons">calendar_view_day</i> Lịch trực</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#salary" data-toggle="tab"><i class="material-icons">attach_money</i> Lương</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#information" data-toggle="tab"><i class="material-icons">face</i> Thông tin</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body ">
        <div class="tab-content text-center">
          <div class="tab-pane active" id="shift">
            <nav aria-label="breadcrumb" role="navigation">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="#">Lịch trực</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Đăng ký ca trực</li>
			  </ol>
			</nav>
			<form method="get" action="reg_shift.php" class="text-left">
			  <div class="form-group">
			  	<label>Chọn ngày </label><br>
			  <?php 
			  	for ($i = 2; $i < 9 ; $i++) { 
			  	  if ($i==8)
			  	  	$day = "Chủ nhật";
			  	  else
			  	  	$day = "Thứ ".$i;
			  	?>
			  	<div class="form-check form-check-inline">
				  <label class="form-check-label">
				    <input class="form-check-input" type="checkbox" id="day" name="day[]" value="<?php echo $i; ?>"><?php echo $day; ?>
				    <span class="form-check-sign">
				        <span class="check"></span>
				    </span>
				  </label>
				</div>
			  	<?php
			  	}
			   ?>
			  </div>
			  <div class="form-group">
			    <label for="shift">Chọn ca trực</label><br>
			    <select multiple class="form-control selectpicker col-md-6" name="shift[]" data-style="btn btn-link" id="shift">
			      <option value="1">Ca 1 (6:00 - 10:00)</option>
			      <option value="2">Ca 2 (10:00 - 14:00)</option>
			      <option value="3">Ca 3 (14:00 - 18:00)</option>
			      <option value="4">Ca 4 (18:00 - 22:00)</option>
			    </select>
			  </div>
			  <div class="form-group">
			  	<!-- <button class="btn btn-danger" type="reset">Chọn lại</button> -->
			    <button class="btn btn-success">Đăng ký</button>
			  </div>
			</form>
			<nav aria-label="breadcrumb" role="navigation">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="#">Lịch trực</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Lịch trực</li>
			  </ol>
			</nav>
			<table class="table table-hover table-bordered">
			  <thead>
			  	<tr>
			  	  <th scope="col"></th>
			  	  <th scope="col">Thứ 2</th>
			  	  <th scope="col">Thứ 3</th>
			  	  <th scope="col">Thứ 4</th>
			  	  <th scope="col">Thứ 5</th>
			  	  <th scope="col">Thứ 6</th>
			  	  <th scope="col">Thứ 7</th>
			  	  <th scope="col">Chủ nhật</th>
			  	</tr>
			  </thead>
			  <tbody>
			  	<?php 
			  		$select_ca = "SELECT DISTINCT shiftName FROM shifts WHERE empAccount = '".$_SESSION['account']."'";
			  		$query_ca = mysqli_query($conn, $select_ca);
			  		if ($query_ca->num_rows > 0) {
			  			while ($row=mysqli_fetch_assoc($query_ca)) {
			  			?>
			  			<tr>
			  				<th>Ca <?php echo $row['shiftName']; ?></th>
			  				<?php 
			  					for ($i=2; $i < 9 ; $i++) { 
			  				?>
			  				<td>
			  					<?php 
			  					 	$select_ngay = "SELECT dayOfShift FROM shifts WHERE shiftName = '".$row['shiftName']."'";
			  					 	$query_ngay = mysqli_query($conn, $select_ngay);
			  					 	if ($query_ngay->num_rows > 0) {
			  					 		while ($rows = mysqli_fetch_assoc($query_ngay)) {
			  					 			if ($rows['dayOfShift']==$i)
			  					 				echo '<i class="material-icons" style="color: green;">done</i>';
			  					 			else
			  					 				echo "";
			  					 		}
			  					 	}
			  					?>
			  				</td>
			  				<?php
			  					}
			  				 ?>
			  			</tr>
			  			<?php
			  			}
			  		}
			  	 ?>
			  </tbody>
			</table>
          </div>
          <div class="tab-pane" id="salary">
            <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
          </div>
          <div class="tab-pane" id="information">
            <p> I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
          </div>
        </div>
      </div>
    </div>    
  </div>
</main>
  </body>
  <footer class="footer footer-default" >
    <div class="container">
      <div class="copyright float-left">
          &copy;
          <script>
              document.write(new Date().getFullYear())
          </script>
      </div>
      <div class="copyright float-right">
          Made with <i class="material-icons">all_inclusive</i> love by
          <a href="https://www.facebook.com/giangpt2808">Giang</a>
      </div>
    </div>
  </footer>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script></body>
</html>