<?php
require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

if(isset($_GET['q'])) { 

$q = $_GET['q'];

$query = $client->search([
'body' => [
'query' => [ 
'bool' => [
'should' => [
'match' => ['name' => $q],
'match' => ['attributes' => $q]
]
]
]
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
?>

<!DOCTYPE>
<html>  
    <head>
        <meta charset="utf-8">
        <title>Search Elasticsearch</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body class="bg-light">
	<div class="container">
        <form action="index.php" method="get" autocomplete="off">
            <label>
                Search for Something
                <input type="text" name="q" class="form-control" >
            </label>
            <input type="submit" value="search" class="btn btn-primary btn-sm">
        </form>
	   <?php
	   if(isset($query['hits']['total']) && ($query['hits']['total'] >=1) ) { 
			$results = $query['hits']['hits'];
			
			$hits = count($query['hits']['hits']);
			$result = null;
			$i = 0;

			while ($i < $hits) {
				$result[$i] = $query['hits']['hits'][$i]['_source'];
				$i++;
			}
			foreach ($result as $key => $value) {
				echo $value['name'] . "<br>";
			}
			
			
		}
	   ?>
      </div>
    </body>
</html>