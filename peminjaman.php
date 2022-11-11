<?php
session_start();
include 'db.php';


$TABLES['buku'] = $db->query("SELECT * FROM buku WHERE tingkatan=2");

  if ($_SESSION['AUTHENTIFICATION'] == 'admin') {
    header('location: /admin');
  }

  if (
    (isset($_POST['id_pelss'])) &&
    (isset($_POST['id_bukuss']))
  ) {
    foreach ($_POST as $key => $value) {
      $$key = $value;
    }

    $id_bukuss = "[".$id_bukuss."]";
    $id_bukuss = json_decode($id_bukuss,true);

    $c = 0;
    $querys = $db->query("SELECT * FROM buku");
    foreach ($querys as $key => $value) {
      if ($id_bukuss[$c] == 1) {
        $sss = "INSERT INTO rekod(id_pel,id_buku,denda,fulldenda,status) VALUES('".$id_pelss."','".$value['id_buku']."','0','0','Pinjam')";
      }else {
        $sss = "INSERT INTO rekod(id_pel,id_buku,denda,fulldenda,status) VALUES('".$id_pelss."','".$value['id_buku']."','0','0','Tiada')";
      }
      $query = $db->query($sss);
      $c++;
    }

    if ($query) {
      $output['redirect'] = 'https://projekakhir.tk/peminjaman.php';
      $output['pop_success'] = "Pinjam berjaya";
      $output['status'] = 'true';
    }else {
      $output['pop_alert'] = 'Oops';
      $output['redirect'] = '';
      $output['status'] = 'false';
    }
    header("location: peminjaman.php");
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
            <h3><i class="fa fa-angle-right"></i> Peminjaman </h3>
            <h4><i class="fa fa-angle-right"></i> Pilih pelajar yang ingin dilaksanakan. </h4>
			  
		       
          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Tingkatan 2 LAMBDA </h4>
                          <section id="no-more-tables">
 
							  <?php $pel = $db->query("SELECT * FROM pelajar WHERE kelas=2 ORDER BY kelas ASC"); ?>
                            

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Nama</th>
                                  <th>No IC</th>
								  
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php $no=1;foreach ($pel as $key => $rows): ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $rows['nama']; ?></td>
                                  <td><?php echo $rows['icnum']; ?></td>
								
                                  <td>
                                    <?php
                                      $rek = $db->query("SELECT * FROM rekod WHERE id_pel = '".$rows['id_pel']."'");
                                      ?>
									 
									  
                                    <?php if (mysqli_num_rows($rek) == 0): ?>
                                      <a onclick="popupMeh(<?php echo $rows['id_pel']; ?>, <?php echo "'".$rows['nama']."'"; ?>, <?php echo "'".$rows['icnum']."'"; ?>)" class="btn btn-success" style="float: right; color: white; cursor: pointer;margin: 0 25%;">Pinjam</a>
                                    <?php else: ?>
                                      <div style="text-align: center;">Done</div>
                                    <?php endif ?>
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

			  
			 
 
			  
<div id="popupmeh" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none; ">
  <div style="background-color: white; height: 500px; width: 550px; margin: 5% auto; border-radius: 5px; padding: 20px 30px;overflow-y:scroll;">
      <a style="float: right; margin: -10px -15px; cursor: pointer;" onclick="popdownMeh()">x</a>
      <form method="post" action="" id="pinjamNow">
      <input id="id_pels" type="hidden" name="id_pelss" value="">
      <p><b>NAMA:</b> <span id="namess"></span></p>
      <p><b>NO IC:</b> <span id="icc"></span></p>
      <hr>
      <p>Tingkatan 2</p>
      <table class="table table-bordered table-striped table-condensed cf">
        <thead>
          <tr>
            <th>Kod</th>
            <th>Judul</th>
            <th>Catatan</th>
            <th>Harga</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php $d=0;foreach ($TABLES['buku'] as $key => $value): ?>
          <tr>
            <td><?php echo $value['kod']; ?></td>
            <td><?php echo $value['judul']; ?></td>
            <td><?php echo $value['catatan']; ?></td>
            <td>RM<?php echo $value['harga']; ?></td>
            <td>
              <p>
                <input onchange="runNow(<?php echo $value['id_buku']; ?>)" type="radio" id="status_<?php echo $value['id_buku']; ?>_c[]" class="thisStat" name="status_<?php echo $value['id_buku']; ?>_c[]" value="0">&nbsp;Tiada
                &nbsp;&nbsp;
                <input onchange="runNow(<?php echo $value['id_buku']; ?>)" type="radio" id="status_<?php echo $value['id_buku']; ?>_c[]" class="thisStat" name="status_<?php echo $value['id_buku']; ?>_c[]" value="1" checked>&nbsp;Pinjam
              </p>
            </td>
          </tr>
        <?php $d++;endforeach ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <a onclick="document.getElementById('pinjamNow').submit();" class="btn btn-success" style="float: right; color: white; cursor: pointer;">Pinjam</a>
            </td>
          </tr>
        </tbody>
      </table>
      <input type="hidden" id="id_bukus" name="id_bukuss">
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
      function runNow(c) {
        var statuss = $("input[name='status_"+c+"_c[]']").map(function(){return $(this);}).get();
        for (var i = 0; i < statuss.length; i++) {
          if (statuss[i].prop('checked')) {
            var status = statuss[i].val();
            break;
          }
        }
        var s = new Array();
        var statuss = $(".thisStat").map(function(){return $(this);}).get();
        for (var i = 0; i < statuss.length; i++) {
          if (statuss[i].prop('checked')) {
            var status = statuss[i].val();
            s.push(status);
          }
        }
        $("#id_bukus").val(s);
      }
      function popupMeh(id,nama,icnum) {
        runNow(id);
        document.getElementById('popupmeh').style.display = "block";
        document.getElementById('id_pels').value = id;
        document.getElementById('namess').innerHTML = nama;
        document.getElementById('icc').innerHTML = icnum;

      }

      function popdownMeh() {
        document.getElementById('popupmeh').style.display = "none";
      }
    </script>

  </body>
</html>
		 
	