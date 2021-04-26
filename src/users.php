<?php

session_start();
// echo $_GET["id"];

$userId = $_GET["id"];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>Dummy API</h1>
    <h2>Filling up the page with Dummy API info </h2>

    <div class="container">


<?php
$ch =curl_init();

$url ="https://dummyapi.io/data/api/user/{$userId}";

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
    $profile = json_decode($resp, true);
    // var_dump("this is the user profile info", $profile["lastName"]);
    // print_r($profile["id"]);
    // print_r($profile);
    
}

curl_close($ch);

// Getting posts for ticket 2

$ch =curl_init();

$postsUrl ="https://dummyapi.io/data/api/user/{$userId}/post";

$apikey = "6084987e2b1eed0fcde7dd4a";

curl_setopt($ch, CURLOPT_URL, $postsUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "app-id: " .$apikey
));

$response = curl_exec($ch);

if($e = curl_error($ch)) {
    var_dump("There is an error");
    echo $e;
}
else {
    $posts = json_decode($response, true);
    // print_r($posts);

    $post = [];
    foreach($posts["data"] as $key => $value) {
        $p =[
            "image" => $value["image"],
            "text" => $value["text"],
            "link" => $value["link"]
        ];
    $post[] = $p;
    }

    // var_dump($post["text"]);

}

curl_close($ch);


?>
            <div class="user_Profile">
                <img src="<?php echo $profile["picture"] ?>" alt="users photograph" />
                
                <ul>
                <li><h3><?php echo $profile["title"] . " " . $profile["firstName"] . " " . $profile["lastName"]; ?></h3></li>
                    <li>Gender : <?php echo $profile["gender"];?></li>
                    <li>Email : <?php echo $profile["email"];?></li>
                    <li>Date of Birth : <?php echo $profile["dateOfBirth"];?></li>
                    <li>Registration Date : <?php echo $profile["registerDate"];?></li>
                    <li>Phone Number : <?php echo $profile["phone"];?></li>
                    <!-- Need to fix location so it shows the address -->
                    <li>Location : <?php echo $profile["location"]["street"] . " " .  $profile["location"]["city"] . ", " .
                                    $profile["location"]["state"] . " " . $profile["location"]["country"];?></li>
                    <li>Timezone : <?php echo $profile["location"]["timezone"]; ?></li>
                    <li>User Id : <?php echo $profile["id"];?></li>
                </ul>


            </div>

            <!-- Ticket 2 adding container for posts -->
        <?php

            foreach($post as $posts) {

            ?>
            <div class="posts">
                <a href="<?php echo $posts["link"] ?>">
                <h3> <img class="smallImage" src="<?php echo $profile["picture"]; ?> "alt=" user's photo" /> Shared </h3>
                <div class="cards">
                    <img class="postImage" src="<?php echo $posts["image"]; ?>" alt= "User posted image" />
                    <p> <?php echo $profile["firstName"] ." " . $profile["lastName"];?> says : <?php echo $posts["text"]; ?> </p>

                </div>
            </div>
            </a>

            <?php
            }
            ?>


        </div>
    </body>
</html>
