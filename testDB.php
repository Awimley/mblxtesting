<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script></head>
    <body>
        <?php
     require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
 $statement = $databaseConnection->prepare("SELECT * FROM mblxdev.testtable");
                                $statement->execute();

                                if($statement->error)
                                {
                                    die("Database query failed: " . $statement->error);
                                }

                                $statement->bind_result($id, $menulabel);
                                while($statement->fetch())
                                {
                                    echo "<li><a href=\"/page.php?pageid=$id\">$menulabel</a></li>\n";
                                }
?>
    </body>
</html>
