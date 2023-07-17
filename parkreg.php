<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Park | Admin Portal | Park Regulations</title>
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
        <?php include('menua.php'); ?>
        <div class="content" style="padding: 10px 50px;">
            <h2>Park Regulations</h2>
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
                    $q = "SELECT * FROM park_reg WHERE title LIKE '%$s%'";
                    $res = mysqli_query($conn,$q);
                    if ($res==TRUE) {
                        $count=mysqli_num_rows($res);
                        if ($count>0) {
                            ?>
                            <p> Total results: <?php echo $count ?> <br>
                            <?php
                            while ($rows=mysqli_fetch_assoc($res)) {
                                $id = $rows['pr_id'];
                                $name = $rows['title'];
                                $desc = $rows['description'];
                                $fine = $rows['fine'];
                                ?>
                                <div class="record">
                                    <h3><?php echo $name ?></h3>
                                    <p>Fine: <?php echo $fine ?> </p>
                                    <p>Description:<br> <?php echo $desc ?> </p>
                                    </p>
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
