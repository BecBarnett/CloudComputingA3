<?php 

require_once("tools.php");
top_module("F1 Fan Page");

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

//Fetch current season race information
const url = 'http://ergast.com/api/f1/2021.json';

fetch(url)
.then((resp) => resp.json())
.then(function(data) {
  //Get Race Time
  var today = new Date();
  let raceTime = "";
  let raceName = "";
  let raceDate = "";
  let raceDateTime = "";
  for ($x=0; $x < data.MRData.RaceTable.Races.length; $x++) {
    raceTime = data.MRData.RaceTable.Races[$x].time;
    raceName = data.MRData.RaceTable.Races[$x].raceName;
    raceDate = data.MRData.RaceTable.Races[$x].date;
    raceDateTime = new Date(raceDate+"T"+raceTime);
    if (raceDateTime > today){
      break;
    }
  }
  //alert(raceDateTime);
  //alert(races);
  //document.getElementById('raceTime').innerHTML = raceTime;
  document.getElementById('raceTitle').innerHTML = raceName;
  document.getElementById('raceDate').innerHTML = raceDateTime;
})
.catch(function(error) {
  console.log(error);
});

//Fetch Last Race Results
const lastRaceURL = 'http://ergast.com/api/f1/current/last/results.json';

fetch(lastRaceURL)
.then((resp) => resp.json())
.then(function(data) {
  //Get Race Time
  let season = data.MRData.RaceTable.season;
  let raceName = data.MRData.RaceTable.Races[0].raceName;
  //alert(raceName);
  //alert(season);
  let title = String(season) + " " + String(raceName);
  let tableData = "<tr><th>Position</th><th>Points</th><th>Driver</th><th>Nationality</th><th>Time</th><th>Status</th><tr>";
  
  for ($x=0; $x < data.MRData.RaceTable.Races[0].Results.length; $x++) {
    let position = data.MRData.RaceTable.Races[0].Results[$x].position;
    let points = data.MRData.RaceTable.Races[0].Results[$x].points;
    let driverId = data.MRData.RaceTable.Races[0].Results[$x].Driver.driverId;
    let fname = data.MRData.RaceTable.Races[0].Results[$x].Driver.givenName;
    let lname = data.MRData.RaceTable.Races[0].Results[$x].Driver.familyName;
    let name = fname + " " + lname;
    let nationality = data.MRData.RaceTable.Races[0].Results[$x].Driver.nationality;
    let racetime = "";
    if (data.MRData.RaceTable.Races[0].Results[$x].hasOwnProperty("Time")) {
      racetime = data.MRData.RaceTable.Races[0].Results[$x].Time.time;
    } else {
      racetime = "DNF";
    }
    //alert(racetime);
    let status = data.MRData.RaceTable.Races[0].Results[$x].status;
    if (driverId == <?php echo "'". $_SESSION["fanInfo"]["favDriver"] . "'";?>) {
      tableData += "<tr style='background-color: #E0610E;'><td>" + position + "</td><td>" + points + "</td><td>" + name + "</td><td>" + nationality + "</td><td>" + racetime + "</td><td>" + status + "</td></tr>";
    } else {
      tableData += "<tr><td>" + position + "</td><td>" + points + "</td><td>" + name + "</td><td>" + nationality + "</td><td>" + racetime + "</td><td>" + status + "</td></tr>";
    }
  }



  //alert(races);
  document.getElementById('lastRace').innerHTML = title;
  document.getElementById('resultList').innerHTML = tableData;
})
.catch(function(error) {
  console.log(error);
});

//Fetch Driver Standings
const driverStandingsURL = 'http://ergast.com/api/f1/current/driverStandings.json';

fetch(driverStandingsURL)
.then((resp) => resp.json())
.then(function(data) {
  //Get Race Time
  let season = data.MRData.StandingsTable.season;
  let round = data.MRData.StandingsTable.StandingsLists[0].round;
  //alert(raceName);
  //alert(season);
  let standingsTitle = String(season) + " Season. Results after round " + String(round);
  let tableData = "<tr><th>Position</th><th>Points</th><th>Driver</th><th>Nationality</th><th>Wins</th><th>Constructor</th><tr>";
  
  for ($x=0; $x < data.MRData.StandingsTable.StandingsLists[0].DriverStandings.length; $x++) {
    let position = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].position;
    let points = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].points;
    let driverId = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].Driver.driverId;
    let fname = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].Driver.givenName;
    let lname = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].Driver.familyName;
    let name = fname + " " + lname;
    let nationality = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].Driver.nationality;
    let constructor = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].Constructors[0].name;
    let wins = data.MRData.StandingsTable.StandingsLists[0].DriverStandings[$x].wins;

    if (driverId == <?php echo "'". $_SESSION["fanInfo"]["favDriver"] . "'";?>) {
      tableData += "<tr style='background-color: #E0610E;'><td>" + position + "</td><td>" + points + "</td><td>" + name + "</td><td>" + nationality + "</td><td>" + wins + "</td><td>" + constructor + "</td></tr>";
    } else {
      tableData += "<tr><td>" + position + "</td><td>" + points + "</td><td>" + name + "</td><td>" + nationality + "</td><td>" + wins + "</td><td>" + constructor + "</td></tr>";
    }
  }



  //alert(races);
  document.getElementById('driverStandings').innerHTML = standingsTitle;
  document.getElementById('standingsList').innerHTML = tableData;
})
.catch(function(error) {
  console.log(error);
});

</script>

    <div class="grid-container">
      <div class="NextRace"><p class="tableHeading">Next Race:</p><p id="raceTitle"></p></div>
      <div class="RaceTime"><p id="raceDate"></p></div>
      <div class="DriverPic">
        <?php 
          echo "<img src='https://s3856827-a3-bucket.s3.us-east-1.amazonaws.com/" . $_SESSION["fanInfo"]["favDriver"] . ".PNG' id='driverPic'>";
        ?>
        </br>
        <form action="post-validation.php" method="POST">
          <input id="driverSelected" name="driverSelected" type="hidden">
          <select id="driver" name="driver" onchange="this.form.submit()">
            <option value="hamilton"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "hamilton") {echo "selected";}?>>Lewis Hamilton (GBR)</option>
            <option value="max_verstappen"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "max_verstappen") {echo "selected";}?>>Max Verstappen (NED)</option>
            <option value="norris"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "norris") {echo "selected";}?>>Lando Norris (GBR)</option>
            <option value="bottas"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "bottas") {echo "selected";}?>>Valtteri Bottas (FIN)</option>
            <option value="perez"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "perez") {echo "selected";}?>>Sergio Perez (MEX)</option>
            <option value="sainz"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "sainz") {echo "selected";}?>>Carlos Sainz (ESP)</option>
            <option value="leclerc"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "leclerc") {echo "selected";}?>>Charles Leclerc (MON)</option>
            <option value="gasly"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "gasly") {echo "selected";}?>>Pierre Gasly (FRA)</option>
            <option value="ricciardo"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "ricciardo") {echo "selected";}?>>Daniel Ricciardo (AUS)</option>
            <option value="ocon"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "ocon") {echo "selected";}?>>Esteban Ocon (FRA)</option>
            <option value="alonso"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "alonso") {echo "selected";}?>>Fernando Alonso (ESP)</option>
            <option value="vettel"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "vettel") {echo "selected";}?>>Sebastian Vettel (GER)</option>
            <option value="tsunoda"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "tsunoda") {echo "selected";}?>>Yuki Tsunoda (JPN)</option>
            <option value="stroll"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "stroll") {echo "selected";}?>>Lance Stroll (CAN)</option>
            <option value="latifi"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "latifi") {echo "selected";}?>>Nicholas Latifi (CAN)</option>
            <option value="russell"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "russell") {echo "selected";}?>>George Russell (GBR)</option>
            <option value="raikkonen"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "raikkonen") {echo "selected";}?>>Kimi aikkonen (<FIN)/option>
            <option value="giovinazzi"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "giovinazzi") {echo "selected";}?>>Antonio Giovinazzi (ITA)</option>
            <option value="mick_schumacher"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "mick_schumacher") {echo "selected";}?>>Mick Schumacher (GER)</option>
            <option value="mazepin"<?php if  ($_SESSION["fanInfo"]["favDriver"] == "mazepin") {echo "selected";}?>>Nikita Mazepin (RAF)</option>
          </select>
        </form>
      </div>  
      <div class="LastRace"><p class="tableHeading">Last Race Results</p><h2 id="lastRace"></h2><table id="resultList" align="center"></table></div>
      <div class="DriverStandings"><p class="tableHeading">Driver Standings</p><h2 id="driverStandings"></h2><table id="standingsList" align="center"></div>
    </div>
