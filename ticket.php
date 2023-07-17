<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Park | Visitor Portal | Ticket</title>
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
            <h2>Ticket</h2>
            <div class="f_cont">
            <form action="" method="POST">
                <h2>visitor details</h2>
                <label for="first_name">First Name</label><br>
                <input type="text" id="first_name" name="f_name"><br><br>
                
                <label for="last_name">Last Name</label><br>
                <input type="text" id="last_name" name="l_name"><br><br>
                
                <label for="phone">Phone</label><br>
                <input type="tel" id="phone" name="phone"><br><br>
                
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email"><br><br>
                
                <label for="gender">Gender:</label><br>
                <select id="gender" name="gender">
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
                </select><br><br>
                
                <label for="dob">Date of Birth</label><br>
                <input type="date" id="dob" name="dob"><br><br>

                <h2>Ticket Details</h2>
                <label for="par">Park:</label><br>
                <select id="par" name="par">
                    <option value="">Select</option>
                    <?php
                        $qr = "select np_name from national_park";
                        $resr = mysqli_query($conn,$qr);
                        while ($row=mysqli_fetch_assoc($resr)) {
                            ?>
                            <option value="<?php echo $row['np_name'] ?>"><?php echo $row['np_name'] ?></option>
                            <?php
                        }
                    ?>
                </select><br><br>
                <label for="type">Type:</label><br>
                <select id="type" name="type">
                    <option value="">Select</option>
                    <option value="Child">Child</option>
                  <option value="Adult">Adult</option>
                  <option value="Senior">Senior</option>
                </select><br><br>
                
                <label for="veh">Vehicle:</label><br>
                <select id="veh" name="veh">
                    <option value="">Select</option>
                    <?php
                        $qr = "select vh_name from vehicle";
                        $resr = mysqli_query($conn,$qr);
                        while ($row=mysqli_fetch_assoc($resr)) {
                            ?>
                            <option value="<?php echo $row['vh_name'] ?>"><?php echo $row['vh_name'] ?></option>
                            <?php
                        }
                    ?>
                </select><br><br>

                <label for="date">Date:</label><br>
                <input type="date" id="date" name="date">
                <br><br>
                <input type="submit" name="submit" value="Submit" id="sub_but">
            </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gen = $_POST['gender'];
    $dob = $_POST['dob'];
    $par = $_POST['par'];
    $type = $_POST['type'];
    $veh = $_POST['veh'];
    $date = $_POST['date'];
    $cost = 0;
    if ($type=="Adult") {
        $cost = 25.99;
    }
    else if ($type=="Child") {
        $cost = 15.99;
    }
    else {
        $cost = 10.99;
    }

    $q1 = "SELECT * FROM visitor ORDER BY v_id DESC LIMIT 1";
    $v_id = mysqli_fetch_assoc(mysqli_query($conn,$q1))['v_id']+1;
    $q2 = "SELECT * FROM ticket ORDER BY t_id DESC LIMIT 1";
    $t_id = mysqli_fetch_assoc(mysqli_query($conn,$q2))['t_id']+1;
    $q3 = "SELECT vh_id FROM vehicle WHERE vh_name='".$veh."'";
    $vh_id = mysqli_fetch_assoc(mysqli_query($conn,$q3))['vh_id'];
    $q4 = "SELECT np_id FROM national_park WHERE np_name='".$par."'";
    $np_id = mysqli_fetch_assoc(mysqli_query($conn,$q4))['np_id'];
    $qr2 = "INSERT INTO visitor VALUES(".$v_id.",'".$f_name."','".$l_name."','".$phone."','".$email."','".$gen."','".$dob."',".$np_id.")";
    $res = mysqli_query($conn,$qr2);
    $qr3 = "INSERT INTO ticket VALUES(".$t_id.",'".$type."',".$cost.",'".$date."',".$vh_id.")";
    $res = mysqli_query($conn,$qr3);
    $qr4 = "UPDATE vehicle SET availability = 0 WHERE vh_id = $vh_id";
    $res = mysqli_query($conn,$qr4);
}
?>
