<?php
include_once("DBconnect.php");


$sql = "SELECT distinct eid, eventName FROM rsvp natural join event natural join user where endTime<now() and uid='$uid' and eid not in(select eid from event_report);";
if ($result = $conn->query($sql)){
$selectEvent= '<select class="form-control" name="eventList">';
$selectEvent.='<option selected="selected">Select the Event for whih you need to write a report</option>';
 while($rs = $result->fetch_assoc()){
      $selectEvent.='<option value="'.$rs['eid'].'">'.$rs['eventName'].'</option>';
  }
}
$selectEvent.='</select>';




?>









