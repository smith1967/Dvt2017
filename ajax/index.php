<?php
if(isset($_POST['submit'])){
    var_dump($_POST);  
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootcomplete.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script> 
        <script src="../js/jquery.bootcomplete.js"></script>        
    </head>
    <body>
        <div class="row col-md-5">
                <form class="form-horizontal" id="signupfrm" method="post" action="">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="business">ชื่อบริษัท</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="business" name="business" placeholder="Username" value='<?php echo isset($business) ? $business : ''; ?>'>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn btn-default" name='submit'>ตกลง</button>
                        </div>
                    </div>
                </form>
            <script type="text/javascript">
                $('#business').bootcomplete({
                    url: 'search_business.php',
                    minLength: 1,
                    formParams: {
                        'name': $('#business')
                    }
                });
            </script>
         
        </div>
    </body>
</html>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

