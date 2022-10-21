<?php
require_once "header.php";

?>
    <div class="container">
        <h1>Curriculum Vitae</h1>
        <form action="index2.php" method="post" enctype="multipart/form-data">

            <h2>Personal Info</h2>

            <label for="img"><b>Select image:</b></label>
            <input type="file" id="img" name="img" accept="image/*">
            
            <br><br>
            <label for="aboutme"><b>About me:</b></label>
            <br>
            <textarea id="aboutme" name="aboutme" rows="4" cols="50" maxlength="500">
            </textarea>
            <br><br>

            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>

            <label for="birthday"><b>Birthday</b></label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="gender"><b>Gender</b></label>
            <select name="gender" id="gender">
                <option value="select">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other option</option>
                <option value="skip">Skip</option>
            </select>

            <label for="citizenship"><b>Citizenship</b></label>
            <input type="text" placeholder="Enter Citizenship" name="citizenship" id="citizenship" required>
            
            <h2>Contact</h2>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="e.g.: john.mathew@mail.com" name="email" id="email" required>

            <label for="phone"><b>Phone number</b></label>
            <input type="text" placeholder="Enter your phone number" name="phone" id="phone" required>

            <h2>Address</h2>

            <label for="address1"><b>Address1</b></label>
            <input type="text" placeholder="e.g.: street" name="address1" id="address1" required>

            <label for="address2"><b>Address2</b></label>
            <input type="text" placeholder="e.g.: building, apartment, floor" name="address2" id="address2" required>

            <label for="city"><b>City</b></label>
            <input type="text" placeholder="e.g.: Craiova" name="city" id="city" required>

            <label for="country"><b>Country</b></label>
            <input type="text" placeholder="Enter Country" name="country" id="country" required>
            

            <input type="submit" name="upload" value="Forward">

        </form>
    </div>

<?php    
require_once "footer.php";