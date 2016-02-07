    <!DOCTYPE HTML>
<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css" type="text/css">
    <title>Tanker</title>
    </head>
    <body background="see.jpg">
    <?php
		$t1=$_POST['tank1'];
		$t2=$_POST['tank2'];
		$t3=$_POST['tank3'];
		$l1=$_POST['liq1'];
		$l2=$_POST['liq2'];
		$fl=0; //заливали в первый танк или нет
		$fl2=0; //заливали во второй танк или нет
		$fl3=0; //заливали в третий танк или нет
		$e4=0; $e5=0;
		
		$l_max=max($l1,$l2); //находим максимальный объем из двух жидкостей
		switch($l_max) //запоминаем какая из жидкостей имеет максимальный объем, присваивая переменной $l_tmp значение другой
		{
			case $l1: $l_tmp=$l2; break; //если бензина больше, то $l_tmp = объему керосина  
			case $l2: $l_tmp=$l1; break; //если керосина больше, то $l_tmp = объему бензина 
		}
		
		$t_max=max($t1,$t2,$t3); //находим максимальный объем из всех танков
		switch($t_max)
		{
			/*Заливаем в первый бак*/ case $t1: $rest=$t_max-$l_max; if ($rest>0) {$e1=$l_max.'/'.$t1; $t_max=max($t2,$t3); $rest=0; $l_max=0; $fl=1; if ($l1>$l2) {$fl_c1=11;} else {$fl_c1=12;}}
																	else { $e1=$t1.'/'.$t1; $l_max=abs($rest); $t_max=max($t2,$t3); $fl=1; if ($l1>$l2) {$fl_c1=11;} else {$fl_c1=12;}} break;
			/*Заливаем во второй бак*/ case $t2: $rest=$t_max-$l_max; if ($rest>0) {$e2=$l_max.'/'.$t2; $t_max=max($t1,$t3); $rest=0; $l_max=0; $fl2=1; if ($l1>$l2) {$fl_c2=21;} else {$fl_c2=22;}}
																	else { $e2=$t2.'/'.$t2; $l_max=abs($rest); $t_max=max($t1,$t3); $fl2=1; if ($l1>$l2) {$fl_c2=21;} else {$fl_c2=22;}} break; 
			/*Заливаем в третий бак*/ case $t3: $rest=$t_max-$l_max; if ($rest>0) {$e3=$l_max.'/'.$t3; $t_max=max($t1,$t2); $rest=0; $l_max=0; $fl3=1; if ($l1>$l2) {$fl_c3=31;} else {$fl_c3=32;}}
																	else { $e3=$t3.'/'.$t3; $l_max=abs($rest); $t_max=max($t1,$t2); $fl3=1; if ($l1>$l2) {$fl_c3=31;} else {$fl_c3=32;}} break;
		}
		
		if ($l1<$l2) {$e5=$l_max; $e4=$l_tmp;}
		else {$e4=$l_max; $e5=$l_tmp;}

		$l_max=max($l_max,$l_tmp); //находим максимальный объем среди остатка жидкости, часть которой уже залили, и жидкости, которую еще не заливали
		switch($l_max) //запоминаем какая из жидкостей имеет максимальный объем, присваивая переменной $l_tmp значение другой
		{
			case $l_tmp: $l_tmp=abs($rest); break; //максимальный объем у остатка 
			case abs($rest): $l_tmp=$l_tmp; break; //максимальный объем у жидкости, которую не трогали
		}

		switch (1)
		{
			case $fl: 		switch($t_max)
		{

			/*Заливаем во второй бак*/ case $t2: $rest=$t_max-$l_max; if ($rest>0) {$e2=$l_max.'/'.$t2; $rest=0; $l_max=0; $fl2=1; if ($l_max>$l_tmp) {$fl_c2=21;} else {$fl_c2=22;}}
																	else { $e2=$t2.'/'.$t2; $l_max=abs($rest); $fl2=1; if ($l_max>$l_tmp) {$fl_c2=21;} else {$fl_c2=22;}} break; 
			/*Заливаем в третий бак*/ case $t3: $rest=$t_max-$l_max; if ($rest>0) {$e3=$l_max.'/'.$t3; $rest=0; $l_max=0; $fl3=1; if ($l_max>$l_tmp) {$fl_c3=31;} else {$fl_c3=32;}}
																	else { $e3=$t3.'/'.$t3; $l_max=abs($rest); $fl3=1; if ($$l_max>$l_tmp) {$fl_c3=31;} else {$fl_c3=32;}} break;
		} break;
			case $fl2: 		switch($t_max)
		{
			/*Заливаем в первый бак*/ case $t1: $rest=$t_max-$l_max; if ($rest>0) {$e1=$l_max.'/'.$t1; $rest=0; $l_max=0; $fl=1; if ($l_max>$l_tmp) {$fl_c1=11;} else {$fl_c1=12;}}
																	else { $e1=$t1.'/'.$t1; $l_max=abs($rest); $fl=1; if ($l_max>$l_tmp) {$fl_c1=11;} else {$fl_c1=12;}} break;
			/*Заливаем в третий бак*/ case $t3: $rest=$t_max-$l_max; if ($rest>0) {$e3=$l_max.'/'.$t3; $rest=0; $l_max=0; 	$fl3=1; if ($l_max>$l_tmp) {$fl_c3=31;} else {$fl_c3=32;} }
																	else { $e3=$t3.'/'.$t3; $l_max=abs($rest); $fl3=1; if ($l_max>$l_tmp) {$fl_c3=31;} else {$fl_c3=32;}} break;
		} break;
			case $fl3: 		switch($t_max)
		{
			/*Заливаем в первый бак*/ case $t1: $rest=$t_max-$l_max; if ($rest>0) {$e1=$l_max.'/'.$t1; $rest=0; $l_max=0; $fl=1; if ($l_max>$l_tmp) {$fl_c1=11;} else {$fl_c1=12;}}
																	else { $e1=$t1.'/'.$t1; $l_max=abs($rest); $fl=1; if ($l_max>$l_tmp) {$fl_c1=11;} else {$fl_c1=12;}} break;
			/*Заливаем во второй бак*/ case $t2: $rest=$t_max-$l_max; if ($rest>0) {$e2=$l_max.'/'.$t2; $rest=0; $l_max=0; $fl2=1; if ($l_max>$l_tmp) {$fl_c2=21;} else {$fl_c2=22;}}
																	else { $e2=$t2.'/'.$t2; $l_max=abs($rest); $fl2=1; if ($l_max>$l_tmp) {$fl_c2=21;} else {$fl_c2=22;}} break; 
		} break;
		}
				
		if ($l_max>$l_tmp) {$e4=$l_max; $e5=$l_tmp;}
		else {$e5=$l_max; $e4=$l_tmp;}
		
		
		$l_max=max($l_max,$l_tmp);
		switch($l_max) //запоминаем какая из жидкостей имеет максимальный объем, присваивая переменной $l_tmp значение другой
		{
			case $l_tmp: $l_tmp=abs($rest); break; //максимальный объем у остатка 
			case abs($rest): $l_tmp=$l_tmp; break; //максимальный объем у жидкости, которую не трогали
		}

		switch (0)
		{
			case $fl: $rest=$t1-$l_max; if ($rest>0) {$e1=$l_max.'/'.$t1; $rest=0; $l_max=0; if ($l_tmp<$l_max) {$fl_c1=11;} else {$fl_c1=12;}}
										else { $e1=$t1.'/'.$t1; $l_max=abs($rest); if ($l_tmp<$l_max) {$fl_c1=11;} else {$fl_c1=12;}} break;
			case $fl2: $rest=$t2-$l_max; if ($rest>0) {$e2=$l_max.'/'.$t2; $rest=0; $l_max=0; if ($l_tmp<$l_max) {$fl_c2=21;} else {$fl_c2=22;}}
										else { $e2=$t2.'/'.$t2; $l_max=abs($rest); if ($l_tmp<$l_max) {$fl_c2=21;} else {$fl_c2=22;}} break; 
			case $fl3: $rest=$t3-$l_max; if ($rest>0) {$e3=$l_max.'/'.$t3; $rest=0; $l_max=0; if ($l_tmp<$l_max) {$fl_c3=31;} else {$fl_c3=32;}}
										else { $e3=$t3.'/'.$t3; $l_max=abs($rest); if ($l_tmp<$l_max) {$fl_c3=31;} else {$fl_c3=32;}} break;
		}

		if ($l1<$l2) {$tmp=$l_tmp; $l_tmp=$l_max; $l_max=$tmp;}
		$e4=$l_max; $e5=$l_tmp;
		//if ($l_max>$l_tmp) {$e4=$l_max; $e5=$l_tmp;}
		//else {$e5=$l_max; $e4=$l_tmp;}
    ?>  
	<div class="mainpage" id="center">
	<div class="header" >Расчет загрузки танков</div>
		<form name="main" action="tanker.html" method="POST" enctype="multipart/form-data"> 
			<img src="tanker.png" width="700" height="250">
			<font color="white" size="3" face="tahoma" style="position:absolute; top:55px; left: 270px">Заполненность танков</font>
			<input type="text" name="tank1" id="t1" size="10"  value="<?echo $e1;?>" style="position:absolute; top:155px; left: 170px;" disabled >
			<input type="text" name="tank2" size="10"  value="<?echo $e2;?>" style="position:absolute; top:155px; left: 330px;" disabled >
			<input type="text" name="tank3" size="10"  value="<?echo $e3;?>" style="position:absolute; top:155px; left: 490px;" disabled >
			
			<font color="white" size="3" face="tahoma" style="position:absolute; top:260px; left: 250px">Остаток жидкого груза</font>
			<p>
			<table border=0 cellpadding="2" align="center">
				<td colspan="2" align="center">____________________________________________________________________________</td>
				<tr>
					<td align="right"><font color="yellow" size="3" face="tahoma">Бензин:   </font><input type="text" name="liq1" size="10" style="color:yellow" value="<?echo $e4;?>" disabled></td> <td align="center"><font color="lime" size="3" face="tahoma">Керосин:   </font><input type="text" name="liq2" size="10" style="color:lime" value="<?echo $e5;?>" disabled></td> 
				</tr>	
				<td colspan="2" align="center">____________________________________________________________________________</td>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="submit" value="Произвести новый расчет"></td> 
				</tr>
			</table>
		</form>
	</div> 
    </body>
</html>