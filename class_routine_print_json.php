<?php include_once("include/connection.php"); ?>

    <table class="table text-center">
        <tr>
            <th style="font-size: 2.5em;">Moheshpur Primary School</th>
        </tr>
        <tr>
            <th>Moheshpur Barura, Cumilla</th>
        </tr>
        <tr>
            <th>Year: <?= date('Y') ?></th>
        </tr>
        <tr>
            <th>Class: <?= $_GET['class_name'] ?> </th>
        </tr>
    </table>
    <?php
	$sql="SELECT routine.*, teacher.teacherName, subject.name as sub FROM `routine`
			left join teacher on teacher.id=routine.teacher_id
			left JOIN subject on subject.id=routine.sub_id
            where routine.class_name='".$_GET['class_name']."'
			order by routine.day,routine.time";
	
    $result=$mysqli->custom_select($sql);
    if($result['numrows'] > 0){
        $day=array("","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday")
?>

        <table class="table">
            <tr>
                <th>Day</th>
                <th>1st</th>
                <th>2nd</th>
                <th>3rd</th>
                <th>4th</th>
                <th>Tiffen</th>
                <th>5th</th>
                <th>6th</th>
            </tr>
            <tr>
                <th></th>
                <th>08:00-8:45AM</th>
                <th>08:45-09:30AM</th>
                <th>09:30-10:15AM</th>
                <th>10:15-11:00AM</th>
                <th>11:00-11:30AM</th>
                <th>11:30-12:15PM</th>
                <th>12:15-01:00PM</th>
            </tr>
            <?php foreach(array_chunk(json_decode(json_encode($result['selectdata']),true),7) as $routin){ ?>
                <tr>
                    <th><?= $day[$routin[0]['day']]; ?></th>
                    <?php foreach($routin as $r){ ?>
                    <th><?= $r['teacherName']?$r['teacherName']:"Tiffen" ?><br> <?= $r['sub'] ?></th>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>


<?php }else{
        echo "No Data Found";
        //print_r($result);
    }
    ?>