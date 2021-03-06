<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <title>AdminLTE 2 | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://www.w3schools.com/lib/w3.js"></script>
<script type="text/javascript" src="assets/dist/js/include.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/dist/css/dept.css">
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div w3-include-html="pages/content1.html"></div>

  <div class="content-wrapper" id = "sampleCenter">
    <!-- Content Header (Page header) -->
    
     <section class="content container-fluid"> 
<?php
session_start();
// // include_once 'curdoperations.php';
include_once 'models/devices.php'; //
$devObj = new Devices();

//deletion
 if(isset($_GET['did']))
 {
    $id = $_GET['did'];
    $devObj->delete($id);
    header("location:devices.php");
    exit();
     
  }

//updation
if(isset($_GET['uid'])) 
            {   
                $_SESSION['id'] = $_GET['uid'];
                header("location:updatedev.php");
                exit();
            }   
              
// //Addition
if(isset($_POST['submit'])) 
        {
          if(isset($_POST['isActive'])){
            $_POST['isActive'] = 1;
            array_pop($_POST);
          } 
          else{
            array_pop($_POST);
            $_POST['isActive']   = 0;
          }
          $devObj->addDevices($_POST);
          header("location:devices.php");
        
 }  

?>
<div class="table-responsive"> 
<table class="data-table table table-bordered table-hover text-center table-responsive" id = "brands">
  <caption class="title">Different Types of Devices</caption>
<thead>
   <tr class="text-center">
       <th >ID</th>
       <th>DeviceName</th>
       <th>TypeId</th>
       <th>Pic</th>
       <th>Desc</th>
       <th>Model Num</th>
       <th>alias</th>
       <th>Tags</th>
       <th>Status</th>
       <th>Delete</th>
       <th>Update</th>
     </tr>
   </thead>
   <tbody>
<?php

$rows = $devObj->selectAll();
$count = count($rows);
$i = 0;
while($i < $count){
echo "<tr>        
          <td>".$rows[$i]['id']."</td>
          <td>".$rows[$i]['deviceName']."</td>
          <td>".$rows[$i]['typeId']."</td>
          <td>".$rows[$i]['pictures']."</td>
          <td>".$rows[$i]['description']."</td>
          <td>".$rows[$i]['modelNum']."</td>
          <td>".$rows[$i]['alias']."</td>
          <td>".$rows[$i]['tags']."</td>";
        if($rows[$i]['isActive'] == 1){
          $status = "Active";
        }
        else{
          $status = "InActive";
        }
        echo "<td>".$status."</td>
          <td><a  class='btn btn-danger' href='devices.php?did=".$rows[$i]['id']."'>Delete</a> </td>
          <td><a  id = 'update' class='btn btn-info' href='devices.php?uid=".$rows[$i]['id']."'  data-toggle='modal' data-target='#myModals'>Update</a> </td>
        </tr>";
$i++;
}
?>
</tbody>
 <!-- Modal  for adding pop up to ADD DATA-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Devices </h4>
        </div>
       <form action="devices.php" method="POST">
        <div class="form-group">
              <label><span class="fa fa-building"></span>Name of Devices</label>
              <input type="text"  name="deviceName" placeholder="Enter New Device Name" required>
            </div>
            <div class="form-group">
              <label><span class="fa fa-building"></span>typeId</label>
              <input type="text"  name="typeId" placeholder="Enter Type Id" required>
            </div>
            <div class="form-group">
              <label><span class="fa fa-building"></span>pictures</label>
              <input type="text"  name="pictures" placeholder="Pic Name" required>
            </div>
            <div class="form-group">
              <label><span class="fa fa-building"></span>description</label>
              <input type="text"  name="description" placeholder="Enter Description" required>
            </div>
            <div class="form-group">
              <label><span class="fa fa-building"></span>modelNum</label>
              <input type="text"  name="modelNum" placeholder="Enter Model Num" required>
            </div>
            <div class="form-group">
              <label><span class="fa fa-building"></span>alias</label>
              <input type="text"  name="alias" placeholder="Enter Alias" required>
            </div>
             <div class="form-group">
              <label><span class="fa fa-building"></span>Tags</label>
              <input type="text"  name="tags" placeholder="Enter Tags" required>
            </div>
            <div class="form-group">
              <label><span class="fa fa-building"></span>Status of the Device</label>
              <input type="checkbox"  name="isActive" >
            </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-default" name="submit" >
        </div>
      </form>
      </div>
      
    </div>
  </div>
   <!-- Modal  for adding pop up to ADD DATA-->
   <!-- Modal -->
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 

 <div>

  <button type="button" class="btn btn-info btn-md adding" data-toggle="modal" data-target="#myModal">ADD</button>
    </div>
</table>
  </section>
    <!-- /.content -->
  </div>
 
  <div w3-include-html="pages/footer.html"></div>
</div>
</body>
<script type="text/javascript" src="table.js"></script>
<script>
includeHTML();
</script>
</html>