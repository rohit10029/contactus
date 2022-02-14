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

        var settings = {
  "url": "http://localhost/wordpress/wp-json/api/v1/show/list",
  "method": "GET",
  "timeout": 0,
};


$.ajax(settings).done(function (res) {
 
  var r=JSON.stringify(res)
  var k=JSON.parse(r);
  console.log(k);

  if(k["status"])
  {
      var str=`<tr><th>name</th><th>email</th><th>phone</th><th>message</th></tr>`
    for(var i=0;i<k["data"].length;i++)
    {
        str+=`<tr><td>`+k['data'][i]["name"]+`</td><td>`+k['data'][i]["email"]+`</td><td>`+k['data'][i]["phone"]+`</td><td>`+k['data'][i]["message"]+`</td></tr>`

    }
    
    $("#table").html(str)

  }
  else{
    alert(k["error"])
  }
});

    
    });
  
    </script>
</head>
<body>
<div class="container">
<table class="table table-striped" id="table"></table>
</div>
</body>
</html>