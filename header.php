<?php
require('dbconnect.php');


session_start();



//check disconnect
if (isset($_GET["disconnect"])){
    if ($_GET["disconnect"]==1){
        $_SESSION["admin"] = false;
        unset($_SESSION["login"]);
        unset($_SESSION["admin"]);
    }
}

//check credentiels
if (isset($_POST['login'])){
    if (isset($_POST["password"])){
        //echo "login : ".$_POST['login'];
        //echo "password : ".$_POST['password'];
        $sql="SELECT COUNT(*) FROM members"; 

        $connexion=dbconnect(); 
        if(!$connexion->query($sql)) {
            echo "Pb d'accès à la bdd"; 
        }
        else{
            
            /* Query Prepare */
            $sql = "SELECT * FROM members WHERE login = :login AND password=:password";


            $query = $connexion->prepare($sql);
            $query->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
            $query->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
            $query->execute();
            $members_array = $query->fetchAll();

            $row_count = count($members_array);

            // Check the number of rows that match the SELECT statement 
            if($row_count==1) 
            {
                $member_row = $members_array[0];
                $_SESSION['login'] = $member_row['login'];
                $_SESSION['admin'] = $member_row["admin"]==1?true:false;
            }
        }

        $connexion=null;
    }
}

$admin=false;
$member = false;

if (isset($_SESSION["login"])){
    $member=true;
    if (isset($_SESSION["admin"])){
        $admin=$_SESSION["admin"] ;
    }
}



?>

<html>
<head>
<title>MatchZéro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>


  <link rel="stylesheet" href="myband.css">

  <script>
    /**
     * Fonction qui gère l'authentification : 
     */
    function authenticate() {
        // Affiche le formulaire qui a pour id : loginModal.

        let modal = document.getElementById('loginModal');
        modal.style.display='block';
    }

    function disconnect() {
        window.location.href = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" + '?disconnect=1';
    }
  </script>

  
</head>
<body >
    <div class="navbar">
        <ul>
            <li class="brandlogo"><img height="75" src="logos/logo1.png"</li>
            <li class="brandtext">MatchZéro</li>
            <?php
            if ($member){
                ?>
                <li style="float:right;"><a href="#" onclick="disconnect();">DECONNEXION</a></li>
                <?php
            }
            else{
                ?>
                <li style="float:right;"><a href="#" onclick="authenticate();">CONNECTION</a></li>
                <?php
            }
            ?>
            <li style="float:right;"><a href="contact.php">SPONSOR</a></li>
            <li style="float:right;"><a href="contact.php">CONTACT</a></li>
            <li style="float:right;"><a href="contact.php">MULTIMEDIA</a></li>
            <li style="float:right;"><a href="setlist.php">EVENEMENTS</a></li>
            
            <li style="float:right"><a href="index.php">ACCEUIL</a></li>
        
        </ul>

    </div>

    <!-- 
    DIV contenant le formulaire d'authentification -->
    <div id="loginModal" class="modal">
  
        <form id="loginForm" class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="dlgheadcontainer">
                <span onclick="document.getElementById('loginModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1>Log-in !</h1>
            </div>

            <div class="dlgcontainer">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="login" id="login" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                    
                <button type="submit" class="okbtn">Login</button>
                <button type="button" onclick="document.getElementById('loginModal').style.display='none'" class="cancelbtn">Cancel</button>

            </div>

        </form>
    </div>
    
