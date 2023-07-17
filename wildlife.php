<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Park | Visitor Portal | Wildlife</title>
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body bgcolor="#3F4E4F">
    <div class="main">
        <?php include('menuv.php'); ?>
        <div class="content" style="padding: 10px 50px;">
            <h2>Wildlife</h2>
            <div class="search-bar">
                <form action="" method="POST">
                    <input id="in" type="text" placeholder="Search.." name="hold">
                    <input id="s" type="submit" name="submit"></input>
                </form>
            </div>
            <div class="container">
                <?php
                    if (isset($_POST['hold'])) {
                    $s = $_POST['hold'];
                    }
                    else {
                        $s = "";
                    }
                    $q = "SELECT * FROM wildlife_species WHERE common_name LIKE '%$s%' or scientific_name LIKE '$s'";
                    $res = mysqli_query($conn,$q);
                    if ($res==TRUE) {
                        $count=mysqli_num_rows($res);
                        if ($count>0) {
                            ?>
                            <p> Total results: <?php echo $count ?> <br>
                            <?php
                            while ($rows=mysqli_fetch_assoc($res)) {
                                $id = $rows['ws_id'];
                                $c_name = $rows['common_name'];
                                $s_name = $rows['scientific_name'];
                                $ls = $rows['avg_lifespan'];
                                $stat = $rows['status'];
                                ?>
                                <div class="record">
                                    <h3><?php echo $c_name ?></h3>
                                    <p>(<?php echo $s_name ?> )</p>
                                    <p>Lifespan:<?php echo $ls ?> </p>
                                    <p>Status:<br><?php echo $stat ?> </p>
                                </div>
                                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
