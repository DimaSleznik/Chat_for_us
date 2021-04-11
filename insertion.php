<?php   $host = 'localhost'; 
        $user = 'root';
		$password = '';
		$db_name = 'main_test'; 
		$link = mysqli_connect($host, $user, $password, $db_name);
		$query ='SELECT * FROM `user_test`';
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_num_rows($result); 
        $arr_text = [];
        for ($i = 0 ; $i < $rows ; ++$i){
        $row = mysqli_fetch_row($result);   
             for ($j = 1 ; $j < 2 ; ++$j) array_push($arr_text, $row[$j]);
    };
         $jso = json_encode($arr_text);
         echo $jso;
         mysqli_close($link);
      ?>