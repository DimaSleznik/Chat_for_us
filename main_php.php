<!DOCTYPE html>
<html>
<head>
	<title>Наше место</title>
</head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">

<body>
	<h1 id='main_title'>НАШЕ МЕСТО</h1>
<link rel="stylesheet" href="style.css">
<canvas id='nc'></canvas>
<form action="main_php.php" method="POST">
<input type="text" name="messege" value=""  id='in' autocomplete="off">
<input type="submit" value="|>" id='butt' class ='submit' name="" onclick='add()'></form>
</script>
<?php
        $host = 'localhost'; 
		$user = 'root'; 
		$password = '';
		$db_name = 'main_test'; 
		$link = mysqli_connect($host, $user, $password, $db_name);
		$table = 'user_test';
		$query ='SELECT * FROM `user_test`';
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_num_rows($result); 
        $arr_text = [];
        for ($i = 0 ; $i < $rows ; ++$i){
         $row = mysqli_fetch_row($result);   
             for ($j = 1 ; $j < 2 ; ++$j) array_push($arr_text, $row[$j]);
    };
         $json = json_encode($arr_text);
         if(isset($_POST)&& $_POST!=FALSE){
          $new_messege = $_POST['messege'];
          $new_query = "INSERT INTO user_test VALUES (NULL,'$new_messege')";
          if (mysqli_query($link, $new_query)) {
          mysqli_close($link);
          header('Location: /valentin/main_php.php');
          } else {
               echo "Error: " . $new_query . "<br>" . mysqli_error($link);
                     }
   
      };
   

		



?>



<script type="text/javascript">
let full_width = document.documentElement.clientWidth;
let full_height = document.documentElement.clientHeight;
let canvas = document.getElementById('nc');
let ctx = canvas.getContext('2d');
canvas.width = full_width;
canvas.height = full_height;
document.body.appendChild(canvas);
ctx.fillStyle = "#F0FFFF";
heart(0, 0);
heart(0, full_height-130);
heart(full_width-140, full_height-130);
heart(full_width-140, 0);
let inp = document.getElementById('in');
let new_button = document.getElementById('butt');
new_button.style.marginLeft = full_width/2+280+'px';
new_button.style.marginTop = full_height/2+150+'px';
//
inp.style.marginLeft = full_width/2-inp.style.width-400+'px';
inp.style.marginTop = full_height/2+150+'px';
let text_block = document.createElement('div');
text_block.className = 'messege_block';
document.body.prepend(text_block);
text_block.style.marginLeft = full_width/2-inp.style.width-400+'px';
text_block.style.marginTop = full_height/2-250+'px';
let new_array = JSON.parse('<?php echo $json; ?>');
setInterval(messege_update, 1000);
for(let i = 0;i<new_array.length;i++){
	let new_elem = document.createElement('div');
	new_elem.className = 'messege';
	new_elem.innerHTML = `<p>${new_array[i]}</p>`;
	text_block.prepend(new_elem);


}
setInterval(animate_title,2000);
setInterval(animate_title2,2500);


function animate_title(){
	    console.log('work');
	    let main_title_elem = document.getElementById('main_title');
	    	main_title_elem.style.letterSpacing='50px';
	    	
}
function animate_title2(){
	console.log('work');
	    let main_title_elem = document.getElementById('main_title');
	        main_title_elem.style.letterSpacing='5px';
	        

}
function messege_update(){


         const requestURL = 'insertion.php';
         const xhr = new XMLHttpRequest();
         xhr.open('GET',requestURL);
         xhr.onload = ()=>{
         	let array_updated = JSON.parse(xhr.response);
            if(JSON.stringify(array_updated) === JSON.stringify(new_array));
            else{
         	let new_elem = document.createElement('div');
	        new_elem.className = 'messege';
	        new_elem.innerHTML = `<p>${array_updated[array_updated.length-1]}</p>`;
	        text_block.prepend(new_elem);
         	new_array = array_updated;

         }

         }
         xhr.send();
         


}
function add(){

}
function heart(x,y){
	ctx.beginPath();
    ctx.bezierCurveTo(75+x, 37+y, 70+x, 25+y, 50+x, 25+y);
    ctx.bezierCurveTo(20+x, 25+y, 20+x, 62.5+y, 20+x, 62.5+y);
    ctx.bezierCurveTo(20+x, 80+y, 40+x, 102+y, 75+x, 120+y);
    ctx.bezierCurveTo(110+x, 102+y, 130+x, 80+y, 130+x, 62.5+y);
    ctx.bezierCurveTo(130+x, 62.5+y, 130+x, 25+y, 100+x, 25+y);
    ctx.bezierCurveTo(85+x, 25+y, 75+x, 37+y, 75+x, 40+y);
    ctx.fill();
    ctx.closePath();

}




</script>


</body>
</html>

