<!DOCTYPE html>
<html>
   <head>
      <title>
         Dictionary by github.com/dev7060
      </title>
      <style>
         .center {
         margin: auto;
         width: 60%;
         border: 1px solid #000000;
         padding: 10px;
         }
         .imagecl{
         display: block;
         margin-left: auto;
         margin-right: auto;
         }
         .centrecl{
            text-align:center;
            display: block;
            margin: auto;
         }
      </style>
   </head>
   <body>
      <?php
         if(!isset($_POST["submit"])){
         ?>
      <div class="center">
         <form action="index.php" method="post">
            <input type="text" name="word" class="centrecl"><br>
            <input type="submit" name="submit" class="centrecl">
         </form>
      </div>
      <?php
         }else{
             ?>
      <div class="center">
         <form action="index.php" method="post" >
            <input type="text" name="word" class="centrecl" value="<?php echo $_POST["word"]; ?> "><br>
            <input type="submit" name="submit" class="centrecl">
         </form>
      </div>
      <br>
      <br>
      <div class="center">
         <?php
            $auth_code = file_get_contents("auth.txt");
            $word = $_POST["word"];
            $cmd = "curl --header \"Authorization: Token " . $auth_code . "\" https://owlbot.info/api/v4/dictionary/" . $word . " > temp";
            system($cmd);
            $file_content = file_get_contents("temp");
            unlink("temp");
            $json_array = json_decode($file_content, true);
            ?>
         <?php
            /*
            echo "<table>
                <tr>
                    <td rowspan=\"2\">" . "<img src=\"" . $json_array["definitions"][0]["image_url"] . "\">" . "</td>
                    <td><strong>Definition: </strong>" . $json_array["definitions"][0]["definition"] . "</td>
                </tr>
                <tr>
                    <td><strong>Example: </strong>" . $json_array["definitions"][0]["example"] . "</td>
                </tr>
            </table>";
            */
            echo "<p class=\"centrecl\"><strong>Definition: </strong>";
            echo $json_array["definitions"][0]["definition"];
            echo "</p><p class=\"centrecl\"><strong>Example: </strong>";
            echo $json_array["definitions"][0]["example"];
            echo "</p><p>";
            echo "<img src=\"" . $json_array["definitions"][0]["image_url"] . "\" class=\"imagecl\">";
            echo "</p>";
            }
            ?>
      </div>
   </body>
</html>
