<?php
session_start();
include 'db.php';

  if ($_SESSION['AUTHENTIFICATION'] == 'admin') {
    header('location: /admin');
  }

  if (isset($_POST['addNow'])) {
    $query = $db->query("INSERT INTO pelajar(nama,icnum,kelas) VALUES('".$_POST['nama']."','".$_POST['icnum']."','".$_POST['kelas']."')");
    header("location: senaraikelas.php");
  }

  if (isset($_POST['upId'])) {
    $query = $db->query("UPDATE pelajar SET nama = '".$_POST['nama']."',icnum = '".$_POST['icnum']."',kelas = '".$_POST['kelas']."' WHERE id_pel = '".$_POST['upId']."'");
    header("location: senaraikelas.php");
  }

  if (isset($_POST['delId'])) {
    $query = $db->query("DELETE FROM pelajar WHERE id_pel = '".$_POST['delId']."'");
    header("location: senaraikelas.php");
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
            <h3><i class="fa fa-angle-right"></i> Pelajar </h3>
            <h4><i class="fa fa-angle-right"></i> Senarai Pelajar . </h4>

            <input type="text" value="" id="search" name="search" placeholder="Search By Name..." class="form-control" onkeyup="searchMe(this.value)">

          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
                        <div class="printah" style="padding-right: 25px;"><a onclick="PrintElem('no-more-tables')" class="btn btn-info" style="float: right; ">Print</a> </div>
              <h4><i class="fa fa-angle-right"></i> Senarai Nama Tingkatan Pelajar </h4><br>
                          <section id="no-more-tables">
							  
							  <?php $res = $db->query("SELECT * FROM pelajar ORDER BY kelas ASC"); ?>

                            

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Nama</th>
                                  <th>No IC</th>
                                  <th>Kelas</th>
                                  <th id="yahoo-com" style="width: 100px;text-align: center;">
                                    <a class="btn btn-success btn-xs" onclick="addNow()"><!-- <i class=" fa fa-check"></i> -->Tambah</a>
                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <tr class="noooooo">
                                <td><?php echo $no; ?></td>
                                <td class="ohnoooo"><?php echo $re['nama']; ?></td>
                                <td><?php echo $re['icnum']; ?></td>
                                <td><?php echo $re['kelas']; ?></td>
                                <td id="yahoo-com" style="text-align: center;">
                                  <a class="btn btn-primary btn-xs" onclick="upNow(<?php echo $re['id_pel']; ?>,<?php echo "'".$re["nama"]."'"; ?>,<?php echo "'".$re["icnum"]."'"; ?>,<?php echo "'".$re["kelas"]."'"; ?>)"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-danger btn-xs" onclick="delNow(<?php echo $re['id_pel']; ?>,<?php echo "'".$re["nama"]."'"; ?>)"><i class="fa fa-trash-o "></i></a>
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
      <input class="form-control" type="text" placeholder="Name" name="nama"><br>
      <input class="form-control" type="text" placeholder="IC Number" name="icnum"><br>
      <select class="form-control" name="kelas">
        <option value="1 LAMBDA">1 LAMBDA</option>
		 <option value="2 LAMBDA">2 LAMBDA</option>
		 <option value="3 LAMBDA">3 LAMBDA</option>
		 <option value="4 LAMBDA">4 LAMBDA</option>
		  <option value="5 LAMBDA">5 LAMBDA</option>
      </select><br>
      <div style="width: 100%;text-align: center;">
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
      <input id="hh_nama" class="form-control" type="text" placeholder="Name" name="nama"><br>
      <input id="hh_icnum" class="form-control" type="text" placeholder="IC Number" name="icnum"><br>
      <select id="hh_kelas" class="form-control" name="kelas">
        <option value="1 LAMBDA">1 LAMBDA</option>
		<option value="2 LAMBDA">2 LAMBDA</option>
		<option value="3 LAMBDA">3 LAMBDA</option>
		<option value="4 LAMBDA">4 LAMBDA</option>
		<option value="5 LAMBDA">5 LAMBDA</option>
      </select><br>
      <div style="width: 100%;text-align: center;">
        <a onclick="upNo()" class="btn btn-default" style="cursor: pointer;display: inline-block;">Cancel</a>
        <a onclick="document.getElementById('upNow').submit();" class="btn btn-primary" style="cursor: pointer;display: inline-block;">UPDATE</a>
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
      function upNow(id,nama,icnum,kelas) {
        document.getElementById('popupup').style.display = "block";
        document.getElementById('id_pelh').value = id;
        document.getElementById('nama_h').innerHTML = nama;
        document.getElementById('hh_nama').value = nama;
        document.getElementById('hh_icnum').value = icnum;
        document.getElementById('hh_kelas').value = kelas;
      }
      function upNo() {
        document.getElementById('popupup').style.display = "none";
      }
      function delNow(id,nama) {
        document.getElementById('popupdel').style.display = "block";
        document.getElementById('id_pela').value = id;
        document.getElementById('nama_a').innerHTML = nama;
      }
      function delNo() {
        document.getElementById('popupdel').style.display = "none";
      }
    </script>

  <script type="text/javascript">
    var rw = document.getElementsByClassName('noooooo');
    var nm = document.getElementsByClassName('ohnoooo');
    function searchMe(value) {
        value = value.toUpperCase();
        if ((value == "")||(value == null)) {
            for (var i = 0; i < nm.length; i++) {
                rw[i].style.display = 'table-row';
                nm[i].style.fontWeight = 'normal';
            }
        }else {
            for (var i = 0; i < nm.length; i++) {
                var s = nm[i].innerHTML.toUpperCase().includes(value);
                if (s == true) {
                    rw[i].style.display = 'table-row';
                    nm[i].style.fontWeight = 'bold';
                }else {
                    rw[i].style.display = 'none';
                }
            }
        }
    }
  </script>
  <script type="text/javascript" id="printah">
    function PrintElem(elem) {
      
      var mywindow = window.open('','PRINT','height=400,width=600');

      mywindow.document.write('<html><head><title>' + document.title + '</title>');
      mywindow.document.write('<link href="assets/css/bootstrap.css" rel="stylesheet"><link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" /><link href="assets/css/style.css" rel="stylesheet"><link href="assets/css/style-responsive.css" rel="stylesheet"><link href="assets/css/table-responsive.css" rel="stylesheet"><style>#yahoo-com{display:none;}</style>');
      mywindow.document.write('</head><body>');
      mywindow.document.write('<h1><center>Senarai Pelajar Tingkatan 2</center></h1>');
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
