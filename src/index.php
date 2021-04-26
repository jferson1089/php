<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en ">
<head>
    <meta charset="utf-8"/>
    <title>PHP Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Dummy API</h1>
<h2>Filling up the page with Dummy API info</h2>
<br/>
<div class="container">
<?php


$ch =curl_init();

// $url="https://reqres.in/api/users?page=2";

$url ="https://dummyapi.io/data/api/user";

$apikey = "6084987e2b1eed0fcde7dd4a";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "app-id: " .$apikey
));

$resp = curl_exec($ch);

if($e = curl_error($ch)) {
    var_dump("There is an error");
    echo $e;
}
else {
    $data = json_decode($resp, true);
    // var_dump("We got the json now");
    // var_dump($decoded{"data"}{"1"}{"firstName"});
    

    // $firstName = $decoded->data->firstName;
    // var_dump($firstName);
    // $data = array_column($decoded{"data"}, "firstName", "lastName");
    // $photo = array_column($decoded{"data"}, "picture");
    // print_r($firstName);
    // print_r($photo);

    $users = [];
    foreach($data["data"] as $key => $user) {
        $u =[
            "firstName" => $user["firstName"],
            "lastName" => $user["lastName"],
            "picture" =>$user["picture"],
            "id" => $user["id"]
        ];
    $users[] = $u;
    }

    // var_dump($users);

}

curl_close($ch);

foreach($users as $user){
?>
<a href="users.php?id=<?php echo $user["id"]; ?>">
    <div class="cards">
        <h4><?php echo $user["firstName"] . " " . $user["lastName"]; ?></h4>
        <img src="<?php echo $user["picture"]; ?>" alt="user image" />
       
    </div>
</a>
 <?php  
}
?>

</div>