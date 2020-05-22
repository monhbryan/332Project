<html>
<body>

Welcome to our website!

<br><br>

This website is to test our CPSC 332 Term Project.

<br><br><br>

Our Group: 

<br><br>

Phillip Presuel
<br>
Bryan Monh
<br>
Thomas Eduard Del Rosario
<br><br>

<?php
$username = "cs332s27";
$password = "yooFoh3T";
$server = "mariadb";
$link = mysql_connect($server, $username, $password);
if (!$link) {
die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<p>';

mysql_select_db($username,$link); ?>

For Professors:
<br>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  CWID: <input type="number" name="cwid"> <br>
  CourseNumber: <input type="number" name="Cnum"> <br>
  SectionNumber: <input type="number" name="Snum"> <br>
  <input type="submit">
</form>
	---------------------------------------------------------<br>
	For Students:
    <br>
    <br>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	  CWID: <input type="number" name="studentcwid"> <br>
	  StudentCourseNumber: <input type="number" name="SCNum"> <br>
	  <input type="submit">
	</form>

<?php
	$cwid = $_POST['cwid'];
	$Cnum = $_POST['Cnum'];
	$Snum = $_POST['Snum'];
	$SCnum = $_POST['SCNum'];
	$Scwid = $_POST['studentcwid'];
	echo 'CWID: ', $cwid, "<br/>\n";
	echo 'Course Number: ', $Cnum , "<br/>\n";
	echo 'Section Number:', $Snum , "<br/>\n";
	echo "-------------------------------------------<br>";
	$query = "SELECT a.title, b.classroom, b.meetingDays, b.beginTime, b.endTime FROM Professor a, Sections b WHERE (a.cwid=" .$_POST["cwid"]." AND b.cwid=" .$_POST["cwid"].")";
	$result = mysql_query($query,$link);
	echo $query, "<br>";
	echo $result, "<br>";
	echo "title classroom meetingDays beginTime endTime <br>";
	while($row = mysql_fetch_array($result)){
		echo $row['title'], " ", $row['classroom'], " ",$row['meetingDays']," ", $row['beginTime'], " ",$row['endTime'] , "<br>";
	}
	echo "-------------------------------------------<br>";
	$query = "Select b.grade, count(*) as Grade FROM EnrolledIn b Where (b.courseNum =". $_POST['Cnum']." AND b.sectionNum =". $_POST['Snum'].") GROUP BY b.grade";
	$result = mysql_query($query,$link);
	echo $query, "<br>";
	echo $result, "<br>";
	echo "Grade Letter CountedGrades <BR>";
	while($row = mysql_fetch_array($result)){
		echo $row['grade'], " ", $row['Grade'],"<br>";
	}
	echo "-------------------------------------------<br>";
	

	echo "CWID: ", $Scwid ,"<br>";
	echo "Course Number: ", $SCnum, "<br>";
	echo "-------------------------------------------<br>";
	$Squery = "Select b.sectionNum, b.classroom, b.meetingDays, b.beginTime, b.endTime, count(DISTINCT(a.cwid)) as 'Enrolled Students' From EnrolledIn a, Sections b Where (a.courseNum =".$SCnum. " AND b.courseNumber =". $SCnum . ")";
	$Sresult = mysql_query($Squery,$link);
	echo $Squery, "<br>";
	echo $Sresult, "<br>";
	echo "SectionNumber Classroom MeetingDays BeginTime EndTime EnrolledStudents <BR>";
	while($Srow = mysql_fetch_array($Sresult)){
		echo $Srow['sectionNum'], " ", $Srow['classroom'], " ",$Srow['meetingDays']," ", $Srow['beginTime'], " ",$Srow['endTime'] , " ", $Srow['Enrolled Students'], "<br>";
	}
	echo "-------------------------------------------<br>";
	$Squery = "Select a.courseNum, a.grade From EnrolledIn a Where a.cwid =".$Scwid;
	$Sresult = mysql_query($Squery,$link);
	echo $Squery, "<br>";
	echo $Sresult, "<br>";
	echo "Courses Grades <br>";
	while($Srow = mysql_fetch_array($Sresult)){
		echo $Srow['courseNum'], " ", $Srow['grade'],"<br>";
	}
	echo "-------------------------------------------<br>";
	
	mysql_close($link);

	?>

</body>
</html>