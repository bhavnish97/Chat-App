<?php
 session_start();
  echo'<center>
      <div id="loginform">
      <form method="post">
        <h3>Enter ur name:</h3>
        Name:<input type="text" name="name" id="name"/>
        <input type="submit" name="Submit" id="Submit" value="Submit"/>
      </form>  
    </div>
    </center>';
    $name="";
    function write(){
    	$text=$_POST["msg"];
    	$fp=fopen("log.html",'a');
    	fwrite($fp, "<div class='msgln'>(".date("g:i A").")<b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    	fclose($fp);
    }
    if(isset($_POST['Submit'])){
    	if($_POST['name']!=""){
    		//echo "<div class='msgln'><i>User ". $_SESSION['name']." has join the session.</i><br></div>";
    		echo "<script> document.body.innerHTML = ''; 
            </script>";
    		$_SESSION['name']=stripslashes(htmlspecialchars($_POST['name']));
    		$name=$_SESSION['name'];
    		$fp = fopen("log.html",'a');
    		fwrite($fp,"<div class='msgln'><i>User ". $_SESSION['name']." has join the session.</i></div>");
    		fclose($fp);
    		echo'<div><center><h2><b>WELCOME  </b><b>'.$_SESSION["name"]. '</b></h2></center></div>';
    		$matter="";
    		if(file_exists("log.html") && filesize("log.html")>0){
    			$result=fopen("log.html",'r');
    			$matter=fread($result,filesize("log.html"));
    			fclose($result);
    		}
    		echo "<center><div style='margin-left:10%;margin-right:10%;width:75%;border:solid;height:75%;overflow:auto;padding:10px;background-color:grey;color:black'id='chatbox'>
    		<p>".$matter."</p></div></center>";
    		echo "<form method='post' style='margin-left:15%;margin-right:15%;'>
    		         <input type='text' name='msg' palceholder='enter ur msg..'style='width:94%;padding:5px'>
    		         <input type='submit' name='send' value='SEND' style='padding:5px'>
    		       </form>";
    		 echo "<div style='float:right;margin-right:10%'>
    		 <form method='get'>
    		 <center><input type='submit' name='logout' value='LOG OUT'></center>
    		 </form>
    		 </div>
    		 ";        
    	}
    	else{
    		echo '<span class="error">Plz enter a name</span>';
    	}
    }
    if(isset($_GET['logout'])){
    	$fp=fopen("log.html",'a');
    	fwrite($fp,"<div class='msgln'><i>User ".$_SESSION['name']." has left the session.</i><br></div>");
    	session_destroy();
    	header("Location:index.php");
    }
    if(isset($_POST["send"])){
    	if($_POST["msg"]!=""){
    		write();
    		echo " <script> document.body.innerHTML='';</script>";
    		echo'<div><center><h2><b>WELCOME  </b><b>'.$_SESSION["name"]. '</b></h2></center></div>';
    		$matter="";
    		if(file_exists("log.html") && filesize("log.html")>0){
    			$result = fopen("log.html","r");
    			$matter=fread($result,filesize("log.html"));
    			fclose($result);
    		}
    		echo " <center><div style='margin-left:10%;margin-right:10%;width:75%;border:solid;height:75%;overflow:auto;padding:10px;background-color:grey;color:black'id='chatbox'>
    		<p>".$matter."</p></div></center>";
    		echo "<form method='post' style='margin-left:15%;margin-right:15%;'>
    		         <input type='text' name='msg' palceholder='enter ur msg..'style='width:94%;padding:5px'>
    		         <input type='submit' name='send' value='SEND' style='padding:5px'>
    		       </form>";
    		        echo "<div style='float:right;margin-right:10%'>
    		                   <form method='get'>
    		                      <center><input type='submit' name='logout' value='LOG OUT'></center></form></div>";
    	}
    }
 ?>