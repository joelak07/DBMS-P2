<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Park | Admin Portal | Vehicle</title>
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
            <h2>Vehicle</h2>
            <div class="search-bar">
                <form action="" method="POST">
                <label for="hold">Vehicle:</label><br>
                <select id="hold" name="hold">
                    <option value="">Select</option>
                    <?php
                        $qr = "select distinct type from vehicle";
                        $resr = mysqli_query($conn,$qr);
                        while ($row=mysqli_fetch_assoc($resr)) {
                            ?>
                            <option value="<?php echo $row['type'] ?>"><?php echo $row['type'] ?></option>
                            <?php
                        }
                    ?>
                </select><br><br>
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
                    $q = "SELECT * FROM vehicle WHERE type LIKE '%$s%'";
                    $res = mysqli_query($conn,$q);
                    if ($res==TRUE) {
                        $count=mysqli_num_rows($res);
                        if ($count>0) {
                            ?>
                            <p> Total results: <?php echo $count ?> <br>
                            <?php
                            while ($rows=mysqli_fetch_assoc($res)) {
                                $id = $rows['vh_id'];
                                $name = $rows['vh_name'];
                                $av = $rows['availability'];
                                $cap = $rows['capacity'];
                                $reg = $rows['reg_num'];
                                $type = $rows['type'];
                                $q2 = "select concat(f_name,' ', l_name) as name from employee where e_id in (select e_id from emp_drives_v where v_id=$id)";
                                ?>
                                <div class="record">
                                    <h3><?php echo $name ?></h3>
                                    <p>Availability: <?php if ($av==1) {echo "Yes";} else {echo "No";} ?> </p>
                                    <p>Capacity: <?php echo $cap ?> </p>
                                    <p>Type: <?php echo $type ?> </p>
                                    <p>Registration number: <?php echo $reg ?> </p>
                                    <p>Driven by: <br><?php
                                        $res2 = mysqli_query($conn,$q2);
                                        while ($row=mysqli_fetch_assoc($res2)) {
                                            $num = $row['name'];
                                            echo $num;
                                            ?>
                                            <br>
                                            <?php
                                        }
                                    ?>
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
