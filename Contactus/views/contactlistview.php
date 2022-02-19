<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    #table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#table td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
    <title>Contactus</title>

    <script>
      $(document).ready(function(){ 

        var settings = {
  "url": site_url()+"/wp-json/api/v1/show/list",
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