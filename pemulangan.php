<?php
session_start();
include 'db.php';

$TABLES['buku'] = $db->query("SELECT * FROM buku WHERE tingkatan=2");

  if ($_SESSION['AUTHENTIFICATION'] == 'admin') {
    header('location: /admin');
  }

  if (isset($_POST['id_peld'])) {
    $bb = $db->query("SELECT * FROM rekod WHERE status = 'Pinjam' AND id_pel = '".$_POST['id_peld']."'");
    foreach ($bb as $key => $arr) {
      foreach ($_POST['status_'.$arr['id_buku'].'_c'] as $tf) {
        if ($tf == 1) {
          $sss = "UPDATE rekod SET status = 'Pulang' WHERE id_rekod = '".$arr['id_rekod']."'";
        }else {
          $v = $db->query("SELECT * FROM buku WHERE id_buku = '".$arr['id_buku']."'");
          $v = mysqli_fetch_array($v);
          $sss = "UPDATE rekod SET status = 'Hutang', denda = '".$v['harga']."' WHERE id_rekod = '".$arr['id_rekod']."'";
        }
        $query = $db->query($sss);
      }
    }
    
    $query = $db->query("SELECT * FROM rekod WHERE id_pel = '".$_POST['id_peld']."'");
    $o = 0;
    foreach ($query as $key => $value) {
      $o = $o + $value['denda'];
      if ($value['denda'] != 0) {
        $query = $db->query("INSERT INTO resit(id_rekod,id_pel,id_buku,denda,fulldenda) VALUES('".$value['id_rekod']."','".$value['id_pel']."','".$value['id_buku']."','".$value['denda']."','".$value['fulldenda']."')");
      }
    }
    $query = $db->query("UPDATE rekod SET fulldenda = '".$o."' WHERE id_pel = '".$_POST['id_peld']."'");

    $query = $db->query("SELECT * FROM rekod WHERE id_pel = '".$_POST['id_peld']."'");
    $p = mysqli_fetch_array($query);
    if ($p['fulldenda'] <= 0) {
      $query = $db->query("INSERT INTO resit(id_rekod,id_pel,id_buku,denda,fulldenda) VALUES('0','".$_POST['id_peld']."','0','0','0')");
      $query = $db->query("DELETE FROM rekod WHERE id_pel = '".$_POST['id_peld']."'");
    }

    if ($query) {
      $output['redirect'] = '<?php echo $DOMAIN ?>admin/';
      $output['pop_success'] = "Pinjam berjaya";
      $output['status'] = 'true';
    }else {
      $output['pop_alert'] = 'Oops';
      $output['redirect'] = '';
      $output['status'] = 'false';
    }
    header("location: pemulangan.php");
  }

  if (isset($_POST['id_pelm'])) {
    $bb = $db->query("SELECT * FROM rekod WHERE id_pel = '".$_POST['id_pelm']."'");
    $bb = mysqli_fetch_array($bb);

    $too = strval($bb['fulldenda']) - strval($_POST['amount']);
    $sss = "UPDATE rekod SET fulldenda = '".$too."' WHERE id_pel = '".$_POST['id_pelm']."'";
    $query = $db->query($sss);

    $query = $db->query("SELECT * FROM rekod WHERE id_pel = '".$_POST['id_pelm']."'");
    $p = mysqli_fetch_array($query);
    if ($p['fulldenda'] <= 0) {
      $query = $db->query("INSERT INTO resit(id_rekod,id_pel,id_buku,denda,fulldenda) VALUES('0','".$_POST['id_pelm']."','0','0','0')");
      $query = $db->query("DELETE FROM rekod WHERE id_pel = '".$_POST['id_pelm']."'");
    }

    if ($query) {
      $output['redirect'] = '<?php echo $DOMAIN ?>admin/';
      $output['pop_success'] = "Pinjam berjaya";
      $output['status'] = 'true';
    }else {
      $output['pop_alert'] = 'Oops';
      $output['redirect'] = '';
      $output['status'] = 'false';
    }
    header("location: pemulangan.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="<?php echo $DOMAIN ?>admin/">
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
            <h3><i class="fa fa-angle-right"></i> Pemulangan </h3>
            <h4><i class="fa fa-angle-right"></i> Pilih pelajar yang ingin dilaksanakan. </h4>
          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
      
        <div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Tingkatan 2 Lambda</h4>
                          <section id="no-more-tables">

                            <?php $res = $db->query("SELECT id_pel FROM rekod GROUP BY id_pel"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Nama</th>
                                  <th>No IC</th>
                                  <th>Info</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <?php
                                $pel = $db->query("SELECT * FROM pelajar WHERE id_pel = '".$re['id_pel']."'"); 
                                $rows = mysqli_fetch_array($pel);
                                $rekod = $db->query("SELECT * FROM rekod WHERE id_pel = '".$re['id_pel']."'"); 
                                $rec = mysqli_fetch_array($rekod);
                              ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $rows['nama']; ?></td>
                                  <td><?php echo $rows['icnum']; ?></td>
                                  <td>
                                    <?php
                                      $nsn = $db->query("SELECT * FROM rekod WHERE id_pel = '".$rows['id_pel']."' AND (status = 'Pulang' OR status = 'Hutang')");
                                      if (mysqli_num_rows($nsn)==0) {
                                        echo "Belum dipulangkan";
                                      }else {
                                        if ($rec['fulldenda'] == 0) {
                                          echo "<span style='color: green;'>Pemulangan Selesai</span>";
                                        }else {
                                          echo "<span style='color: red;'>Denda dikenakan sebanyak RM".$rec['fulldenda']."</span>";
                                        }
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php $rek = $db->query("SELECT * FROM rekod WHERE id_pel = '".$rows['id_pel']."' AND status = 'Pulang' OR id_pel = '".$rows['id_pel']."' AND status = 'Hutang'"); ?>
                                    <?php if (mysqli_num_rows($rek)==0): ?>
                                      <a onclick="popupMeh(<?php echo $rows['id_pel']; ?>)" class="btn btn-success" style="float: right; color: white; cursor: pointer;margin: 0 25%;">Pulang</a>
<div id="popupmeh_<?php echo $rows['id_pel']; ?>" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none;">
  <div style="background-color: white; height: 500px; width: 600px; margin: 5% auto; border-radius: 5px; padding: 20px 30px;overflow-y: scroll;">
      <a style="float: right; margin: -10px -15px; cursor: pointer;" onclick="popdownMeh(<?php echo $rows['id_pel']; ?>)">x</a>
      <form method="post" action="" id="pinjamNow_<?php echo $rows['id_pel']; ?>">
      <input id="id_pels" type="hidden" name="id_peld" value="<?php echo $rows['id_pel']; ?>">
      <p><b>NAMA:</b> <span id="namess"><?php echo $rows['nama']; ?></span></p>
      <p><b>NO IC:</b> <span id="icc"><?php echo $rows['icnum']; ?></span></p>
      <hr>
      Tingkatan 2 <br>
      <table class="table table-bordered table-striped table-condensed cf">
        <thead>
          <tr>
            <th>Kod</th>
            <th>Judul</th>
            <th>Tingkatan</th>
            <th>Harga</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="bruh">
        <?php $bb = $db->query("SELECT * FROM rekod WHERE status = 'Pinjam' AND id_pel = '".$re['id_pel']."'"); ?>
        <?php $d=0;foreach ($bb as $key => $values): ?>
          <?php
            $bu = $db->query("SELECT * FROM buku WHERE id_buku = '".$values['id_buku']."'"); 
            $value = mysqli_fetch_array($bu);
          ?>
          <tr>
            <td><?php echo $value['kod']; ?></td>
            <td><?php echo $value['judul']; ?></td>
            <td><?php echo $value['tingkatan']; ?></td>
            <td>RM<?php echo $value['harga']; ?></td>
            <td>
              <p>
                <input type="radio" class="thisStat" name="status_<?php echo $value['id_buku']; ?>_c[]" value="1" checked>&nbsp;Pulang
                &nbsp;&nbsp;
                <input type="radio" class="thisStat" name="status_<?php echo $value['id_buku']; ?>_c[]" style="margin: 0 100% 0 0;" value="0">&nbsp;Hutang
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
              <a onclick="document.getElementById('pinjamNow_<?php echo $rows['id_pel']; ?>').submit();" class="btn btn-success" style="float: right; color: white; cursor: pointer;margin: 0 25%;">Pulang</a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
</div>
                                    <?php else: ?>
                                      <?php $rek = $db->query("SELECT * FROM rekod WHERE id_pel = '".$rows['id_pel']."' AND status = 'Hutang'"); ?>
                                      <?php if (mysqli_num_rows($rek)==0): ?>
                                        <div style="text-align: center;">Done</div>
                                      <?php else: ?>
                                        <a onclick="popupMesh(<?php echo $rows['id_pel']; ?>)" class="btn btn-success" style="float: right; color: white; cursor: pointer;margin: 0 25%;">Bayar</a>
<div id="popupmesh_<?php echo $rows['id_pel']; ?>" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none;">
  <div style="background-color: white; height: 500px; width: 600px; margin: 5% auto; border-radius: 5px; padding: 20px 30px;">
      <a style="float: right; margin: -10px -15px; cursor: pointer;" onclick="popdownMesh(<?php echo $rows['id_pel']; ?>)">x</a>
      <form method="post" action="" id="bayarNow_<?php echo $rows['id_pel']; ?>">
      <input id="id_pels" type="hidden" name="id_pelm" value="<?php echo $rows['id_pel']; ?>">
      <p><b>NAMA:</b> <span id="namess"><?php echo $rows['nama']; ?></span></p>
      <hr>
      <table class="table table-bordered table-striped table-condensed cf">
        <thead>
          <tr>
            <th>Kod</th>
            <th>Judul</th>
            <th>Tingkatan</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody id="bruh">
        <?php $bb = $db->query("SELECT * FROM rekod WHERE status = 'Hutang' AND id_pel = '".$rows['id_pel']."'"); ?>
        <?php foreach ($bb as $key => $values): ?>
          <?php
            $bu = $db->query("SELECT * FROM buku WHERE id_buku = '".$values['id_buku']."'"); 
            $value = mysqli_fetch_array($bu);
          ?>
          <tr>
            <td><?php echo $value['kod']; ?></td>
            <td><?php echo $value['judul']; ?></td>
            <td><?php echo $value['tingkatan']; ?></td>
            <td>RM<?php echo $value['harga']; ?></td>
          </tr>
        <?php endforeach ?>
          <tr>
            <td colspan="4"></td>
          </tr>
          <tr>
            <td>
              <span style="color: gray;font-weight: bold;font-size: 14px;">Total: RM<?php echo $rec['fulldenda']; ?></span>
            </td>
            <td colspan="3">
              <span style="float: right;">
                <span style="font-size: 16px;display: inline-block;">RM</span>
                <input id="bayarInp" type="double" name="amount" placeholder="Amount" value="0.00" class="form-control" style="width: 100px;display: inline-block;">
                <a onclick="
                  if(document.getElementById('bayarInp').value != 0) {
                    document.getElementById('bayarNow_<?php echo $rows['id_pel']; ?>').submit();
                  }else{
                    alert('Please insert an amount of pay.')
                  }
                " class="btn btn-success" style="color: white; cursor: pointer;display: inline-block;">Bayar</a>
                
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
</div>
                                      <?php endif ?>
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
      function popupMeh(id) {
        document.getElementById('popupmeh_'+id).style.display = "block";
        document.getElementById('id_pels').value = id;
      }
      function popdownMeh(id) {
        document.getElementById('popupmeh_'+id).style.display = "none";
      }
      function popupMesh(id) {
        document.getElementById('popupmesh_'+id).style.display = "block";
        document.getElementById('id_pels').value = id;
      }
      function popdownMesh(id) {
        document.getElementById('popupmesh_'+id).style.display = "none";
      }
    </script>
    

  </body>
</html>
