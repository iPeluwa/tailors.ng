<?php
require_once './config.php';

if (isset($_GET["id"])) {
  $id = intval(base64_decode($_GET["id"]));
 
  $sql = "SELECT * from registered_brands where id = :id";
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
        $sql = "UPDATE `registered_brands` SET  `status` =  'approved' WHERE `id` = :id";
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
<?php if ($msg <> "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>
<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <h1>Thank you for registering with us.</h1>
    </div>
  </div>
</div>

<?php
include './footer.php';
?>