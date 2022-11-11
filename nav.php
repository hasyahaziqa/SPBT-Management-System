      <!--sidebar start-->
     <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>

              	  <h5 class="centered"><?php echo $_USER['username']; ?></h5>

                  <li class="mt">
                      <a href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
				  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>P&P</span>
                      </a>
					  
					 
                      <ul class="sub">
                          <li><a  href="peminjaman.php">Peminjaman</a></li>
                          <li><a  href="pemulangan.php">Pemulangan</a></li>
						  
                      </ul>
					  
					  <ul class="sub">
					  <li><a  href="senaraibuku.php">Senarai Buku</a></li>
						  <li><a  href="senaraikelas.php">Senarai Kelas</a></li>
					  </ul>
					 
                  </li>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->