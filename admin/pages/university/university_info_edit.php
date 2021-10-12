<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');

if (isset($_GET['university_id'])) {
  $university_id = $_GET['university_id'];
  $sql = "select * from university_information where id = '$university_id'";
  $result = $conn->query($sql);
  if ($row = mysqli_fetch_array($result)) {
    $university_name    = $row['university_name'];
    $establishment_year = $row['establishment_year'];
    $address            = $row['address'];
    $world_ranking      = $row['world_ranking'];
    $university_id      = $row['id'];
  }
}

if (isset($_POST['update'])) {

  //echo "Saju_".$_GET['university_id']; die;

  $university_name     = $_POST['university_name'];
  $establishment_year  = $_POST['establishment_year'];
  $address             = $_POST['address'];
  $world_ranking       = $_POST['world_ranking'];
  $university_id       = $_POST['university_id'];

  $sql = "update university_information set university_name='$university_name', establishment_year='$establishment_year', address='$address', world_ranking='$world_ranking' where id=$university_id";

  $result = $conn->query($sql);

  if ($result) {
    echo "Update Successfully!";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
  }
}
?>

<head>
  <?php include('header_resources.php');   ?>
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
        <h3> university Information</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">

              <form class="form-horizontal style-form" action="university_info_edit.php" method="post">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">university Name</label>
                  <div class="col-sm-6">
                    <input type="text" name="university_name" value="<?php echo $university_name;  ?>" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Establishment Year</label>
                  <div class="col-sm-6">
                    <input type="text" name="establishment_year" value="<?php echo $establishment_year;  ?>" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Address`</label>
                  <div class="col-sm-6">
                    <input type="text" name="address" value="<?php echo $address;  ?>" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">World Ranking Position</label>
                  <div class="col-sm-6">
                    <input type="text" name="world_ranking" value="<?php echo $world_ranking;  ?>" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-8" align="center">
                    <input type="submit" name="update" value="Update" class="btn btn-info">

                    <input type="hidden" name="university_id" value="<?php echo $university_id;  ?>" class="btn btn-info">
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