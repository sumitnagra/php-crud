 <?php
$pointer=fopen("untitled.txt","r");
echo fgets($pointer)."<br>";
echo fgets($pointer)."<br>";
echo fgets($pointer)."<br>";
// echo var_dump(fgets($pointer));
// echo fgetc($pointer);
// echo fgetc($pointer);

// while($a=(fgets($pointer))){
    // echo $a."<br>";
// }
// echo "end of the  file reach";

while($a=(fgetc($pointer))){
    echo $a;
}
echo "end of the  file reach";

fclose($pointer);
 ?>