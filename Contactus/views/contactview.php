<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Contactus</title>

    <script>
      $(document).ready(function(){
 

      $("#submit").on("click",function(){

      
      var name= $("#name").val();
      var email= $("#email").val();
      var phone= $("#phone").val();
      var message= $("#message").val();
      

var settings = {
  "url": "http://localhost/wordpress/wp-json/api/v1/send/sms",
  "method": "POST",
  // "contentType": false,
  "data":{"name":name,"email":email,"phone":phone,"message":message}
};

$.ajax(settings).done(function (res) {
  var r=JSON.stringify(res)
  var k=JSON.parse(r);
 

  if(k["status"])
  {
    alert(k["message"])
  }
  else{
    alert(k["error"])
  }
});

      })
    });
  
    </script>
</head>
<body>
<div class="container">
<form    method="POST">
  <div class="form-group">
    <label for="name">Full name:</label>
    <input type="text" class="form-control" id="name">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="phone">Phone no:</label>
    <input type="text" class="form-control" id="phone">
  </div>
  <div class="form-group">
    <label for="phone">message:</label>
    <textarea  class="form-control" id="message"></textarea>
  </div>
  <button type="button" id="submit" name="submit" class="btn btn-default">Submit</button>
</form> 
</div>
</body>
</html>