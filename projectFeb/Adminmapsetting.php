<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>
<body><?php
  include 'index.html'; ?>
  <script type="text/javascript">
        document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
  </script>

<form action="AdminMap.php" method="POST">
	Xronia apo:
<select name="year1">
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
</select>
eos:
<select name="year2">
<option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
</select>
<input type="checkbox" name="allyears" value="Yes"> All Years;<br>
		Minas apo:
<select name="month1">
  <option value="1">Ιανουάριος</option>
  <option value="2">Φεβρουάριος</option>
  <option value="3">Μάρτιος</option>
  <option value="4">Απρίλης</option>
  <option value="5">Μάιος</option>
  <option value="6">Ιούνιος</option>
  <option value="7">Ιούλιος</option>
  <option value="8">Άυγουστος</option>
  <option value="9">Σεπτέμβρης</option>
  <option value="10">Οκτώβρης</option>
  <option value="11">Νοέμβρης</option>
  <option value="12">Δεκέμβρης</option>
</select>
eos:
<select name="month2">
  <option value="1">Ιανουάριος</option>
  <option value="2">Φεβρουάριος</option>
  <option value="3">Μάρτιος</option>
  <option value="4">Απρίλης</option>
  <option value="5">Μάιος</option>
  <option value="6">Ιούνιος</option>
  <option value="7">Ιούλιος</option>
  <option value="8">Άυγουστος</option>
  <option value="9">Σεπτέμβρης</option>
  <option value="10">Οκτώβρης</option>
  <option value="11">Νοέμβρης</option>
  <option value="12">Δεκέμβρης</option>
</select>
<input type="checkbox" name="allmonths" value="Yes"> All Months;<br>
Mera apo:
<select name="day1">
  <option value="1">Δευτέρα</option>
  <option value="2">Τρίτη</option>
  <option value="3">Τετάρτη</option>
  <option value="4">Πέμπτη</option>
  <option value="5">Παρασκευή</option>
  <option value="6">Σάββατο</option>
  <option value="7">Κυριακή</option>
</select>
eos:
<select name="day2">
  <option value="1">Δευτέρα</option>
  <option value="2">Τρίτη</option>
  <option value="3">Τετάρτη</option>
  <option value="4">Πέμπτη</option>
  <option value="5">Παρασκευή</option>
  <option value="6">Σάββατο</option>
  <option value="7">Κυριακή</option>
</select>
<input type="checkbox" name="alldays" value="Yes"> All Days;<br>
		Ώρα apo:
<select name="hour1">
	<option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
   <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
</select>
eos:
<select name="hour2">
 	<option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
   <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
</select>
<input type="checkbox" name="allhours" value="Yes"> All Hours;<br>


<div display= "block"> 
<input type="checkbox" name="ON_FOOT" value="Yes"> ON_FOOT<br>
<input type="checkbox" name="TILTING" value="Yes">TILTING <br>
<input type="checkbox" name="STILL" value="Yes">STILL <br>
<input type="checkbox" name="UNKNOWN" value="Yes">UNKNOWN <br>
<input type="checkbox" name="IN_VEHICLE" value="Yes">IN_VEHICLE <br>
<input type="checkbox" name="ON_BICYCLE" value="Yes">ON_BICYCLE <br>
<input type="checkbox" name="EXITING_VEHICLE" value="Yes"> EXITING_VEHICLE<br>
<input type="checkbox" name="RUNNING" value="Yes"> RUNNING<br>
<input type="checkbox" name="IN_RAIL_VEHICLE" value="Yes"> IN_RAIL_VEHICLE<br>
<input type="checkbox" name="IN_ROAD_VEHICLE" value="Yes">IN_ROAD_VEHICLE <br>
<input type="checkbox" name="WALKING" value="Yes">WALKING <br>
<input type="checkbox" name="allactivities" value="Yes"> All Activites;<br>
</div>
<input type="submit" value="Submit">
</form>
</body>
</html>