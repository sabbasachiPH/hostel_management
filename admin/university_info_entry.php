<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');

if (isset($_POST['save'])) {
  $university_name     = $_POST['university_name'];
  $establishment_year   = $_POST['establishment_year'];
  $address   = $_POST['address'];
  $world_ranking   = $_POST['world_ranking'];

  $sql = "insert into university_information(university_name, establishment_year, address, world_ranking) 
          values ('$university_name', '$establishment_year', '$address', '$world_ranking')";

  $result = $conn->query($sql);

  if ($result == 1) {
    // echo "Successfully Inserted!";
    echo "<script>alert('Successfully Inserted!');</script>";
    header("Location: university_info_listview.php");
  }
}
?>

<head>
  <?php $title = "University Entry Page";
  include('header_resources.php');   ?>
</head>

<body>
  <section id="container">

    <?php

    include('header.php');

    include('nav.php');


    ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3> University Information</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">

              <form class="form-horizontal style-form" action="university_info_entry.php" method="post">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">University Name</label>
                  <div class="col-sm-6">
                    <input type="text" name="university_name" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Establishment Year</label>
                  <div class="col-sm-6">
                    <input type="text" name="establishment_year" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">University Address</label>
                  <div class="col-sm-6">
                    <input type="text" name="address" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">World Ranking Position</label>
                  <div class="col-sm-6">
                    <input type="text" name="world_ranking" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-8" align="center">
                    <input type="submit" name="save" class="btn btn-info">
                  </div>
                </div>

              </form>
            </div>
          </div>
          <!-- col-lg-12-->
        </div>



        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->

    <!--footer end-->
  </section>

  <?php include('footer_resources.php');  ?>

</body>

</html>