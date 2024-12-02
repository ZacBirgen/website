<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $teacher = $_POST["teacher"];
    $start = $_POST["starttime"];
    $end = $_POST["endtime"];
    $day = $_POST["day"];
    $week = $_POST["week"];
    $semester = $_POST["semester"];
    $matchSlot = array();
    #echo '<script>alert("Welcome to Geeks for Geeks")</script>';

    function get_timeslot($pdo, $semester, $week, $day, $starttime,  $endtime){
        #Get the Id for time slot
        $query = "SELECT * FROM timeslot WHERE StartTime = TIME(:starttime) AND EndTime = TIME(:endtime) AND Day = :day AND Week = :week AND Semester = :semester;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":starttime", $starttime);
        $stmt->bindParam(":endtime", $endtime);
        $stmt->bindParam(":day", $day);
        $stmt->bindParam(":week", $week);
        $stmt->bindParam(":semester", $semester);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results == false) {
            $query = "INSERT INTO timeslot (StartTime, EndTime, Day, Week, Semester) VALUES (TIME(:starttime), TIME(:endtime), :day, :week, :semester);";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":starttime", $starttime);
            $stmt->bindParam(":endtime", $endtime);
            $stmt->bindParam(":day", $day);
            $stmt->bindParam(":week", $week);
            $stmt->bindParam(":semester", $semester);

            $stmt->execute();

            #Get the Id for it
            $query = "SELECT * FROM timeslot WHERE StartTime = TIME(:starttime) AND EndTime = TIME(:endtime) AND Day = :day AND Week = :week AND Semester = :semester;";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":starttime", $starttime);
            $stmt->bindParam(":endtime", $endtime);
            $stmt->bindParam(":day", $day);
            $stmt->bindParam(":week", $week);
            $stmt->bindParam(":semester", $semester);

            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $results["TimeSlotID"];
    }
    
    function mark_as_open($pdo, $teachid, $timeslotid) {
        #Insert it if it does not exist
        $query = "INSERT INTO teacheropenslot (TeacherID, TimeSlotID) VALUES (:teacherid, :timeslotid);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":teacherid", $teachid);
        $stmt->bindParam(":timeslotid", $timeslotid);

        $stmt->execute();
    }

    try {
        require_once "dbh.inc.php";

        #Get StudentID
        $query = "SELECT * FROM student WHERE name = :name";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $name);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results == false) {
            #Insert it if it does not exist
            $query = "INSERT INTO student (name, Email) VALUES (:name, :email);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);

            $stmt->execute();

            #Get StudentID
            $query = "SELECT * FROM student WHERE name = :name";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":name", $name);

            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $studentid = $results["StudentID"];

        #Get TeacherId
        $query = "SELECT TeacherID FROM Teacher WHERE Name=:name;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $teacher);

        $stmt->execute();

        $teachid = $stmt->fetch(PDO::FETCH_ASSOC);
        $teacherid = $teachid["TeacherID"];

        #Get Open Time Slots for The Teacher
        $query = "SELECT T.StartTime, T.EndTime, T.TimeSlotID FROM teacheropenslot O JOIN timeslot T ON O.TimeSlotID = T.TimeSlotID WHERE TeacherID = :teacherid AND Semester = :semester AND Week = :week AND Day = :day;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":teacherid", $teacherid);
        $stmt->bindParam(":semester", $semester);
        $stmt->bindParam(":week", $week);
        $stmt->bindParam(":day", $day);

        $stmt->execute();
        $slots = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$slots) {
            $matchSlot = $slots;
        } elseif (array_key_exists("StartTime", $slots)) {
            #Check if the Solo Slot Fits
            if (strtotime($slots["StartTime"]) <= strtotime($start) and strtotime($slots["EndTime"]) >= strtotime($end)) {
                $matchSlot = $slots;
            }
        } else {
            #Find Open Slots that Match
            foreach($slots as $slot){
                #Check if fits
                if (strtotime($slot["StartTime"]) <= strtotime($start) and strtotime($slot["EndTime"]) >= strtotime($end)) {
                    $matchSlot = $slot;
                }
            }
        }
        

        
        if ($matchSlot) {
            #Check if need to Remove from TimeSlot
            /*
            $query = "SELECT * FROM teacheropenslot WHERE TimeSlotID = :timeslotid;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":timeslotid", $matchSlot["TimeSlotID"]);

            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results == false) {
                #Remove from TimeSlot if nobody is using it
                $query = "DELETE FROM timeslot WHERE TimeSlotID = :timeslotid;";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":timeslotid", $matchSlot["TimeSlotID"]);

                $stmt->execute();
            } */

            #Create New TimeSlot/Check for creating multiple timeslots
            if (strtotime($matchSlot["StartTime"]) == strtotime($start) and strtotime($matchSlot["EndTime"]) == strtotime($end)) {
                $idSlot = $matchSlot["TimeSlotID"];
            } elseif (strtotime($matchSlot["StartTime"]) == strtotime($start)) {
                $tempSlot = get_timeslot($pdo, $semester, $week, $day, $end, $matchSlot["EndTime"]);
                mark_as_open($pdo, $teacherid, $tempSlot);
                
                $idSlot = get_timeslot($pdo, $semester, $week, $day, $start, $end);
            } elseif (strtotime($matchSlot["EndTime"]) == strtotime($end)) {
                $tempSlot = get_timeslot($pdo, $semester, $week, $day, $matchSlot["StartTime"], $start);
                mark_as_open($pdo, $teacherid, $tempSlot);

                $idSlot = get_timeslot($pdo, $semester, $week, $day, $start, $end);
            } else {
                $tempSlot = get_timeslot($pdo, $semester, $week, $day, $matchSlot["StartTime"], $start);
                mark_as_open($pdo, $teacherid, $tempSlot);

                $tempSlot = get_timeslot($pdo, $semester, $week, $day, $end, $matchSlot["EndTime"]);
                mark_as_open($pdo, $teacherid, $tempSlot);

                $idSlot = get_timeslot($pdo, $semester, $week, $day, $start, $end);
            }
            $query = "INSERT INTO timeslot (StartTime, EndTime, Day, Week, Semester) VALUES (TIME(:starttime), TIME(:endtime), :day, :week, :semester);";

            #Remove from OpenTimeSlot
            $query = "DELETE FROM teacheropenslot WHERE TeacherID = :teacherid AND TimeSlotID = :timeslotid;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":teacherid", $teacherid);
            $stmt->bindParam(":timeslotid", $matchSlot["TimeSlotID"]);

            $stmt->execute();

            #Insert New Scheduled Slot
            $query = "INSERT INTO teacherscheduledslot (TeacherID, TimeSlotID, StudentID) VALUES (:teacherid, :timeslotid, :studentid);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":studentid", $studentid);
            $stmt->bindParam(":teacherid", $teacherid);
            $stmt->bindParam(":timeslotid", $idSlot);
            
            $stmt->execute();
            $message = "Succeeded";

        } else {
            $message = "Failed";
        }


        $pdo = null;
        $stmt = null;

        echo '<script type="text/javascript">'; 
        echo 'alert("'. $message .' at scheduling your request.");';
        echo 'window.location.href = "../index.php";';
        echo '</script>';
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}