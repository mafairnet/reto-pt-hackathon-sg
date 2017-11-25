<?php
require 'simple_html_dom.php';


$html = file_get_html("http://lahabichuela.com/menu2017/");
Ã
foreach ($html->find('img') as $j)
	echo $j;

foreach($html->find('p') as $i)
	echo $i;

?>
