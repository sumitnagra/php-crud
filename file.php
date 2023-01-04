<?php
// $a=readfile("untitled.txt");
// echo $a;   
// readfile("1-png.png");
readfile("file.html")
?>

<?php
$filepointer=fopen("untitled.txt","r");
// echo var_dump($filepointer)
if (!$filepointer){
    die("unable to open");
}
$content=fread($filepointer,filesize("untitled.txt"));// file size is an integer value
fclose($filepointer);
echo $content;
?>