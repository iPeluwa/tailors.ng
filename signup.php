<?php
require_once './config.php';
if (isset($_POST["sub"])) {
  require_once "phpmailer/class.phpmailer.php";

  $name = trim($_POST["uname"]);
  $email = trim($_POST["email"]);
  $upass = trim($_POST["upass"]);

  $sql = "SELECT COUNT(*) AS count from registered_user where email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      $msg = "Email already exist";
      $msgType = "warning";
    } else {
      $sql = "INSERT INTO `registered_user`(`username`, `email`, `password`) VALUES ( :name, :email, :upass)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":upass", password_hash($upass, PASSWORD_DEFAULT));
      $stmt->execute();
      $result = $stmt->rowCount();


      if ($result > 0) {
       
        $lastID = $DB->lastInsertId();

        $message = '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
<!--[if gte mso 9]><xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml><![endif]-->
<title>Brand Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0 ">
<meta name="format-detection" content="telephone=no">
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<!--<![endif]-->
<style type="text/css">
body {
	margin: 0 !important;
	padding: 0 !important;
	-webkit-text-size-adjust: 100% !important;
	-ms-text-size-adjust: 100% !important;
	-webkit-font-smoothing: antialiased !important;
}
img {
	border: 0 !important;
	outline: none !important;
}
p {
	Margin: 0px !important;
	Padding: 0px !important;
}
table {
	border-collapse: collapse;
	mso-table-lspace: 0px;
	mso-table-rspace: 0px;
}
td, a, span {
	border-collapse: collapse;
	mso-line-height-rule: exactly;
}
.ExternalClass * {
	line-height: 100%;
}
.em_defaultlink a {
	color: inherit !important;
	text-decoration: none !important;
}
span.MsoHyperlink {
	mso-style-priority: 99;
	color: inherit;
}
span.MsoHyperlinkFollowed {
	mso-style-priority: 99;
	color: inherit;
}
 @media only screen and (min-width:481px) and (max-width:699px) {
.em_main_table {
	width: 100% !important;
}
.em_wrapper {
	width: 100% !important;
}
.em_hide {
	display: none !important;
}
.em_img {
	width: 100% !important;
	height: auto !important;
}
.em_h20 {
	height: 20px !important;
}
.em_padd {
	padding: 20px 10px !important;
}
}
@media screen and (max-width: 480px) {
.em_main_table {
	width: 100% !important;
}
.em_wrapper {
	width: 100% !important;
}
.em_hide {
	display: none !important;
}
.em_img {
	width: 100% !important;
	height: auto !important;
}
.em_h20 {
	height: 20px !important;
}
.em_padd {
	padding: 20px 10px !important;
}
.em_text1 {
	font-size: 16px !important;
	line-height: 24px !important;
}
u + .em_body .em_full_wrap {
	width: 100% !important;
	width: 100vw !important;
}
}
</style>
</head> 
<body class="em_body" style="margin:0px; padding:0px;" bgcolor="#efefef">';
        $message .= '<table class="em_full_wrap" valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
  <tbody><tr>
    <td valign="top" align="center"><table class="em_main_table" style="width:700px;" width="700" cellspacing="0" cellpadding="0" border="0" align="center">
        <!--Header section-->
        <tbody><tr>
          <td style="padding:15px;" class="em_padd" valign="top" bgcolor="" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              </table></td>
        </tr>
        <!--//Header section--> 
        <!--Banner section-->
        <tr>
          <td valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td valign="top" align="center"><img class="em_img" alt="Tailors.ng" style="display:block; font-family:Arial, sans-serif; font-size:30px; line-height:34px; color:#000000; max-width:700px;" src="https://images.unsplash.com/photo-1502217625004-89c03571bcca?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" width="700" border="0" height="345"></td>
              </tr>
            </tbody></table></td>
        </tr>
        <!--//Banner section--> 
        <!--Content Text Section-->
                 <tr>
          <td style="padding:35px 70px 30px;" class="em_padd" valign="top" bgcolor="#B666D2" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>';
                $message .= "<tr> <td style='font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;' valign='top' align='left'>
                <h1>Dear $name,</h1></td>
              </tr>
              
                <td style='font-size:0px; line-height:0px; height:15px;' height='15'>&nbsp;</td>
<!--—this is space of 15px to separate two paragraphs ---->
              </tr>
              <tr>
                <td style='font-family:'Comic Sans Ms', Arial, sans-serif; font-size:18px; line-height:22px; color:#ffff; letter-spacing:2px; padding-bottom:12px;' valign='top' align='left'>
                    <p></p>Thank you for registering with Tailors.ng. Your Account needs to be acivated to get you started.
		             <a style='color:#fbeb59;' href='".SITE_URL.'activate.php?id=' . base64_encode($lastID) . "'>CLICK TO ACTIVATE</a>.</p><br>
					 <p>
					 We look forward to seeing your BRAND in Action!.</p></td>
              </tr>";
              $message .= "
              <tr>
                <td class='em_h20' style='font-size:0px; line-height:0px; height:25px;' height='25'>&nbsp;</td>
<!--—this is space of 25px to separate two paragraphs ---->
              </tr>
              <tr>
                <td style='font-family:'Open Sans', Arial, sans-serif; font-size:18px; line-height:22px; color:#fbeb59; text-transform:uppercase; letter-spacing:2px; padding-bottom:12px;' valign='top' align='left'>
                ";
              $message .= '<div>Kind Regards,</div>
                <div>Tailors.ng</div>
                <div>users@tailors.ng</div>    
                </td>
              </tr>
            </tbody></table></td>
        </tr>
 
        <!--//Content Text Section--> 
        <!--Footer Section-->
        <tr>
          <td style="padding:38px 30px;" class="em_padd" valign="top" bgcolor="#f6f7f8" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="padding-bottom:16px;" valign="top" align="center"><table cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/facebook_circle-512.png" alt="fb" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:26px;" width="26" border="0" height="26"></a></td>
                      <td style="width:6px;" width="6">&nbsp;</td>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://cdn1.iconfinder.com/data/icons/iconza-circle-social/64/697029-twitter-512.png" alt="tw" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:27px;" width="27" border="0" height="26"></a></td>
                      <td style="width:6px;" width="6">&nbsp;</td>
                      <td valign="top" align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="https://cdn2.iconfinder.com/data/icons/social-icons-33/128/Instagram-512.png" alt="ig" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px; color:#ffffff; max-width:26px;" width="26" border="0" height="26"></a></td>
                    </tr>
                  </tbody></table></td>
              </tr>';
              $message .= "<tr>
                <td style='font-family:'Open Sans', Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;' valign='top' align='center'><a href='#' target='_blank' style='color:#999999; text-decoration:underline;'>PRIVACY STATEMENT</a> | <a href='#' target='_blank' style='color:#999999; text-decoration:underline;'>TERMS OF SERVICE</a> | <a href='#' target='_blank' style='color:#999999; text-decoration:underline;'>RETURNS</a><br>
                  © 2019 Tailors.ng. All Rights Reserved.</td>
              </tr>
            </tbody></table></td>
        </tr>
        <tr>
          <td class='em_hide' style='line-height:1px;min-width:700px;background-color:#ffffff;'><img alt='' src='images/spacer.gif' style='max-height:1px; min-height:1px; display:block; width:700px; min-width:700px;' width='700' border='0' height='1'></td>
        </tr>
      </tbody></table></td>
  </tr>
</tbody></table>
<div class='em_hide' style='white-space: nowrap; display: none; font-size:0px; line-height:0px;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
";
        $message .= "</body></html>";
        

        // php mailer code starts
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP

        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server

        $mail->Username = 'ipeluwa@gmail.com';
        $mail->Password = 'luway2012@@';

        $mail->SetFrom('noreply@tailors.ng', 'Tailor.ng');
        $mail->AddAddress($email);

        $mail->Subject = trim("User Registration");
        $mail->MsgHTML($message);

        try {
          $mail->send();
          $msg = "An email has been sent for verfication.";
          $msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          $msgType = "warning";
        }
      } else {
        $msg = "Failed to create User";
        $msgType = "warning";
      }
    }
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}
			
?>
<?php include_once 'header.php'; ?>

  
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

            

            <form action="signup.php" method="post" name="f" class="p-5 bg-white" >
              <h1 class="row justify-content-center">SIGN IN TO CONTINUE</h1>
<?php if ($msg <> "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>
               <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="uname">Username</label> 
                  <input type="text" name="uname" value="" autocomplete="off" class="form-control">
                </div>
              </div>
            
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" name="email" value="" autocomplete="off" class="form-control">
                </div>
              </div>

              <div class="row form-group">    
                <div class="col-md-12">
                  <label class="text-black" for="subject">Password</label> 
                  <input type="password" name="upass" class="form-control">
                </div>
              </div>
               
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="sub" value="Sign Up" class="btn btn-primary py-2 px-4 text-white">
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