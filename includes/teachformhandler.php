<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST["name"];
    $start = $_POST["starttime"];
    $end = $_POST["endtime"];
    $day = $_POST["day"];
    $week = $_POST["week"];
    $semester = $_POST["semester"];
    $slotIds = array();

    
    if (in_array("All", $week)) {
        $week = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"];
    }

    try {
        require_once "dbh.inc.php";
        foreach($week as $oneweek){
            foreach($day as $oneday){
                #Get the Id for time slot
                $query = "SELECT TimeSlotID FROM timeslot WHERE StartTime = TIME(:starttime) AND EndTime = TIME(:endtime) AND Day = :day AND Week = :week AND Semester = :semester;";

                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":starttime", $start);
                $stmt->bindParam(":endtime", $end);
                $stmt->bindParam(":day", $oneday);
                $stmt->bindParam(":week", $oneweek);
                $stmt->bindParam(":semester", $semester);

                $stmt->execute();

                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($results == false) {
                    $query = "INSERT INTO timeslot (StartTime, EndTime, Day, Week, Semester) VALUES (TIME(:starttime), TIME(:endtime), :day, :week, :semester);";

                    $stmt = $pdo->prepare($query);

                    $stmt->bindParam(":starttime", $start);
                    $stmt->bindParam(":endtime", $end);
                    $stmt->bindParam(":day", $oneday);
                    $stmt->bindParam(":week", $oneweek);
                    $stmt->bindParam(":semester", $semester);

                    $stmt->execute();

                    #Get the Id for it
                    $query = "SELECT TimeSlotID FROM timeslot WHERE StartTime = TIME(:starttime) AND EndTime = TIME(:endtime) AND Day = :day AND Week = :week AND Semester = :semester;";

                    $stmt = $pdo->prepare($query);

                    $stmt->bindParam(":starttime", $start);
                    $stmt->bindParam(":endtime", $end);
                    $stmt->bindParam(":day", $oneday);
                    $stmt->bindParam(":week", $oneweek);
                    $stmt->bindParam(":semester", $semester);

                    $stmt->execute();

                    $results = $stmt->fetch(PDO::FETCH_ASSOC);
                }

                array_push($slotIds, $results["TimeSlotID"]);
            }
        }
        #Get TeacherId
        $query = "SELECT TeacherID FROM Teacher WHERE Name=:name;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":name", $name);

        $stmt->execute();

        $teachid = $stmt->fetch(PDO::FETCH_ASSOC);
        
        foreach($slotIds as $id){
            #Check if exists
            $query = "SELECT * FROM teacheropenslot WHERE TeacherID = :teacherid AND TimeSlotID = :timeslotid;";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":teacherid", $teachid["TeacherID"]);
            $stmt->bindParam(":timeslotid", $id);

            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($results == false) {
                #Insert it if it does not exist
                $query = "INSERT INTO teacheropenslot (TeacherID, TimeSlotID) VALUES (:teacherid, :timeslotid);";

                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":teacherid", $teachid["TeacherID"]);
                $stmt->bindParam(":timeslotid", $id);

                $stmt->execute();
            }
        }
        

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}