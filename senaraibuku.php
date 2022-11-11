<?php
session_start();
include 'db.php';
if ($_SESSION['AUTHENTIFICATION'] == 'admin') {
    header('location: /admin');
}

  if (isset($_POST['addNow'])) {
    $query = $db->query("INSERT INTO buku(kod,judul,tingkatan,jenis,harga,catatan) VALUES('".$_POST['kod']."','".$_POST['judul']."','".$_POST['tingkatan']."','".$_POST['jenis']."','".$_POST['harga']."','".$_POST['catatan']."')");
    header("location: senaraibuku.php");
  }

  if (isset($_POST['upId'])) {
    $query = $db->query("UPDATE buku SET kod = '".$_POST['kod']."',judul = '".$_POST['judul']."',tingkatan = '".$_POST['tingkatan']."',jenis = '".$_POST['jenis']."',harga = '".$_POST['harga']."',catatan = '".$_POST['catatan']."' WHERE id_buku = '".$_POST['upId']."'");
    header("location: senaraibuku.php");
  }

  if (isset($_POST['delId'])) {
    $query = $db->query("DELETE FROM buku WHERE id_buku = '".$_POST['delId']."'");
    header("location: senaraibuku.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="<?php echo $DOMAIN ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Sistem E-Borrow</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <link href="assets/css/table-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->  
  </head>

  <body>
    <?php include 'view/message.php'; ?>
<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>E-BORROW</b></a>
            <!--logo end-->
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
              </ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <?php include 'nav.php'; ?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

     <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Book List</h3>
            
          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                        <div class="printah" style="padding-right: 25px;"><a onclick="PrintElem('no-more-tables')" class="btn btn-info" style="float: right; ">Print</a> </div>
						  <h4><b><i class="fa fa-angle-right"></i> Form 1 TextBook</b></h4><br><br>
              <section id="no-more-tables">

                              <?php $res = $db->query("SELECT * FROM buku WHERE tingkatan=1 ORDER BY tingkatan ASC"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Code</th>
                                  <th>Title</th>
								  <th>Form</th>
                                  <th>Type of book</th>
                                  <th>Price</th>
                                  <th>Notes</th>
                                  <th id="yahoo-com" style="width: 100px;text-align: center;">
                                    <a class="btn btn-success btn-xs" onclick="addNow()"><!-- <i class=" fa fa-check"></i> -->Add</a>
                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $re['kod']; ?></td>
                                <td><?php echo $re['judul']; ?></td>
								<td><?php echo $re['tingkatan']; ?></td> 
                                <td><?php echo $re['jenis']; ?></td>
                                <td><?php echo $re['harga']; ?></td>
                                <td><?php echo $re['catatan']; ?></td>
                                <td id="yahoo-com" style="text-align: center;">
                                  
									<a class="btn btn-primary btn-xs" onclick="upNow(
								  <?php echo $re['id_buku']; ?>,
								  <?php echo "'".$re["kod"]."'"; ?>,
								  <?php echo "'".$re["judul"]."'"; ?>,
								  <?php echo "'".$re["tingkatan"]."'"; ?>,
								  <?php echo "'".$re["jenis"]."'"; ?>,
								  <?php echo "'".$re["harga"]."'"; ?>)"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-danger btn-xs" onclick="delNow(<?php echo $re['id_buku']; ?>,<?php echo "'".$re["judul"]."'"; ?>)"><i class="fa fa-trash-o "></i></a>
                                </td>
                                </tr>
                            <?php $no++;endforeach ?>
                              </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

    </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

			  
			  <section id="main-content">
          <section class="wrapper">
			  <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                       
              <h4><b><i class="fa fa-angle-right"></i> Buku Teks Tingkatan 2</b></h4><br><br>
              <section id="no-more-tables">

                              <?php $res = $db->query("SELECT * FROM buku WHERE tingkatan=2 ORDER BY tingkatan ASC"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Kod</th>
                                  <th>Judul</th>
								  <th>Tingkatan</th>
                                  <th>Jenis</th>
                                  <th>Harga</th>
                                  <th>Catatan</th>
                                  <th id="yahoo-com" style="width: 100px;text-align: center;">
                                    <a class="btn btn-success btn-xs" onclick="addNow()"><!-- <i class=" fa fa-check"></i> -->Tambah</a>
                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $re['kod']; ?></td>
                                <td><?php echo $re['judul']; ?></td>
								<td><?php echo $re['tingkatan']; ?></td> 
                                <td><?php echo $re['jenis']; ?></td>
                                <td><?php echo $re['harga']; ?></td>
                                <td><?php echo $re['catatan']; ?></td>
                                <td id="yahoo-com" style="text-align: center;">
                                  
									<a class="btn btn-primary btn-xs" onclick="upNow(
								  <?php echo $re['id_buku']; ?>,
								  <?php echo "'".$re["kod"]."'"; ?>,
								  <?php echo "'".$re["judul"]."'"; ?>,
								  <?php echo "'".$re["tingkatan"]."'"; ?>,
								  <?php echo "'".$re["jenis"]."'"; ?>,
								  <?php echo "'".$re["harga"]."'"; ?>)"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-danger btn-xs" onclick="delNow(<?php echo $re['id_buku']; ?>,<?php echo "'".$re["judul"]."'"; ?>)"><i class="fa fa-trash-o "></i></a>
                                </td>
                                </tr>
                            <?php $no++;endforeach ?>
                              </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

    </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

			  
			 <section id="main-content">
          <section class="wrapper">
			  <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                       
              <h4><b><i class="fa fa-angle-right"></i> Buku Teks Tingkatan 3</b></h4><br><br>
              <section id="no-more-tables">

                              <?php $res = $db->query("SELECT * FROM buku WHERE tingkatan=3 ORDER BY tingkatan ASC"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Kod</th>
                                  <th>Judul</th>
								  <th>Tingkatan</th>
                                  <th>Jenis</th>
                                  <th>Harga</th>
                                  <th>Catatan</th>
                                  <th id="yahoo-com" style="width: 100px;text-align: center;">
                                    <a class="btn btn-success btn-xs" onclick="addNow()"><!-- <i class=" fa fa-check"></i> -->Tambah</a>
                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $re['kod']; ?></td>
                                <td><?php echo $re['judul']; ?></td>
								<td><?php echo $re['tingkatan']; ?></td> 
                                <td><?php echo $re['jenis']; ?></td>
                                <td><?php echo $re['harga']; ?></td>
                                <td><?php echo $re['catatan']; ?></td>
                                <td id="yahoo-com" style="text-align: center;">
                                  
									<a class="btn btn-primary btn-xs" onclick="upNow(
								  <?php echo $re['id_buku']; ?>,
								  <?php echo "'".$re["kod"]."'"; ?>,
								  <?php echo "'".$re["judul"]."'"; ?>,
								  <?php echo "'".$re["tingkatan"]."'"; ?>,
								  <?php echo "'".$re["jenis"]."'"; ?>,
								  <?php echo "'".$re["harga"]."'"; ?>)"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-danger btn-xs" onclick="delNow(<?php echo $re['id_buku']; ?>,<?php echo "'".$re["judul"]."'"; ?>)"><i class="fa fa-trash-o "></i></a>
                                </td>
                                </tr>
                            <?php $no++;endforeach ?>
                              </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

    </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
  
			  
			   <section id="main-content">
          <section class="wrapper">
			  <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                       
						  <h4><b><i class="fa fa-angle-right"></i> Buku Teks Tingkatan 4</b></h4><br><br>
              <section id="no-more-tables">

                              <?php $res = $db->query("SELECT * FROM buku WHERE tingkatan=4 ORDER BY tingkatan ASC"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Kod</th>
                                  <th>Judul</th>
								  <th>Tingkatan</th>
                                  <th>Jenis</th>
                                  <th>Harga</th>
                                  <th>Catatan</th>
                                  <th id="yahoo-com" style="width: 100px;text-align: center;">
                                    <a class="btn btn-success btn-xs" onclick="addNow()"><!-- <i class=" fa fa-check"></i> -->Tambah</a>
                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $re['kod']; ?></td>
                                <td><?php echo $re['judul']; ?></td>
								<td><?php echo $re['tingkatan']; ?></td> 
                                <td><?php echo $re['jenis']; ?></td>
                                <td><?php echo $re['harga']; ?></td>
                                <td><?php echo $re['catatan']; ?></td>
                                <td id="yahoo-com" style="text-align: center;">
                                  
									<a class="btn btn-primary btn-xs" onclick="upNow(
								  <?php echo $re['id_buku']; ?>,
								  <?php echo "'".$re["kod"]."'"; ?>,
								  <?php echo "'".$re["judul"]."'"; ?>,
								  <?php echo "'".$re["tingkatan"]."'"; ?>,
								  <?php echo "'".$re["jenis"]."'"; ?>,
								  <?php echo "'".$re["harga"]."'"; ?>)"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-danger btn-xs" onclick="delNow(<?php echo $re['id_buku']; ?>,<?php echo "'".$re["judul"]."'"; ?>)"><i class="fa fa-trash-o "></i></a>
                                </td>
                                </tr>
                            <?php $no++;endforeach ?>
                              </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

    </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
				  
				  
				   <section id="main-content">
          <section class="wrapper">
			  <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                       
						  <h4><b><i class="fa fa-angle-right"></i> Buku Teks Tingkatan 5</b></h4><br><br>
              <section id="no-more-tables">

                              <?php $res = $db->query("SELECT * FROM buku WHERE tingkatan=5 ORDER BY tingkatan ASC"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Kod</th>
                                  <th>Judul</th>
								  <th>Tingkatan</th>
                                  <th>Jenis</th>
                                  <th>Harga</th>
                                  <th>Catatan</th>
                                  <th id="yahoo-com" style="width: 100px;text-align: center;">
                                    <a class="btn btn-success btn-xs" onclick="addNow()"><!-- <i class=" fa fa-check"></i> -->Tambah</a>
                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $re['kod']; ?></td>
                                <td><?php echo $re['judul']; ?></td>
								<td><?php echo $re['tingkatan']; ?></td> 
                                <td><?php echo $re['jenis']; ?></td>
                                <td><?php echo $re['harga']; ?></td>
                                <td><?php echo $re['catatan']; ?></td>
                                <td id="yahoo-com" style="text-align: center;">
                                  
									<a class="btn btn-primary btn-xs" onclick="upNow(
								  <?php echo $re['id_buku']; ?>,
								  <?php echo "'".$re["kod"]."'"; ?>,
								  <?php echo "'".$re["judul"]."'"; ?>,
								  <?php echo "'".$re["tingkatan"]."'"; ?>,
								  <?php echo "'".$re["jenis"]."'"; ?>,
								  <?php echo "'".$re["harga"]."'"; ?>)"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-danger btn-xs" onclick="delNow(<?php echo $re['id_buku']; ?>,<?php echo "'".$re["judul"]."'"; ?>)"><i class="fa fa-trash-o "></i></a>
                                </td>
                                </tr>
                            <?php $no++;endforeach ?>
                              </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

    </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->




<div id="popupadd" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none;">
  <div style="background-color: white; margin: 10% auto; border-radius: 5px; padding: 20px 30px;height: auto;width: 400px;">
    <form method="post" action="" id="addNow">
      <input type="hidden" name="addNow">
      <p style="font-size: 14px;">Insert new information.</p>
      Kod:
      <input class="form-control" type="text" placeholder="Kod" name="kod"><br>
      Judul:
      <input class="form-control" type="text" placeholder="Judul" name="judul"><br>
      Tingkatan:
      <select class="form-control" name="tingkatan">
        <option value="1">Tingkatan 1</option>
        <option value="2">Tingkatan 2</option>
        <option value="3">Tingkatan 3</option>
        <option value="4">Tingkatan 4</option>
        <option value="5">Tingkatan 5</option>
      </select><br>
      Jenis:
      <select class="form-control" name="jenis">
        <option value="Novel">Novel</option>
        <option value="Subjek Teras">Subjek Teras</option>
        <option value="Subjek Teras Pilihan">Subjek Teras Pilihan</option>
        <option value="Subjek Elektif">Subjek Elektif</option>

      </select><br>
      Harga (RM):
      <input class="form-control" type="number" placeholder="Harga" name="harga" value="0.00"><br>
      Catatan:
      <input class="form-control" type="text" placeholder="Catatan" name="catatan"><br>
      <div style="width: 100%;text-align: center;"><br>
        <a onclick="addNo()" class="btn btn-default" style="cursor: pointer;display: inline-block;">Cancel</a>
        <a onclick="document.getElementById('addNow').submit();" class="btn btn-success" style="cursor: pointer;display: inline-block;">Add</a>
      </div>
    </form>
  </div>
</div>

<div id="popupup" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none;">
  <div style="background-color: white; margin: 10% auto; border-radius: 5px; padding: 20px 30px;height: auto;width: 400px;">
    <form method="post" action="" id="upNow">
      <input id="id_pelh" type="hidden" name="upId" value="">
      <p style="font-size: 14px;">Update <b id="nama_h"></b> information.</p>
      Kod:
      <input id="hh_kod" class="form-control" type="text" placeholder="Kod" name="kod"><br>
      Judul:
      <input id="hh_judul" class="form-control" type="text" placeholder="Judul" name="judul"><br>
      Tingkatan:
      <select id="hh_tingkatan" class="form-control" name="tingkatan">
        <option value="1">Tingkatan 1</option>
        <option value="2">Tingkatan 2</option>
        <option value="3">Tingkatan 3</option>
        <option value="4">Tingkatan 4</option>
        <option value="5">Tingkatan 5</option>
      </select><br>
      Jenis:
      <select id="hh_jenis" class="form-control" name="jenis">
        <option value="Novel">Novel</option>
        <option value="Subjek Teras">Subjek Teras</option>
        <option value="Subjek Teras Pilihan">Subjek Teras Pilihan</option>
        <option value="Subjek Elektif">Subjek Elektif</option>
      </select><br>
      RM
      <input id="hh_harga" class="form-control" type="number" placeholder="Harga" name="harga" value="0.00"><br>
      Catatan:
      <input class="form-control" type="text" placeholder="Catatan" name="catatan"><br>
      <div style="width: 100%;text-align: center;">
        <a onclick="upNo()" class="btn btn-default" style="cursor: pointer;display: inline-block;">Cancel</a>
        <a onclick="document.getElementById('upNow').submit();" class="btn btn-primary" style="cursor: pointer;display: inline-block;">Update</a>
      </div>
    </form>
  </div>
</div>

<div id="popupdel" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none;">
  <div style="background-color: white; margin: 10% auto; border-radius: 5px; padding: 20px 30px;height: auto;width: 400px;">
    <form method="post" action="" id="delNow">
      <input id="id_pela" type="hidden" name="delId" value="">
      <p style="font-size: 16px;">Are you sure you want to delete <b id="nama_a"></b> information?</p>
      <div style="width: 100%;text-align: center;">
        <a onclick="delNo()" class="btn btn-default" style="cursor: pointer;display: inline-block;">Cancel</a>
        <a onclick="document.getElementById('delNow').submit();" class="btn btn-danger" style="cursor: pointer;display: inline-block;">Delete</a>
      </div>
    </form>
  </div>
</div>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script>
      function addNow() {
        document.getElementById('popupadd').style.display = "block";
      }
      function addNo() {
        document.getElementById('popupadd').style.display = "none";
      }
      function upNow(id,kod,judul,tingkatan,jenis,harga,catatan) {
        document.getElementById('popupup').style.display = "block";
        document.getElementById('id_pelh').value = id;
        document.getElementById('nama_h').innerHTML = judul;
        document.getElementById('hh_kod').value = kod;
        document.getElementById('hh_judul').value = judul;
        document.getElementById('hh_tingkatan').value = tingkatan;
        document.getElementById('hh_jenis').value = jenis;
        document.getElementById('hh_harga').value = harga;
        document.getElementById('hh_catatan').value = catatan;
      }
      function upNo() {
        document.getElementById('popupup').style.display = "none";
      }
      function delNow(id,judul) {
        document.getElementById('popupdel').style.display = "block";
        document.getElementById('id_pela').value = id;
        document.getElementById('nama_a').innerHTML = judul;
      }
      function delNo() {
        document.getElementById('popupdel').style.display = "none";
      }
    </script>
  <script type="text/javascript" id="printah">
    function PrintElem(elem) {
      

      var mywindow = window.open('','PRINT','height=400,width=600');

      mywindow.document.write('<html><head><title>' + document.title + '</title>');
      mywindow.document.write('<link href="assets/css/bootstrap.css" rel="stylesheet"><link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" /><link href="assets/css/style.css" rel="stylesheet"><link href="assets/css/style-responsive.css" rel="stylesheet"><link href="assets/css/table-responsive.css" rel="stylesheet"><style>#yahoo-com{display:none;}</style>');
      mywindow.document.write('</head><body>');
      mywindow.document.write('<h1><center>Senarai Buku Tingkatan 2</center></h1>');
      mywindow.document.write(document.getElementById(elem).innerHTML);
      mywindow.document.write('<table> ')
      mywindow.document.write('</body></html>');

      mywindow.document.close();
      mywindow.focus();

      mywindow.print();
      mywindow.close();

      return true;
    }
  </script>
     
  </body>
</html>
