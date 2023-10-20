
<div class="sidebar">
        <!-- insert your sidebar items here -->
        <?php 
        include "checksession.php";
        if (isset($_SESSION['username'])){
          if (isset($_POST['logout'])) logout();
          $un = $_SESSION['username'];
            if($_SESSION['loggedin'] == 1){ ?>
            <h4>Logged in as <?php echo $un ?></h4>
            <form class="form_settings" method="post">
            <input  class="submit" type="submit" name="logout" value="Logout"> 
            </form>
          <?php 
            }
        }
        ?>
        <h3>Latest News</h3>
        Update from the Ministry of Health:10,710 community cases.

        
        <h3>Browse</h3>
        <ul>
          <li><a href="https://www.whitecliffe.ac.nz/technology">Whitecliffe Tech</a></li>
          <li><a href="https://cpp.iqualify.com/login">iQualify</a></li>
          <li><a href="https://ongaongamuseum.org.nz/">Ongaonga Museum </a></li>
          <li><a href="privacy.php">Privacy statement</a></li>
        </ul>
        <h3>Search</h3>
        <form method="post" action="#" id="search_form">
          <p>
            <input class="search" type="text" name="search_field" value="Enter keywords....." />
            <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" />
          </p>
        </form>
      </div>
     
      