<?php
require('header.php');
$connexion=dbconnect(); 


$sql = "SELECT * FROM admins WHERE contact=1";
$query = $connexion->prepare($sql);
$query->execute();
$row_count = $query->rowCount();

// Check the number of rows that match the SELECT statement 
if($row_count!=1) 
{
  echo "Pb d'accès à la bdd"; 
}
else{ 
    $row = $query->fetch();
    $email = $row["email"];

    $connexion = null;
  ?> 

    <div class="main">

    <h3>Contact Us</h3>
    <p align="center">Do you have any questions? You need a quote ?</p>

        <div class="formcontact">
            <form action="/action_page.php">
                <label for="fname">Your Name : </label>
                <input type="text" id="fname" name="firstname" placeholder="Your name..">

                <label for="lname">Your Email : </label>
                <input type="text" id="lname" name="lastname" placeholder="Your email..">


                <label for="lname">Subject : </label>
                <input type="text" id="lname" name="lastname" placeholder="The subject of your message..">


                <label for="subject">Your Message : </label>
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                <input type="submit" class="okbtn" value="Submit">
            </form>
        </div>
&nbsp;

        <div class="contactbar">
            <table style="border:none;">
                <tr>
                    <td>
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>My Garage, CA 94126, USA</p>
                    </td>
                    <td>
                        <i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+ 01 234 555 89</p>
                    </td>
                    <td>
                        <i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p><?php echo $email ;?></p>
                    </td>
                </tr>
            </table>
            
        </div>
    </div>

<!--Section: Contact v.2-->
<?php
}


require('footer.php');
?>