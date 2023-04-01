<?php
  $baseref = "http://gola.unaux.com/";
  $link = explode('/',$_SERVER['REQUEST_URI']);
  $currentFile = end($link);
 /* print_r($link);
  echo "\t$currentFile";*/
?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php if($currentFile!="gola.php"){echo "collapsed";}?>" href="<?php echo $baseref; ?>gola.php">
          <i class="bi bi-grid" ></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- Cut has been made here -->
    </ul>

  </aside><!-- End Sidebar-->