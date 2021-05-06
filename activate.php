<?php
require_once './config.php';

if (isset($_GET["id"])) {
  $id = intval(base64_decode($_GET["id"]));

  $sql = "SELECT * from registered_user where id = :id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {

      if ($result[0]["status"] == "approved") {
        $msg = "Your account has already been activated.";
        $msgType = "info";
      } else {
        $sql = "UPDATE `registered_user` SET  `status` =  'approved' WHERE `id` = :id";
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $msg = "Your account has been activated.";
        $msgType = "success";
      }
    } else {
      $msg = "No account found";
      $msgType = "warning";
    }
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}

include './header.php';
?>
<br><br>
<?php if ($msg <> "") { ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <h3>Dear User, <br>
          <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
            <?php echo $msg; ?>
          </div> Thank you for registering with us.
        </h3>
      </div>
    </div>
  </div>
  <br><br>
<?php } ?>
<?php
include './footer.php';
?>