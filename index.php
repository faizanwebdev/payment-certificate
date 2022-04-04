<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->

    <title>Certificate Generator</title>
  </head>
  <body>
         
    <center>
      <br><br><br>
      <h3>Certificate Generator</h3>
      <br><br> 
      <form method="get" action="payment.php">
      <div class="form-group col-sm-6">
        <input type="hidden" name="amount" value="1" id="amount">
        <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter your first name">
      </div><br>
      <div class="form-group col-sm-6">
        <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter your last name">
      </div><br>
          <div class="form-group col-sm-6">
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
      </div><br>
      <div class="form-group col-sm-6">
        <select name="membership" id="membership" class="form-control">
                                <option value="">Select Membership Type</option>
                                <option value="Life_Membership">Life Membership</option>
                                <option value="Corporate_Membership">Corporate Membership</option>
                                <option value="Patron_Membership">Patron Membership</option>
                                <option value="Regular_Membership">Regular Membership</option>
                            </select>
      </div><br>
<!--
      <div class="form-group col-sm-6">
        <input type="text" name="occupation" class="form-control" id="organization" placeholder="Enter Organization Name Here...">
      </div><br>
-->
      <button type="submit" name="generate" value="generate" class="btn btn-primary">Generate</button>
    </form>
    <br>
 

    </center>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
  </body>
</html>
