
<?php

    include ('config/db_connect.php');

    session_start();
    $buildingName = $_SESSION['session_building'];
    $roomNumber = $_SESSION['session_rooms'];
 
    $roomDates = $conn->prepare("SELECT * FROM dataSeperate WHERE room_number = '{$roomNumber}' AND building = '{$buildingName}'");
    $roomDates -> execute();
    $roomDates = $roomDates->fetchAll();

    $dateArray = array();

    // $roomDates[$i][0] = gets discription
    // $roomDates[$i][1] = gets profession not need
    // $roomDates[$i][2] = get building
    // $roomDates[$i][3] = gets room number
    // $roomDates[$i][4] = gets days
    // $roomDates[$i][5] = gets start time
    // $roomDates[$i][6] = gets end time
    // $roomDates[$i][7] = gets id

    for($i=0;$i<count(array_values($roomDates));$i++){
        $tempArray = array();
        array_push($tempArray,$roomDates[$i][0],$roomDates[$i][2],$roomDates[$i][3],$roomDates[$i][4],$roomDates[$i][5],$roomDates[$i][6],$roomDates[$i][7]);
        array_push($dateArray,$tempArray);
        
    }
    
    $sched_res =  json_encode($dateArray);


    if((isset($_POST['addEvent'])) && $_POST['addStart'] != '' && $_POST['addEnd'] != ''){
        $addStart = $_POST['addStart'];
        $addEnd =  $_POST['addEnd'];
        $addDate = $_POST['addDate'];

    }
  

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to use Full Calendar with MySQL in PHP? - Nicesnippets.com</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">

    <link rel="stylesheet" type="text/css" href="calendar.css">
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
        .title{
            font-size: 30px;
        }
    </style>
</head>
<body class="bg-light">

   
    <?php include("templates/header.php") ?> 


    
    <div class="text-center p-3" style="background-color: #444444; color:white;">
        <h2> <?php echo($buildingName . ' '. $roomNumber); ?></h2>
    </div>
    <div class="container py-5" id="page-container" >
        <div class="row">

            <div class="col-9">
                <div id="calendar"></div>
            </div>

            <div class="col-md-3">
                <div class="card rounded-0 shadow" id="bookRoom">
                    <div class="card-header" style="background-color:#444444; color:white;">
                        <h5 class="card-title text-center">Schedule Form</h5>
                    </div>
                    <div class="card-body ">
                        <div class="form-group mb-2">
                            <label for="title" class="control-label">Event Title</label>
                        </div>
                         
                        <textarea id="addTitle" name="addTitle" placeholder="Title"> </textarea>
                        <div class="form-group mb-2">
                            <label for="start_datetime" class="control-label">Date</label>
                        </div>
                         <input type="date" id="addDate" name="addDate"
                           value='<?php echo date('Y-m-d');?>'>
                       
                        <div class="form-group mb-2">
                            <label for="start_datetime" class="control-label">Start</label>
                        </div>
                        <input type="time" id="addStart" name="addStart">
                        <div class="form-group mb-2">
                            <label for="end_datetime" class="control-label">End</label>
                        </div>
                         <input type="time" id="addEnd" name="addEnd">
     
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-sm rounded-0"style="background-color: #444444 ; color: #fff;"  type="submit" id="formSubmit"><i class="bi bi-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" style="background-color: #444444; color: #fff;" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

   

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="name" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class="" ></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                   <!--      <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button> -->
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("templates/footer.php") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="script.js"></script>
    <script>
       
        var scheds =  <?php echo($sched_res); ?>

        
    </script>

</body>
</html>