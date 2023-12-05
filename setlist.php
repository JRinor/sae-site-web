<?php
require('header.php');

if (isset($_POST["formsongaction"])){

    $action = $_POST["formsongaction"];
    
    $connexion=dbconnect(); 

    if ($action == "add"){

        $title = $_POST["title"];
        $artist = $_POST["artist"];
        $style = $_POST["style"];

        $sql = "INSERT INTO setlist (`title`, `artist`, `style`) VALUES(:title, :artist, :style )";
        $query = $connexion->prepare($sql);
        $query->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
        $query->bindValue(':artist', htmlspecialchars($artist), PDO::PARAM_STR);
        $query->bindValue(':style', htmlspecialchars($style), PDO::PARAM_STR);

        // execute insert sql
        $query->execute();

    }
    else if ($action=="modify"){

        $title = $_POST["title"];
        $artist = $_POST["artist"];
        $style = $_POST["style"];

        $id = $_POST["formsongid"];

        $sql = "UPDATE setlist SET `title` = :title, `artist`=:artist, `style`=:style WHERE id=:id";
        $query = $connexion->prepare($sql);
        $query->bindValue(':title', htmlspecialchars($title), PDO::PARAM_STR);
        $query->bindValue(':artist', htmlspecialchars($artist), PDO::PARAM_STR);
        $query->bindValue(':style', htmlspecialchars($style), PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_STR);

        // execute insert sql
        $query->execute();

    }
    else if ($action=="remove"){

        $id = $_POST["formsongid"];

        $sql = "DELETE FROM setlist WHERE id=:id";
        //echo $sql." ".$id;
        $query = $connexion->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_STR);

        $query->execute();

    }
    else if ($action=="removeLyrics"){
        $id = $_POST["formsongid"];

        $sql = "UPDATE setlist SET `lyrics` = NULL WHERE id=:id";
        //echo $sql." ".$id;
        $query = $connexion->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_STR);

        $query->execute();

    }

    $connexion=null;
}

if (isset($_FILES["fileToUpload"]))
{
    $connexion=dbconnect(); 

    $songid = $_POST["formsongid"];
    $target_dir = "./lyrics/";
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is pdf
    if(isset($_POST["submit"])) {
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType != "pdf") {
            //echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $sql = "UPDATE setlist SET `lyrics` = :lyrics WHERE id=:id";
            $query = $connexion->prepare($sql);
            $query->bindValue(':lyrics', $filename, PDO::PARAM_STR);
            $query->bindValue(':id', $songid, PDO::PARAM_STR);
    
            // execute insert sql
            $query->execute();
        } 
    }
}

$columns = array('title','artist','style');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';

$sql = "SELECT * from setlist ORDER BY " .  $column . " " . $sort_order;

$connexion=dbconnect(); 
if(!$connexion->query($sql)) {
  echo "Pb d'accès à la bdd"; 
}
else{ 
    

  ?> 

  <div class="main">
  <!-- Titre -->
    <header class="intro">
        <h1> Set List </h1>
    </header>

    <script>
        function searchFunction() {
            var value = document.querySelector("#searchInput").value.toLowerCase();
            document.querySelectorAll("#songTable tbody tr").forEach((tr)=>{
                tr.style.display = (tr.innerText.toLowerCase().indexOf(value)> -1)?'':'none';
            });
        }

        function filterOnLyrics() {
            let filter = document.querySelector("#lyricsfilter").checked ;

            document.querySelectorAll("#songTable tbody tr").forEach((tr)=>{
                console.log('TR ==> '+(tr.innerHTML.toLowerCase()));
                console.log('.pdf found ==> '+(tr.innerHTML.toLowerCase().indexOf(".pdf")> -1));
                console.log('!filter ==>'+(!filter));
                console.log('');
                tr.style.display = ((tr.innerHTML.toLowerCase().indexOf(".pdf")> -1)||(!filter))?'':'none';
            });
        }

         /**
         */
        function addormodifySong(action, id, title, artist, style) {
            document.querySelector("#addUpdateSongForm").elements["formsongaction"].value = action;
            if (action=="add"){
                document.querySelector('#addUpdateSongModalLabel').innerText="Add Song";
            }
            else{
                document.querySelector('#addUpdateSongModalLabel').innerText="Edit Song";
                
                document.querySelector("#addUpdateSongForm").elements["title"].value = title;
                document.querySelector("#addUpdateSongForm").elements["artist"].value = artist;
                document.querySelector("#addUpdateSongForm").elements["style"].value = style;
                document.querySelector("#addUpdateSongForm").elements["formsongid"].value = id;
            }
            
            let modal = document.getElementById('addUpdateSongModal');
            modal.style.display='block';
        }

        

        function check(){
            let valid=true;

            if (document.querySelector("#addUpdateSongForm").elements["title"].value.trim() == "") {
                valid=false;
            }
            if (document.querySelector("#addUpdateSongForm").elements["artist"].value.trim() == "") {
                valid=false;
            }
            if (document.querySelector("#addUpdateSongForm").elements["style"].value.trim() == "") {
                valid=false;
            }
            
            if (!valid){
                return false;
            }
            else{
                return true;
            }
        }

         /**
         */
        function removeSong(id) {
            document.querySelector("#removeSongForm").elements["formsongaction"].value = "remove";
            document.querySelector("#removeSongForm").elements["formsongid"].value = id;



            let modal = document.getElementById('removeSongModal');
            modal.style.display='block';
        }

        function removeLyrics(id) {
            document.querySelector("#removeLyricsForm").elements["formsongaction"].value = "removeLyrics";
            document.querySelector("#removeLyricsForm").elements["formsongid"].value = id;



            let modal = document.getElementById('removeLyricsModal');
            modal.style.display='block';
        }


        function addLyrics(id, title) {
            document.querySelector('#addLyricsModalLabel').innerText="Add Lyrics to "+title;

            document.querySelector("#addLyricsForm").elements["formsongid"].value = id;

            let modal = document.getElementById('addLyricsModal');
            modal.style.display='block';
        }

    </script>

    <!-- 
        DIV contenant le formulaire d'ajout ou de modif d'un titre
    -->

    <div id="addUpdateSongModal" class="modal">
  
        <form id="addUpdateSongForm" onsubmit="return check();"  class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="dlgheadcontainer">
                <span onclick="document.getElementById('addUpdateSongModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1 id="addUpdateSongModalLabel">Song Edit :</h1>
            </div>

            <div class="dlgcontainer">
                <input type="hidden" name="formsongaction" id="addorupdate">
                <input type="hidden" name="formsongid" id="formsongid" >


                <label for="uname"><b>Song Title :</b></label>
                <input type="text" name="title" id="songtitle" placeholder="Song Title">

                <label for="psw"><b>Song Artist :</b></label>
                <input type="text" name="artist" id="songartist" placeholder="Song Artist">

                <label for="psw"><b>Style :</b></label>
                <input type="text" name="style" id="songstyle" placeholder="Style">
                    
                <button type="submit" class="okbtn">Apply</button>
                <button type="button" onclick="document.getElementById('addUpdateSongModal').style.display='none'" class="cancelbtn">Cancel</button>

            </div>

        </form>
    </div>


    <div id="removeSongModal" class="modal">
  
        <form id="removeSongForm" class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="dlgheadcontainer">
                <span onclick="document.getElementById('removeSongModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1 id="removeSongModalLabel">Song Remove ?</h1>
            </div>

            <div class="dlgcontainer">
                <input type="hidden" name="formsongaction" id="addorupdate">
                <input type="hidden" name="formsongid" id="formsongid" >

                <button type="submit" class="okbtn">Yes</button>
                <button type="button" onclick="document.getElementById('removeSongModal').style.display='none'" class="cancelbtn">No</button>

            </div>

        </form>
    </div>

    <div id="removeLyricsModal" class="modal">
  
        <form id="removeLyricsForm" class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="dlgheadcontainer">
                <span onclick="document.getElementById('removeLyricsModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1 id="removeLyricsModal">Lyrics Remove ?</h1>
            </div>

            <div class="dlgcontainer">
                <input type="hidden" name="formsongaction" id="addorupdate">
                <input type="hidden" name="formsongid" id="formsongid" >

                <button type="submit" class="okbtn">Yes</button>
                <button type="button" onclick="document.getElementById('removeLyricsModal').style.display='none'" class="cancelbtn">No</button>

            </div>

        </form>
    </div>


    <div id="addLyricsModal" class="modal">
  
        <form id="addLyricsForm" enctype="multipart/form-data" class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="dlgheadcontainer">
                <span onclick="document.getElementById('addLyricsModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                <h2 id="addLyricsModalLabel">Add Lyrics</h2>
            </div>

            <div class="dlgcontainer">
                <input type="hidden" name="formsongid" id="formsongid" />

                
                <label for="uname"><b>Select PDF file to upload :</b></label>
                <input type="file" name="fileToUpload" id="fileToUpload">

                <button type="submit" class="okbtn">Upload</button>
                <button type="button" onclick="document.getElementById('addLyricsModal').style.display='none'" class="cancelbtn">Cancel</button>

            </div>

        </form>
    </div>



    <div class="row">
        <div class="col-sm">
            <table id="songTable" style="width:100%;margin: auto;">
                <thead>
                    <tr>
                    <th class="headersearch" colspan="3"><input type="text" class="searchinput" id="searchInput" onkeyup="searchFunction()" placeholder="Search .."/></th>
                    <?php
                    if ($member)
                    {
                        ?>
                        <th class='align-middle' colspan="3"><input type="checkbox" id="lyricsfilter" onchange="filterOnLyrics();" />&nbsp;&nbsp;<label class="filter" for="lyricsfilter">With Lyrics</label></th>
                        <?php
                    }
                    ?>
                    </tr>
                    <tr>
                        <th class="headersort"><a href="./setlist.php?column=title&order=<?php echo $asc_or_desc; ?>">TITLE <i class="fas fa-sort<?php echo $column == 'title' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th class="headersort"><a href="./setlist.php?column=artist&order=<?php echo $asc_or_desc; ?>">ARTIST(S) <i class="fas fa-sort<?php echo $column == 'artist' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th class="headersort"><a href="./setlist.php?column=style&order=<?php echo $asc_or_desc; ?>">STYLE <i class="fas fa-sort<?php echo $column == 'style' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <?php
                        if ($member)
                        {
                            ?>
                            <th class="headersort">LYRICS (PDF)</th>
                            <?php
                            if ($admin){
                                ?>
                                <th colspan=2 class="headersort"><button onclick="addormodifySong('add');" type='button' class='addbtn'><i class='fa fa-plus'></i></button></th>
                                <?php
                            }
                        }

                        
                        ?>

                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($connexion->query($sql) as $row) {
                        echo "<tr><td>".$row['title']."</td> <td>".
                                        $row['artist']."</td> <td>".
                                        $row['style']."</td>";
                        if ($member)
                        {
                            echo  "<td class='align-middle'>".($row['lyrics']!==NULL?"<button type='button' class='downloadbtn'><a style='color:white;' href=\"download_lyrics.php?lyricsPDF=" . $row['lyrics'] . "\"><i class='fa fa-download'></i></a></button>":"");
                        }
                                       
                        if ($admin){
                            if ($row['lyrics']===NULL)
                            {
                                echo "&nbsp;&nbsp;<button onclick=\"addLyrics(" . $row['id'] . ", '".$row['title']."');\" type='button' class='uploadbtn'><i class='fa fa-upload'></i></button></td>";
                            }
                            else{
                                echo "&nbsp;&nbsp;<button onclick=\"removeLyrics(" . $row['id'] . ", '".$row['title']."');\" type='button' class='uploadcancelbtn'><i class='fa fa-times'></i></button></td>";
                            }
                            echo "<td class='align-middle'><button onclick=\"addormodifySong('modify', " . $row['id'] . ", '".addslashes($row['title'])."', '".addslashes($row['artist'])."', '".addslashes($row['style'])."');\" type='button' class='editbtn'><i class='fa fa-pen'></i></button></td>"; 
                            echo "<td class='align-middle'><button onclick='removeSong(" .  $row['id'] . ");' type='button' class='cancelbtn'><i class='fa fa-trash'></i></button></td></tr>" ;
                        }
                        else{
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                ?> 
                </tbody>
            </table>
        </div>
    </div>


</div>
  
<?php
}


require('footer.php');
?>