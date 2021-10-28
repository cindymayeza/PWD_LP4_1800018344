<?php
include_once("koneksi.php");
$result = mysqli_query($con, "SELECT * FROM website");
?>
<html>
    <head>
        <style>
            .error{color:#FF0000;}
        </style>
    </head>

    <body>
        <?php
        //define variables and set to empty values
            $namaErr = $emailErr = $genderErr = $websiteErr ="";
            $nama = $email = $gender = $comment = $website ="";

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(empty($_POST["nama"])){
                    $namaErr="Nama harus diisi";
                }else{
                    $nama=test_input($_POST["nama"]);
                }

                if(empty($_POST["email"])){
                    $emailErr="Email harus diisi";
                }else{
                    $email=test_input($_POST["email"]);

                    //check if e-mail address is well-formed
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailErr="Email tidak sesuai format";
                    }
                }

                if(empty($_POST["website"])){
                    $website="";
                }else{
                    $website=test_input($_POST["website"]);
                }

                if(empty($_POST["comment"])){
                    $comment="";
                }else{
                    $comment=test_input($_POST["comment"]);
                }

                if(empty($_POST["gender"])){
                    $genderErr="";
                }else{
                    $gender=test_input($_POST["gender"]);
                } 

            }

            function test_input($data){
                $data=trim($data);
                $data=stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
        ?>

        <h2>Posting Komentar</h2>
        <p><span class="error">*Harus Diisi</span></p>

        <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td>Nama:</td>
                    <td><input type="text" name="nama">
                    <span class="error">*<?= $namaErr; ?></span>
                    </td>
                </tr>

                <tr>
                    <td>E-mail:</td>
                    <td><input type="text" name="email">
                    <span class="error">*<?= $emailErr; ?></span>
                    </td>

                </tr>

                <tr>
                    <td>Website:</td>
                    <td><input type="text" name="website">
                    <span class="error">*<?= $websiteErr; ?></span>
                    </td>
                </tr>

                <tr>
                    <td>Komentar:</td>
                    <td><textarea name="comment" rows="5" cols="40"></textarea></td>
                </tr>

                <tr>
                    <td>Gender:</td>
                    <td>
                        <input type="radio" name="gender" value="L">Laki-Laki
                        <input type="radio" name="gender" value="P">Perempuan
                        <span class="error"><?= $genderErr;?></span>
                    </td>
                </tr>

                <td>
                    <input type="submit" name="Submit" value="Submit">
                </td>
            </table>
    </form>

        <?php
        // check if form submitted, insert form data into users table.
        if(isset($_POST['Submit'])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $website = $_POST['website'];
            $comment = $_POST['comment'];
            $gender = $_POST['gender'];
            //unclude database connection file
            include_once("koneksi.php");
            //insert user data into table
            $result = mysqli_query($con, "INSERT INTO website(nama,email,website,comment,gender)
            VALUES('$nama','$email','$website','$comment','$gender')");
            //Show message when user added
            echo "Data berhasil disimpan. <a href='index.php'>View website</a>";
        }
        ?>
    </body>
</html>