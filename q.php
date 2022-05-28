<?php
if(isset($_POST['val'])){
    $va=json_decode($_POST['val'], true);
    $dsn='mysql:host=localhost;dbname=projectweb';
    $user='root';
    $pass='';
    try
    {
        $db=new PDO($dsn,$user,$pass);
        $db->setAttribute (PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
       try{ 
           $i=0;
           for($j=0;$j<count($va);$j++)
           {
               foreach($va[$j] as $key =>$value)
               {
                   $i++;
                   $q="INSERT INTO data VALUES ('$key', '$value')";
                   $db->exec($q);
                }
           }
       }
        catch(PDOException $e)
        {
            echo 'faild'. $e->getMessage();
        }
    }
    catch(PDOException $e)
    {
        echo 'faild'. $e->getMessage();
    } 
}

//  =================================================================================================>
else if(isset($_GET['val']))
{
	$va=json_decode($_GET['val'], true);
    $dsn='mysql:host=localhost;dbname=projectweb';
    $user='root';
    $pass='';
    try
    {
        $db=new PDO($dsn,$user,$pass);
        $db->setAttribute (PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	    try
		{
			$q="select * from data where 1";
			$aut=$db->query($q);
			while($row=$aut->fetch(PDO::FETCH_ASSOC)){
				echo $row['event']."   ".$row['value']."\n";
			}
	    }
       
        catch(PDOException $e)
        {
            echo 'faild'. $e->getMessage();
        }
    }
    catch(PDOException $e)
    {
        echo 'faild'. $e->getMessage();
    } 
	$q="DELETE FROM `data` WHERE 1";
    $db->exec($q);
}
// ============================================================================================>
else 
{
    echo "couldn't connect the data base";
}















?>