<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>OPS:::System Login</title>

        <meta name="description" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

		<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>  

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

        <script src="https://use.fontawesome.com/a05d68758b.js"></script>

    </head>

<!-- BODY -->

<div class="container">
    <div class="row">
        <div class="col" align="right">
            <img src="/img/logo.png">
        </div>
        <div class="col-6 pt-2">
            <h4>Welcome to the CDE OPS Portal</h4><hr />
            <p>Please log on to the system using your credentials in the fields below.</p>
            <form action="process.php" method="post" id="login" data-toggle="validator" role="form">
                <div class="row">
                    <label for="username" class="col-2 col-form-label">Username:</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                </div>
                <div class="row">
                    <label for="password" class="col-2 col-form-label">Password:</label>
                        <div class="col-10">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                </div>
                <div class="row pt-4">
                    <span class="col-2 col-form-label"></span>
                    <input type="submit" class="btn btn-success col-4">
                </div>
            </form>
        </div>
        <div class="col">
            
        </div>
    </div>
    <div class="row">
        <div class="col" align="right">
            
        </div>
<?php 
    if(isset($_GET['flag'])){
        switch($_GET['flag']){
            //Case 0 = Bad password
            case 0:
                ?>
                <br />
                <div class="mt-4 pt-2 alert alert-danger">
                    There is an error with your username or password. Please try again.
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>
                <?php
                break;

            //Case 2 = Not logged in
            case 1:
                ?>
                <div class="mt-4 pt-2 alert alert-warning">
                    You must log in to continue.
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>
                <?php
                break;

            case 2:
                ?>
                <div class="mt-4 pt-2 alert alert-warning">
                    There are no accounts matching the credentials.  Please try again.
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>

                <?php
                break;

            case 3:
                ?>
                <div class="mt-4 pt-2 alert alert-warning">
                    Your account is disabled.  Please contact an administrator.
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>

                <?php
                break;

            case 9:
                ?>
                <div class="mt-4 pt-2 alert alert-danger">
                    A critical error has occured logging you in.  Please contact the systems administration.
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>

                <?php
                break;

            //Default case...
            default:
                ?>
                <div class="mt-4 pt-2 alert alert-warning">
                    You must log in to continue.
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                </div>
                <?php
                break;
        }
    }
    ?>
        <div class="col"></div>
    </div>
</div>

<?php 
	include_once($_SERVER["DOCUMENT_ROOT"].'/lib/includes/inc.footer.php'); 
?>