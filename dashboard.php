<?php
  include 'db.php';
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

    <title>E-Borrow</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
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
          <section class="wrapper"><br><br>
            <h3><i class="fa fa-angle-right"></i> Senarai Pelajar yang Berhutang.</h3>
          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Tingkatan 2 Lambda</h4>
						  
                          <section id="no-more-tables">

                            <?php $res = $db->query("SELECT id_pel FROM rekod WHERE status = 'Hutang' GROUP BY id_pel"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Nama</th>
                                  <th>No IC</th>
                                  <th>Info</th>
                                 
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
                                      $nsn = $db->query("SELECT * FROM rekod WHERE id_pel = '".$rows['id_pel']."' AND status = 'Hutang'");
                                      if (mysqli_num_rows($nsn)==0) {
                                        echo "<span style='color: red;'>Denda dikenakan sebanyak RM".$rec['fulldenda']."</span>";
                                      }else {
                                        if ($rec['fulldenda'] == 0) {
                                          echo "<span style='color: green;'>Pemulangan Selesai</span>";
                                        }else {
                                          echo "<span style='color: red;'>Denda dikenakan sebanyak RM".$rec['fulldenda']."</span>";
                                        }
                                      }
                                    ?>
                                  </td>
                                 </tr>                                      
                            <?php $no++;endforeach ?>
                              </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

              <hr>
              <h3><i class="fa fa-angle-right"></i> Selesai Pembayaran.</h3>
          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Tingkatan 2 Lambda</h4>
						  
			   

          <div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
						  
                          <section id="no-more-tables">
						 <?php $res = $db->query("SELECT * FROM pelajar ORDER BY nama ASC"); ?>
						
					

                            <?php $res = $db->query("SELECT id_pel FROM resit WHERE id_rekod = 0 GROUP BY id_pel"); ?>

                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead>
                              <tr>
                                  <th>Bil</th>
                                  <th>Nama</th>
                                  <th>No IC</th>
                                  <th>Info</th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php  $no=1;foreach ($res as $key => $re): ?>
                              <?php
                                $pel = $db->query("SELECT * FROM pelajar WHERE id_pel = '".$re['id_pel']."'"); 
                                $rows = mysqli_fetch_array($pel);
                              ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $rows['nama']; ?></td>
                                  <td><?php echo $rows['icnum']; ?></td>
                                  <td>
                                    <?php
                                      $nsn = $db->query("SELECT * FROM resit WHERE id_pel = '".$rows['id_pel']."'");
                                      $mm = 0;
                                      foreach ($nsn as $key => $value) {
                                        $mm = $mm + $value['denda'];
                                      }
                                      if ($mm == 0) {
                                        echo "<span style='color: green;'>Pemulangan Selesai</span>";
                                      }else {
                                        echo "<span style='color: green;float:left;'>Bayaran Selesai<br>Sebanyak RM";
                                        printf("%.2f",$mm);
                                        echo "</span><a onclick='popupMeh(".$rows['id_pel'].")' class='btn btn-success' style='float: right; color: white; cursor: pointer;'>Print Resit</a>";
                                      }
                                    ?>
  <div id="popupmeh_<?php echo $rows['id_pel']; ?>" style="background-color: rgba(0,0,0,0.2);position: fixed; left: 0; top: 0; height: 100%; width: 100%; z-index: 1000;display: none;">
      <p><b>NAMA:</b> <span id="namess"><?php echo $rows['nama']; ?></span></p>
      <p><b>NO IC:</b> <span id="icc"><?php echo $rows['icnum']; ?></span></p>
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
        <?php $bb = $db->query("SELECT * FROM resit WHERE id_pel = '".$rows['id_pel']."'"); ?>
        <?php
          $d=0;$mm=0;
          foreach ($bb as $key => $values):
        ?>
        <?php $mm = $mm + $values['denda'];if ($values['id_buku'] != 0): ?>
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
        <?php endif; ?>
        <?php $d++;endforeach ?>
          <tr>
            <td colspan="3" style="text-align: right;font-weight: bold;font-size: 20px;">Jumlah:</td>
            <td style="font-weight: bold;font-size: 20px;">RM<?php printf("%.2f",$mm); ?></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
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
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    <script src="assets/js/zabuto_calendar.js"></script>  
	  
	 
	  
	  
	  
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
    function popupMeh(id) {
      PrintElem('popupmeh_'+id);
    }
    function PrintElem(elem) {
      var mywindow = window.open('','PRINT','height=400,width=600');

      mywindow.document.write('<html><head><title>' + document.title + '</title>');
      mywindow.document.write('<link href="assets/css/bootstrap.css" rel="stylesheet"><link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" /><link href="assets/css/style.css" rel="stylesheet"><link href="assets/css/style-responsive.css" rel="stylesheet"><link href="assets/css/table-responsive.css" rel="stylesheet"><style>#yahoo-com{display:none;}</style>');
      mywindow.document.write('</head><body>');
      mywindow.document.write('<h1><center>Resit Bayaran Hutang Buku Pinjaman</center></h1>');
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
