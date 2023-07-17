<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Park | Visitor Portal | Reservation</title>
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
            <h2>Reservation</h2>
            <div class="f_cont">
                <form action="" method="POST">
                    <h2>reservation</h2>
                    <label for="vid">Visitor ID</label><br>
                    <input type="text" id="vid" name="vid"><br><br>
                    <label for="vis">Visitor count</label><br>
                    <input type="text" id="vis" name="vis"><br><br>
                    <input type="submit" name="submit" value="Submit" id="sub_but">
                </form>
                <?php
                    if (isset($_POST['submit'])) {
                        $vis = $_POST['vis'];
                        $vid = $_POST['vid'];
                        ?>
                        <form action="" method="POST">
                            
                                <label for="camp">Campsite:</label><br>
                                <select id="camp" name="camp">
                                    <option value="">Select</option>
                                    <?php
                                        $qr = "select location from campsite where capacity>=$vis";
                                        $resr = mysqli_query($conn,$qr);
                                        while ($row=mysqli_fetch_assoc($resr)) {
                                            ?>
                                            <option value="<?php echo $row['location'] ?>"><?php echo $row['location'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select><br><br>                                                
                                <label for="sd">Start date:</label><br>
                                <input type="date" id="sd" name="sd">
                                <br><br>
                                <label for="ed">End date:</label><br>
                                <input type="date" id="ed" name="ed">
                                <br><br>
                                <input type="submit" name="s2" value="Submit" id="sub_but"> 
                                <?php
                                    $camp = "";
                                    $sd = "";
                                    $ed = "";
                                    if (isset($_POST['s2'])) {
                                        $camp = $_POST['camp'];
                                        $sd = $_POST['sd'];
                                        $ed = $_POST['ed'];

                                        $q1 = "SELECT c_id FROM campsite WHERE location='$camp'";
                                        $c_id = mysqli_fetch_assoc(mysqli_query($conn,$q1))['c_id'];
                                        $q2 = "SELECT * FROM reservation ORDER BY r_id DESC LIMIT 1";
                                        $r_id = mysqli_fetch_assoc(mysqli_query($conn,$q2))['r_id']+1;
                                        $res = mysqli_query($conn,$q2);
                                        $qr3 = "INSERT INTO reservation VALUES(".$r_id.",'".$sd."','".$ed."',".$vis.",".$vid.",".$c_id.")";
                                        $res = mysqli_query($conn,$qr3);
                                        $qr4 = "UPDATE campsite SET availability = 0 WHERE c_id = $c_id";
                                        $res = mysqli_query($conn,$qr4);
                                    }
                                ?>
                        </form>
                        <?php
                    }
                    else {
                        $vis = 0;
                        $vid = "";
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>