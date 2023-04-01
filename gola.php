<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include "header.php"; 
        include "aside.php";
        
  ?>

  <?php
    $path = "Data/users/";
    $path .= $_SESSION['uname'];
    $relativepath="";
    if(isset($_GET['dir'])){
      $relativepath = $_GET['dir'];
      $path .= $_GET['dir'];
    }
    $temprelativepath = $relativepath;
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Gola Drive</h1> 
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="gola.php">Home</a></li>
          <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <form method="POST" enctype="multipart/form-data" action="php/fileupload.php">
    <div class="row mb-4">
      <div class="col-6 col-sm-6 col-md-3">
        <input class="form-control" type="file" name="files[]" id="formFile" multiple>
        <?php echo "<input type=\"hidden\" name=\"dir\" value=\"".$relativepath."\" >"; ?>
      </div>
      <div class="col-6 col-sm-6 col-md-3">
        <input class="btn btn-primary" type="submit" value="Upload" name="fileupload"/>
      </div> 
    </div>
    </form>
    

    <section class="section dashboard">
      
      <div class="row"> <!-- For Folders -->
        <!-- Left side columns -->
        <div class="col-12">
          <div class="row">

            <?php
             
            $dirs = $directories = glob($path . '/*' , GLOB_ONLYDIR);

              foreach ($dirs as $key => $value) {
                $value = explode("/",$value);
                echo "<div class=\"col-6 col-sm-4 col-md-3 col-lg-2\">";
                  echo "<div class=\"card text-center\">";
                    echo "<form method=\"GET\">";
                      echo "<button type=\"submit\" class=\"card-body\" style=\"padding-bottom: 0px;border:none;background:transparent;\">";

                      
                        echo "<input type=\"hidden\" name=\"dir\" value=\"".($relativepath."/".end($value))."\" >";
                        echo "<i class=\"fa fa-folder\" style=\"font-size:5vw;color: #4797f6;margin-top:10px;\"></i>";
                        echo "<p style=\"padding:0px;font-size:12px\">".end($value)."</p>";
                        //echo "<p class=\"card-text text-center\"><i class=\"fa fa-download\"></i></p>";
                      echo "</button>";
                    echo "</form>";
                  echo "</div>";
                echo "</div>";
              }

            ?>

            <!-- New Folder -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
              <div class="card text-center">
                <form method="GET" action="php/newFolder.php">
                  <div class="card-body" style="padding-bottom: 0px;border:none;background:transparent;">    
                  <i class="fa fa-plus" style="font-size:2vw;color: #4797f6;margin-top:10px;"></i>
                  <input type="text" name="folderName" class="form-control">
                  <input type="hidden" name="dir" value="<?php echo $relativepath ?>" >
                  <p style="padding:10px;font-size:12px"><input type="submit" name="createFolder" value="New Folder" class="btn-primary"></p>
                  </div>
                </form>
              </div>
            </div>
            <!-- End New Folder -->

          </div>
        </div><!-- End Left side columns -->
      </div>

      

      <div class="row"> <!-- For FILES -->
        <!-- Left side columns -->
        <div class="col-12">
          <div class="row">

            <?php
            
            $files = glob($path . '/*.{*}' , GLOB_BRACE);

              foreach ($files as $key => $value) {
                $value = explode("/",$value);
                echo "<div class=\"col-6 col-sm-4 col-md-3 col-lg-2\">";
                  echo "<div class=\"card text-center\">";
                    echo "<form method=\"POST\">";
                      echo "<div type=\"submit\" class=\"card-body\" style=\"padding-bottom: 0px;\">";
                        
                        $t = explode('.',end($value));

                        echo "<i class=\"".getFileFont(end($t))."\" style=\"font-size:5vw;color: #4797f6;margin-top:10px;\"></i>";
                        echo "<p style=\"padding:0px;font-size:12px\">".current($value)."</p>";
                        echo "<p class=\"card-text text-center\"><a href=\"download.php?file=".($relativepath."/".current($value))."\" target=\"_blank\"><i class=\"fa fa-download\"></i></a> &nbsp|&nbsp <a href=\"php/deletefile.php?file=".($relativepath."/".current($value))."\" ><i class=\"fa fa-trash\"></i></a></p>";
                      echo "</div>";
                    
                  echo "</div>";
                echo "</div>";
              }


              function getFileFont($a){
                $a = strtolower($a);
                if($a=="pdf"){
                  return "fa fa-file-pdf-o";
                }
                else if($a=="docx" || $a=="doc"){
                  return "fa fa-file-word-o";
                }
                else if($a=="txt"){
                  return "fa fa-file-text-o";
                }
                else if($a=="html" || $a=="xml"){
                  return "fa fa-file-code-o";
                }
                else if($a=="xlsx" || $a=="csv"){
                  return "fa fa-file-excel-o";
                }
                else if($a=="ppt" || $a=="pptx"){
                  return "fa fa-file-code-o";
                }
                else if($a=="jpg" || $a=="png" || $a=="jpeg" || $a=="gif" || $a=="bmp" || $a=="apng" || $a=="jfif" || $a=="webp"){
                  return "fa fa-file-photo-o";
                }
                else if($a=="zip" || $a=="rar" || $a=="7zip"){
                  return "fa fa-file-zip-o";
                }
                else{
                  return "fa fa-file-o";
                }
              }
            ?>

          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>