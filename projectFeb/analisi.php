<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php
  include 'index.html'; ?>
   <script type="text/javascript">
        document.getElementById("1").style.display = "none";
    document.getElementById("2").style.display = "none";
    document.getElementById("3").style.display = "block";
     document.getElementById("4").style.display = "block";
  </script>
<body>
	<form action="analisiexe.php" method="POST">
		apo:
<select name="apo">
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
<select name="eos">
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
<input type="submit" value="Submit">


</form>

</body>
</html>