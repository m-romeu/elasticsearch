<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

if(!empty($_POST)){ 
if(isset($_POST['name'],$_POST['gender'], $_POST['age'],
$_POST['complexion'],
$_POST['attributes'])){

$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$complexion = $_POST['complexion'];
$attributes = explode(',', $_POST['attributes']); 

$indexed = $client->index([
    'index' => 'children',
    'type' => 'child',
    'body' => [
        'name' => $name,
        'gender' => $gender,
        'age' => $age,
        'complexion' => $complexion,
        'attributes' => $attributes
     ],
    'client' => [
        'curl' => [
            CURLOPT_HTTPHEADER => [
                'Content-type: application/json'
            ]
        ]
    ]
]);
}
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Child Details</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body class="bg-light">
	<div class="container">
        <form action="add.php" method="post" autocomplete="off">
            <div class="box">
                <label class="lbl">
                    Name                   
                </label>
				 <input type="text" name="name" class="form-control"  >
                <br>
                <label class="lbl">
                    Gender                    
                </label>
				<input type="text" name="gender"  class="form-control" >
                <br>
                <label class="lbl">
                    Age                    
                </label>
				<input type="text" name="age" placeholder="number only" class="form-control" >
                <br>
                <label class="lbl">
                    Complexion                    
                </label class="lbl">
				<input type="text" name="complexion"  class="form-control" >
                <br>
                <label class="lbl">
                    The Attributes                    
                </label>
				<textarea type="text" name="attributes" rows="4" placeholder="comma, separated attributes" class="form-control"  ></textarea>
                <br>   
                <input type="submit" value="Add" class="btn btn-lg btn-primary " >
            </div>
        </form>
		</div>
    </body>
 
   </html>