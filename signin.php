<?php include_once 'header.php'; ?>
<?php
require("config.php");
if (isset($_SESSION["username"]) || $_SESSION["username"] != "") {
    //if user already logged in
    redirect("user/home/");
}

$errMSG = "";
if (isset($_POST["mode"]) && $_POST["mode"] == "login") {

    //valiadte uerinput for security checks
    // add addslashes() function to prevent from sql injections
    $uname = trim($_POST["uname"]);
    $pass = trim($_POST["upass"]);
    $rem = trim($_POST["remember_me"]);

    if ($uname == "" || $pass == "") {
        $errMSG = errorMessage("Enter credentials properly!");
    } else {

        // check if username exist 
        $sql = "SELECT * FROM registered_user where username = :uname";
        try {
            $stmt = $DB->prepare($sql);
            $stmt->bindValue(":uname", $uname);
            $stmt->execute();
            $usernameRS = $stmt->fetchAll();
            foreach($usernameRS as $row);
        } catch (Exception $ex) {
            echo errorMessage($ex->getMessage());
        }

        if (count($usernameRS) > 0) {
            // user exist
            $sql = "SELECT * FROM registered_user where username = :uname AND password = :pwd";
            try {
        if (password_verify($pass, $row['password'])) {
          $correct = $row['password'];
        } else {
          echo "";
        }
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":uname", $uname);
                $stmt->bindValue(":pwd", $correct);
                
                $stmt->execute();
                $userRS = $stmt->fetchAll();
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }

            if (count($userRS) > 0 ) {
                // user exist 
                // now check if the status of the user
                if ($userRS[0]["status"] == 'approved') {

                    $_SESSION["username"] = $userRS[0]["username"];

                    if ($rem == 1) {
                        // if user select to remember 
                        setcookie("userame", $uname, time() + 7200);
                    } else {
                        setcookie("userame", $uname, time() - 7200);
                    }

                    redirect("user/home/");
                } else {
                    // user exist but the status is inactive
                     $errTYP = "danger";
                    $errMSG = errorMessage("Sorry!!! But the account is temporary suspended.");
                }
            } else {
                $errTYP = "warning";
                $errMSG = errorMessage("Sorry!!! Either the username of the password mismatch.");
            }
        } else {
      // no user exist with same name
            $errTYP = "danger";
            $errMSG = errorMessage("Sorry!!! No user with such name exist");
        }
    }
}
$userame = (isset($_COOKIE["userame"]) && $_COOKIE["userame"] != "") ? $_COOKIE["userame"] : "";
// echo $pwdCheck;
// echo $row['password'];
// echo $pass;

?>
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
               
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  


    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 mb-5"  data-aos="fade">

            

            <form method="post" action="" class="p-5 bg-white" autocomplete="off" >
               <input type="hidden" value="login" name="mode" />
              <h1 class="row justify-content-center">SIGN IN TO CONTINUE</h1>
                <?php if ($errMSG <> "") { ?>
            <div class="alert alert-dismissable alert-<?php echo $errTYP; ?>">
              <button data-dismiss="alert" class="close" type="button">x</button>
              <p><?php echo $errMSG; ?></p>
            </div>
             <?php } ?> 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Username</label> 
                  <input type="text" name="uname" value="<?php echo $userame; ?>" class="form-control">
                </div>
              </div>

              <div class="row form-group">    
                <div class="col-md-12">
                  <label class="text-black">Password</label> 
                  <input type="password" name="upass" class="form-control">
                </div>
              </div>
            
               <div class="row form-group">
              <div class="col-md-12">
                  <label class="text-black">
                 <input type="checkbox" value="1" name="remember_me" <?php echo ($userame != "") ? 'checked' : ''; ?>> Remember Me</label> 
                </div>
              </div>
               
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="sub" value="Login" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>
          <p> Don't have an account? <a href="signup">Sign up</a></p>

        
        <hr>

        <p style="text-align:center;">
        <small><a href="forgotpassword">Forgot password?</a></small></p>

  
            </form>
          </div>
         

          </div>
        </div>
      </div>
    </div>
          
        </div>
        
      </div>
    </div>
    
<?php include_once 'footer.php'; ?>