<?php
require_once './config.php';
if (isset($_POST["sub"])) {
  require_once "phpmailer/class.phpmailer.php";

  $bname = trim($_POST["bname"]);
  $bemail = trim($_POST["bemail"]);
  $bnumber = trim($_POST["bnumber"]);
  $bweb = trim($_POST["bweb"]);
  $bstate = trim($_POST["bstate"]);
  $bcity = trim($_POST["bcity"]);
  $baddress = trim($_POST["baddress"]);
  $aname = trim($_POST["aname"]);
  $aemail = trim($_POST["aemail"]);

  $sql = "SELECT COUNT(*) AS count from registered_brands where bemail = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $bemail);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      $msg = "Email already exist";
      $msgType = "warning";
    } else {
      $sql = "INSERT INTO `registered_brands`(`bname`, `bemail`, `bnumber`, `bweb`, `bstate`, `bcity`, `baddress`, `aname`, `aemail`) VALUES ( :bname, :bemail, :bnumber, :bweb, :bstate, :bcity, :baddress, :aname, :aemail)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":bname", $bname);
      $stmt->bindValue(":bemail", $bemail);
      $stmt->bindValue(":bnumber", $bnumber);
	  $stmt->bindValue(":bweb", $bweb);
	  $stmt->bindValue(":bstate", $bstate);
	  $stmt->bindValue(":bcity", $bcity);
	  $stmt->bindValue(":baddress", $baddress);
	  $stmt->bindValue(":aname", $aname);
	  $stmt->bindValue(":aemail", $aemail);
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
                <h1>Dear $aname,</h1></td>
              </tr>
              
                <td style='font-size:0px; line-height:0px; height:15px;' height='15'>&nbsp;</td>
<!--—this is space of 15px to separate two paragraphs ---->
              </tr>
              <tr>
                <td style='font-family:'Comic Sans Ms', Arial, sans-serif; font-size:18px; line-height:22px; color:#ffff; letter-spacing:2px; padding-bottom:12px;' valign='top' align='left'>
                    <p></p>Thank you for registering your Brand with Tailors.ng. Your registration needs to be acivated to get your brand listed
		             <a style='color:#fbeb59;' href='".SITE_URL.'activate_brand.php?id=' . base64_encode($lastID) . "'>CLICK TO ACTIVATE</a>.</p><br>
					 <p></p>If you would like to view your make changes to the information provided,
					 you can mail <a style='color:#fbeb59;' href='mailto:list@tailors.ng'>list@tailors.ng</a> or call our customer support line (234) 095-2220-341.</p><br>
					 If you have any questions, feel free to reply to this email.
					 We look forward to seeing your BRAND in Action!.</td>
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
                <div>brands@tailors.ng</div>    
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

        $mail->Username = '';
        $mail->Password = '';

        $mail->SetFrom('', 'Tailor.ng');
        $mail->AddAddress($aemail);

        $mail->Subject = trim("Brand Registration");
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
  
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5"  data-aos="fade">
             <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12 bg-white">
            
            
            <div class="row justify-content-center">
              <div class="col-md-12 text-center">
                <h1>Add your brand on Tailors.ng</h1>
              </div>
            </div>

            
          </div>
        </div>
      </div>
            <form action="add.php" method="post" name="f" class="p-5 bg-white" onsubmit="return validateForm();">
 <?php if ($msg <> "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?> 
             <h4 data-aos="fade-down" class="brand-add-category">Brand Information</h4>
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="Name">Brand Name</label> 
                  <input type="text" id="bname" name="bname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="bemail" name="bemail" class="form-control">
                </div>
              </div>

              
              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="pnumber">Phone Number</label>
                  <input type="text" id="bnumber" name="bnumber" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="website">Website</label>
                  <input type="url" id="bweb" name="bweb" class="form-control">
                </div>
              </div>
              
               <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">State</label>
                  <select id="bstate" name="bstate" class="form-control">
                      <option>Select State</option>
                                <option value="1">Abia</option>
                                <option value="2">Abuja</option>
                                <option value="3">Adamawa</option>
                                <option value="4">Akwa Ibom</option>
                                <option value="5">Anambra</option>
                                <option value="6">Bauchi</option>
                                <option value="7">Bayelsa</option>
                                <option value="8">Benue</option>
                                <option value="9">Borno</option>
                                <option value="10">Cross River</option>
                                <option value="11">Delta</option>
                                <option value="12">Ebonyi</option>
                                <option value="13">Edo</option>
                                <option value="14">Ekiti</option>
                                <option value="15">Enugu</option>
                                <option value="16">Gombe</option>
                                <option value="17">Imo</option>
                                <option value="18">Jigawa</option>
                                <option value="19">Kaduna</option>
                                <option value="20">Kano</option>
                                <option value="21">Katsina</option>
                                <option value="22">Kebbi</option>
                                <option value="23">Kogi</option>
                                <option value="24">Kwara</option>
                                <option value="25">Lagos</option>
                                <option value="26">Nasarawa</option>
                                <option value="27">Niger</option>
                                <option value="28">Ogun</option>
                                <option value="29">Ondo</option>
                                <option value="30">Osun</option>
                                <option value="31">Oyo</option>
                                <option value="32">Plateau</option>
                                <option value="33">Rivers</option>
                                <option value="34">Sokoto</option>
                                <option value="35">Taraba</option>
                                <option value="36">Yobe</option>
                                <option value="37">Zamfara</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="city">City/Town</label>
                  <input type="text" id="bcity" name="bcity" class="form-control">
                </div>
              </div>
               
               <div class="row form-group">
                 <div class="col-md-12">
                    <label class="text-black" for="fname">Address</label>
                    <input type="text" id="baddress" name="baddress" class="form-control" required/>
                </div>
                </div>
               
                <div class="row form-group">
                 <h4 data-aos="fade-down" class="hotel-add-category margin-top35">Personal Information</h4>
                 <div class="col-md-12">
                    <label class="text-black" for="fname">Full Name</label>
                    <input type="text" id="aname" name="aname" class="form-control" required/>
                </div>
                </div>
                  <div class="row form-group">
                 <div class="col-md-12">
                    <label class="text-black" for="aemail">Email Address</label>
                    <input type="email" id="aemail" name="aemail" class="form-control"/>
                </div>
                </div>

                <label class="v7-custom-checkbox" for="agree">
                    <p>I agree to the Tailors.ng <a href="terms" target="_blank">Terms of use</a></p>
                    <input type="checkbox" name="terms" required/>
                    <span class="v7-checkbox-checkmark"></span>
                </label>
                
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="sub" value="Add your Brand" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5"  data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3 font-weight-bold">Frequently Asked Questions</h3>
                <div class="question">
                    <p class="font-weight-bold text-primary">Q: Is it free list a brand?</p>
                    <p class="mb-4 ">A: Yes, listing a brand on our website is completely free.</p>
                </div>
                <div class="question">
                    <p class="font-weight-bold text-primary">Q: How else can I list brands?</p>
                    <p class="mb-4 ">A: You can send an email to list@tailors.ng with information about the brand. Tailors.ng support team will contact you a short while afterwards.</p>
                </div>
                <div class="question">
                    <p class="font-weight-bold text-primary">Q: Can I list a brand that is not mine?</p>
                    <p class="mb-4 ">A: Yes you can, however you must ensure that you have permission to add the brand and the information you provide is valid.</p>
                </div>
                <div class="question">
                    <p class="font-weight-bold text-primary">Q: Can I add more than one brand</p>
                    <p class="mb-4 ">A: Yes, you can add as many brands as you like, as long as you have the correct brand information and permission to add the brands.</p>
                </div>
                <div class="question">
                    <p class="font-weight-bold text-primary">Q: What if I do not have all the information available?</p>
                    <p class="mb-4 ">A: You can enter the basic information of the brand (Name, address, phone number) and send us all other data by email later (list@tailors.ng)</p>
                </div>

          </div>
        </div>
      </div>
    </div>

          
        </div>
        
      </div>
    </div>
    </script>
    
 <script type="text/javascript">
  function validateForm() {

    var bname = $.trim($("#bname").val());
    var bemail = $.trim($("#bemail").val());
    var bnumber = $.trim($("#bnumber").val());
    var bcity = $.trim($("#bcity").val());
	var aname = $.trim($("#aname").val());
	var aemail = $.trim($("#aemail").val());


    // validate name
    if (bname == "") {
      alert("Enter your Brand name.");
      $("#bname").focus();
      return false;
    } else if (bname.length < 3) {
      alert("Brand name must be atleast 3 character.");
      $("#bname").focus();
      return false;
    }

    // validate email
    if (!isValidEmail(bemail)) {
      alert("Enter valid email.");
      $("bemail").focus();
      return false;
    }
	
	 // validate number
    if (bnumber == "") {
      alert("Enter your name.");
      $("#bnumber").focus();
      return false;
    } else if (bnumber.length < 11) {
      alert("Brand number must be 11 digits.");
      $("#bnumber").focus();
      return false;
    }

	 // validate city
    if (bcity == "") {
      alert("Enter City/Town.");
      $("#bcity").focus();
      return false;
    }	

		 // validate name
    if (aname == "") {
      alert("Enter your name.");
      $("#adderName").focus();
      return false;
    } else if (adderName.length < 3) {
      alert("Brand number must be 11 digits.");
      $("#adderName").focus();
      return false;
    }
	
	 // validate email
    if (!isValidEmail(adderEmail)) {
      alert("Enter valid email.");
      $("adderEmail").focus();
      return false;
    }
    return true;
  }

  function isValidEmail(brandemail) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(brandemail);
  }
  
   function isValidEmail(adderEmail) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(adderEmail);
  }


</script>   
<?php include_once 'footer.php'; ?>
