<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Notebook</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>

          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container-sm">
    <div class="mb-3">
      <h2 style="margin-left: 100px";>Add Your Note on Notebook</h2>
      <form action="http://localhost/crud/index.php" method="post">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" class="form-control" name="Title" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
      <textarea class="form-control" name="Description" id="exampleFormControlTextarea1" rows="3"></textarea>
      <button class="btn btn-success my-4">Submit</button>
      </form>
    </div>
    <?php
$server="localhost";
$username="root";
$password="";
$database="nootebook";
$con=mysqli_connect($server,$username,$password,$database);
if(!$con){
    die("Sorry failed to connect".mysqli_error($con));
}
?>
<?php
if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete="delete from inotebook where Sno=$sno";
  $result=mysqli_query($con,$delete);
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset( $_POST['snoEdit'])){
    $sno=$_POST['snoEdit'];
    $title=$_POST["editTitle"];
    $description=$_POST["editDescription"];
    $update="UPDATE `inotebook` SET `Title`='$title',`Description`='$description' WHERE `inotebook`.`Sno`=$sno";
    $result=mysqli_query($con,$update);
    if($result){
      echo "<script>alert('Your note is updated successfuly') </script>";
    }
    else{
      echo "<script>alert('something went wrong')</script>";
    }
  }
  else{
  $title=$_POST["Title"];
  $description=$_POST["Description"];
  $query="insert into inotebook (Title,Description) values ('$title','$description')";
  $Data=mysqli_query($con,$query);
  if($Data){
    echo "<script>alert('Your Note inserted sucessfully') </script>";
  }
  else{
    echo "<script>alert('Something went wrong') </script>";
  }
}
}
?>  

    <?php
$sql="select * from inotebook";
$result=mysqli_query($con,$sql);
$num= mysqli_num_rows($result);
// echo $num;
if($num>0){
    echo "<br>";
// $row=mysqli_fetch_assoc($result);
// echo var_dump($row);
// $row=mysqli_fetch_assoc($result);
// echo var_dump($row);
echo ' <table class="table container" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sr no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>';
  $Sr_no=0;
while ($row=mysqli_fetch_assoc($result)){
    // echo var_dump($row);
    // echo "<br>";
    $Sr_no=$Sr_no+1;
    echo '
    <tr>
    <th scope="row">'.$Sr_no.'</th>
    <td>'.$row["Title"].'</td>
    <td>'.$row["Description"].'</td>
    <td><button class="btn btn-success edit" id='.$row["Sno"].'>Edit</button><button class="btn btn-warning mx-1 delete"  id=d'.$row["Sno"].'>Delete</button>
    </tr>';
}}
echo'</tbody>
</table>';
?>
  </div>
   <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="http://localhost/crud/index.php" method="post">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <label for="exampleFormControlInput2" class="form-label">Title</label>
            <input type="text" class="form-control titleEdit" name="editTitle" id="exampleFormControlInput2">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Description</label>
          <textarea class="form-control desEdit" name="editDescription" id="exampleFormControlTextarea2"
            rows="3"></textarea>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success my-4">Submit</button>
       
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach(element => {
      element.addEventListener('click', (element) => {
        tr = element.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        des = tr.getElementsByTagName('td')[1].innerText;
        titleEdit = document.getElementById('exampleFormControlInput2');
        desEdit = document.getElementById('exampleFormControlTextarea2');
        titleEdit.value = title;
        desEdit.value = des;
        snoEdit.value=element.target.id;
        console.log(snoEdit)
        $('#myModal').modal('toggle');
      })
    });
        deletes = document.getElementsByClassName('delete')
        Array.from(deletes).forEach(element => {
          element.addEventListener('click', (element) => {
            sno=element.target.id.substr(1);
            if(confirm("Are you want to delete this record")){
              window.location=`/crud/index.php?delete=${sno}`;
            }else{
              console.log("no");
                  }
          })
        });

  </script>

</body>

</html>