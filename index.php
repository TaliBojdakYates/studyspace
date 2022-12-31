<?php 
  include ('config/db_connect.php');

  //Find All valid classrooms
  $everyRoom = $conn->prepare("SELECT DISTINCT  building FROM dataSeperate WHERE building != 'TBA' ");

  
  $everyRoom -> execute();
  
  $everyRoom = $everyRoom->fetchAll();

  $buildingName = array();
  for($i=0;$i<count(array_values($everyRoom));$i++){
    array_push($buildingName,array_values($everyRoom)[$i][0] );
  }

  
 

 if(isset($_POST['submit'])){
    if (isset($_POST['buildingSelection']) && isset($_POST['searchRoom'])){
      $user_building = $_POST['buildingSelection'];
      $user_number = htmlspecialchars($_POST["searchRoom"]);

      $number = $conn->prepare("SELECT DISTINCT  room_number FROM dataSeperate WHERE building = '{$user_building}' ");

  
      $number -> execute();
      
      $number = $number->fetchAll();

      $all_room = array();
      for($i=0;$i<count(array_values($number));$i++){
        array_push($all_room,array_values($number)[$i][0] );
      }

      

      if(!empty($all_room) && in_array($user_number, $all_room)){

        session_start();
        $_SESSION['session_building'] = $user_building;
        $_SESSION['session_rooms'] =  $user_number;
        header('Location: calendarTest.php');
      }else{
        echo '<script>alert("Invalid classroom selection. Please try again")</script>';
      }
  
    }
  }
  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   
  <title>studyspace</title>
  </head>
  <body>
    
      



    <?php include("templates/header.php") ?> 


 
    <div class="row" style="margin: 0; background: #cc0000; color:white">
      <div class="col-6">
         <img src="images/logoFinal.png" style="width: 100%;">
          <h3 id="title">Find a Classroom to Study</h3>
      </div>
     
      <div class="col-6 " style="justify-content: center; align-items: center; display: flex;" >
        <img  style="width: 65%;"src="images/study.png">
      </div>
    </div>
  
 

    

    <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 170" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(204, 0, 0, 1)" offset="0%"></stop><stop stop-color="rgba(254, 153, 0, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,51L30,68C60,85,120,119,180,121.8C240,125,300,96,360,82.2C420,68,480,68,540,79.3C600,91,660,113,720,107.7C780,102,840,68,900,48.2C960,28,1020,23,1080,39.7C1140,57,1200,96,1260,104.8C1320,113,1380,91,1440,70.8C1500,51,1560,34,1620,22.7C1680,11,1740,6,1800,8.5C1860,11,1920,23,1980,36.8C2040,51,2100,68,2160,76.5C2220,85,2280,85,2340,82.2C2400,79,2460,74,2520,85C2580,96,2640,125,2700,136C2760,147,2820,142,2880,121.8C2940,102,3000,68,3060,45.3C3120,23,3180,11,3240,28.3C3300,45,3360,91,3420,90.7C3480,91,3540,45,3600,31.2C3660,17,3720,34,3780,59.5C3840,85,3900,119,3960,130.3C4020,142,4080,130,4140,104.8C4200,79,4260,40,4290,19.8L4320,0L4320,170L4290,170C4260,170,4200,170,4140,170C4080,170,4020,170,3960,170C3900,170,3840,170,3780,170C3720,170,3660,170,3600,170C3540,170,3480,170,3420,170C3360,170,3300,170,3240,170C3180,170,3120,170,3060,170C3000,170,2940,170,2880,170C2820,170,2760,170,2700,170C2640,170,2580,170,2520,170C2460,170,2400,170,2340,170C2280,170,2220,170,2160,170C2100,170,2040,170,1980,170C1920,170,1860,170,1800,170C1740,170,1680,170,1620,170C1560,170,1500,170,1440,170C1380,170,1320,170,1260,170C1200,170,1140,170,1080,170C1020,170,960,170,900,170C840,170,780,170,720,170C660,170,600,170,540,170C480,170,420,170,360,170C300,170,240,170,180,170C120,170,60,170,30,170L0,170Z"></path></svg>

   
        
   
<form  method="post" id="search" class="m-0 needs-validation" novalidate >
    <div class="row m-0">
      <div class="card col border-0 m-4">
        <img src="images/building.png" class="card-img-top" style="border-radius: 5rem; height: 50%; " >
        <div class="card-body text-center mt-3">
        <label for="validationTooltip04" class="form-label">Building Search</label>
        <select name = "buildingSelection" class="form-select form-control" id="validationTooltip04" style="border-color: #cc0000;" required>
          <option selected disabled value="">Select Building</option>
                  <?php  for($i=0;$i<count($buildingName);$i++){ ?>
                  <option> <?php   echo($buildingName[$i]); ?></option>
                  <?php  } ?>
        </select>
        <div class="invalid-feedback">
          Please select valid building
        </div>
        </div>
    </div>

      <div class="card col border-0 m-4">
    <img src="images/class.png" class="card-img-top" style="border-radius: 5rem; height: 50%;" >
    <div class="card-body text-center mt-3">
      <label for="validationTooltip01" class="form-label">Room Search</label>
       <input type="text" class="rounded form-control" name="searchRoom" placeholder="Room Number" style="border-color: #cc0000; padding:6px" id="validationCustom01" onkeypress="return event.keyCode != 13;" required>
      <div class="invalid-feedback">
        Please select valid room
      </div>
    </div>
  </div>
    
    
     <div class="card col border-0 m-4" >
        <img src="images/search.png" class="card-img-top" style="height: 50%;">
        <div class="card-body text-center mt-3">
           <label for="submitButton" class="form-label">Submit and Search</label>
          <div class="d-grid gap-2 ">
            <button style="padding:6px" class="search rounded" type="submit" name="submit">Search</button>
          </div>
        </div>
      </div>
  </form>

  

 

  <?php include("templates/footer.php") ?>




    <script type="text/javascript">
    
(() => {
  'use strict'

  
  const forms = document.querySelectorAll('.needs-validation')

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
  </script>

  
  </body>
</html>