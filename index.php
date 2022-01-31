<style>
    .box{
        border: 1px solid #aaa; /*getting border*/
        border-radius: 4px; /*rounded border*/
        color: #000; /*text color*/
    }
</style>
<html>
    <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <meta charset="UTF-8">
    <title>ana sayfa</title>
</head>
<body> <?php  $mysqli = new mysqli("localhost","root","","twitci");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
} ?>
    <div class="container ">
          <div class="row">

  <div class="col" style="background:red">
         <form method="post">
     <label for="w3review">Review of W3Schools:</label>

<textarea id="w3review" name="w3review" rows="4" cols="50">
At w3schools.com you will learn how to make a website. They offer free tutorials in all web development technologies.
</textarea>     <input type="submit" name="buton2" value="ekle"></form>
       </div> <div class="col" style="background:red">
           <form method="post"><br>
          Arama Yapın

               <input type="submit" name="buton1" value="ara"> </form>
           <?php
           $str="";
           $sql = "SELECT yazi FROM tweet";
$result = $mysqli -> query($sql);
while($row = $result -> fetch_assoc()){
    $tmp=$row["yazi"];
$str=$str.$tmp." ";


}$result -> free_result();

$arr=array();
       
           $str2 = str_replace( array( '\'', '"',
      ',' , ';', '<', '>' ,'.'), '', $str);
           $str2 = strtolower($str2);
           $token= strtok($str2," ");
           if ($_SERVER["REQUEST_METHOD"] == "POST") {
           if(isset($_POST["buton1"]))
{
while ($token !== false)
{
    //echo "$token<br>";
    if (array_key_exists($token,$arr))
  {
        
  $arr[$token]=$arr[$token]+1;
  }
else
  {
  $arr2=array($token=>1);
  $arr= array_merge($arr,$arr2);
  
  }
   $token = strtok(" ");
    
}
print_r($arr);

}
if(isset($_POST["buton2"])){
    $xyz=$_POST["w3review"];
$stmt = $mysqli->prepare("INSERT INTO tweet (yazi) VALUES (?)");
$stmt->bind_param("s", $xyz);
$stmt->execute();
$stmt->close();

}
  }
           ?>
                   
        </div>
      </div>      
</div>
    <?php
   

$sql = "SELECT * FROM tweet";
$result = $mysqli -> query($sql);

while($row = $result -> fetch_assoc()){
  $var = $row["yazi"];
echo '<textarea id="w3review" name="w3review" rows="4" cols="50">'.$var.'</textarea><br><br>';


}
    
// Free result set
$result -> free_result();






$mysqli -> close();
    ?>
</body>
</html>
