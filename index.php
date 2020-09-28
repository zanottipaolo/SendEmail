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
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  </head>
  <body class="p-3 mb-2 bg-dark text-white">
    <h1 class="text-center font-weight-bold pb-4">SEND EMAIL TO ANYONE</h1>

    <!--Form principale in cui inserire i dati, verranno poi elaborati dallo script send.php-->
    <form action="send.php" method="post" class="col-lg-4 pt-3 pb-3" style="margin: 0 auto; border-radius: 10px; border: 3px solid #dc3545;">
      <div class="form-group">
        <label for="sendto">To:</label>
        <input type="email" class="form-control" name= "sendto" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="youremail">From:</label>
        <input type="email" class="form-control" name= "youremail" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="object">Object:</label>
        <input type="text" class="form-control" name= "object" placeholder="Enter the object">
      </div>
      <div class="form-group">
        <label for="msg">Message:</label>
        <textarea class="form-control" name= "msg" placeholder="Enter the message"></textarea>
      </div>

      <!--Google reCAPTCHA checkbox-->
      <div class="text-center">
        <div class="g-recaptcha" data-sitekey="_YOUR_SITE_KEY_" style="display: inline-block;">
        </div>
      </div>
      <br>
      <div class="text-center">
        <button type="reset" class="btn btn-danger font-weight-bold"><i class="fa fa-remove" style="color: white;"></i></button>
        <button type="submit" name="submit" class="btn btn-success font-weight-bold"><i class="fas fa-check" style="color: white;"></i></button>
      </div>
    </form>

    <br />

    <footer class="page-footer">
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
