<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Send Email</title>
    <link rel="icon" href="img/email.ico">
    <meta charset="UTF-8">
    <meta name="description" content="Send your email message to everyone, just for fun.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="p-3 mb-2 bg-dark text-white">
    <?php
      require_once("db.php");

      // controllo della risposta dell'utente (chiamata POST, file JSON decodificato)
      if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
        $secretKey = "_YOUR_SECRET_KEY_";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);

        //Se il Google reCAPTCHA è stato risolto allora si può inviare l'email
        if($responseKeys["success"]) {
          if (!filter_var($_POST['sendto'], FILTER_VALIDATE_EMAIL)) {
              echo '<h3 class="text-center">Recipient email is invalid</h3>';
          }
          elseif (!filter_var($_POST['youremail'], FILTER_VALIDATE_EMAIL)) {
              echo '<h3 class="text-center">Your email address is invalid</h3>';
          }
          elseif(isset($_POST['sendto'])){
            $to      = $_POST['sendto'];
            $subject = $_POST['object'];
            $message = $_POST['msg'];
            $headers = 'From: ' . $_POST['youremail'] . "\n" . 'Reply-To: ' . $_POST['youremail'] . "\n" . 'X-Mailer: PHP/' . phpversion();

            $sendmail = mail($to, $subject, $message, $headers);

            //Controllo se l'email è stata inviata o meno
            if($sendmail) {
                //Inserisco l'email nel database
                $timestamp = time();
                $stmt = $db->prepare("INSERT INTO emails_log (sender, recipient, message, timestamp, ip_address) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssis", $_POST['youremail'], $_POST['sendto'], $_POST['msg'], $timestamp, $_SERVER['REMOTE_ADDR']);
                $stmt->execute();
                $stmt->close();
                echo '<h3 class="text-center">Email sent</h3>';
            }
            else
              echo '<h3 class="text-center">Email not sent, try again</h3>';
          }
        }

        //se ci sono stati degli errori
        else
          echo '<h3 class="text-center">Sorry, try again :/</h3>';
      }

      //se non è stato completato il Google reCAPTCHA
      if(!$captcha)
        echo '<h3 class="text-center">Please check the captcha</h3>';
    ?>

    <br />

    <p class="text-center"><a href="index.php">Back to home page</a></p>

    <br />

    <footer class="page-footer" style="position:fixed; bottom:0; left:0; right:0">
      <div class="footer-copyright text-center py-3 font-weight-bold">
        &copy; <?php echo date("Y");?> IntZeta Production | <a href="mailto:intzeta@gmail.com">Contact me</a>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
