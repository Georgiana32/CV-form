<?php
require_once "header.php";
require_once "DBconn.php";

if(!isset($_POST['fname'], $_POST['lname'], $_POST['birthday'], $_POST['gender'], $_POST['citizenship'], $_POST['email'], $_POST['phone'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['country'], $_POST['aboutme'])){
    exit('Empty Field(s)');
}

if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['birthday']) || empty($_POST['gender']) || empty($_POST['citizenship']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['address1']) || empty($_POST['address2']) || empty($_POST['city']) || empty($_POST['country']) || empty($_POST['aboutme'])){
    exit('Values Empty');
}



if(isset($_POST['upload'])){

    $filename = $_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];
    
    $folder = "./image/" . $filename;

    $idForm1 = 0;
    if($stmt = $conn->prepare('INSERT INTO pinfo (fname, lname, birthday, gender, citizenship, email, phone, address1, address2, city, country, picture, aboutme) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')){
        $stmt -> bind_param('ssssssissssss', $_POST['fname'], $_POST['lname'], $_POST['birthday'], $_POST['gender'], $_POST['citizenship'], $_POST['email'], $_POST['phone'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['country'], $filename, $_POST['aboutme']);
        $stmt -> execute();
        $idForm1 = $conn->insert_id;
    }
    else{
        echo 'Error occurred';
    }

    if(move_uploaded_file($tempname, $folder)){
        echo "<h3 style='display:none'>  Image uploaded successfully!</h3>";
    } else{
        echo "<h3>  Failed to upload image!</h3>";
    }

    $stmt->close();
}

$conn->close();

?>
    <div class="container">
        <h1>Curriculum Vitae</h1>
        <form action="pdfGen.php" method="post">
            <input type='hidden' name = 'idForm1' value = <?php echo $idForm1?>>

            <h2>Education</h2>

            <label for="organization"><b>The organization that provides education and training</b></label>
            <input type="text" placeholder="Enter Organization Name" name="organization" id="organization">

            <label for="qualification"><b>Qualification name</b></label>
            <input type="text" placeholder="Enter Qualification" name="qualification" id="qualification" >

            <label for="edsince"><b>Since</b></label>
            <input type="date" id="edsince" name="edsince">

            <label for="edupto"><b>Up to</b></label>
            <input type="date" id="edupto" name="edupto">

            <h2>Professional experience</h2>
            <p>Describe your entire professional experience. You can mention paid activities, volunteer activities, internships and apprenticeships, self-employed periods, etc.</p>

            <label for="occupation"><b>Occupation or position held</b></label>
            <input type="text" placeholder="Enter Occupation Name" name="occupation" id="occupation" >

            <label for="employer"><b>Employer</b></label>
            <input type="text" placeholder="Enter Employer" name="employer" id="employer">

            <label for="since"><b>Since</b></label>
            <input type="date" id="since" name="since">

            <label for="upto"><b>Up to</b></label>
            <input type="date" id="upto" name="upto">    

            <input type="submit" value="Forward">

        </form>
    </div>

<?php    
require_once "footer.php";