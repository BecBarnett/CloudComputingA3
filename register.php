<?php 
/**
 * Cloud Computing Assignment 3 by Rebecca Barnett S3856827
*/
require_once("tools.php");
$_SESSION["registrationInProgress"] = true;
top_module("Register");

?>
    
    <div id="registerDiv">
    <h2>New User Registration</h2>
    <form name = 'registerForm' title="Register" id = 'registerForm'>
        <fieldset>
          <label for="email">Email:<div id = emailInvalid class = "errorMessage"><?php if(isset($_SESSION["emailError"])){ echo $_SESSION["emailError"]; }?></div></label>
          <input id="email" type="email" name="email" placeholder="Please enter your email." value='<?php if(isset($_SESSION["email"])){ echo $_SESSION["email"]; }?>'>  
        
          <label for="username">Username:<div id ="nameInvalid" class = "errorMessage"><?php if(isset($_SESSION["usernameError"])){ echo $_SESSION["usernameError"]; }?></div></label>
          <input id="username" type="text" name="username" placeholder="Please enter your username." value='<?php if(isset($_SESSION["tempusername"])){ echo $_SESSION["tempusername"]; }?>'>

          <label for="password">Password:<div id ="passwordInvalid" class = "errorMessage"><?php if(isset($_SESSION["passwordError"])){ echo $_SESSION["passwordError"]; }?></div></label>
          <input id="password" type="password" name="password" value=''>

          <label for="team">Favourite Team:</label>
          <select id="team" name="team">
            <option value="mercedes">Mercedes</option>
            <option value="red_bull">Red Bull Racing</option>
            <option value="mclaren">Mclaren</option>
            <option value="ferrari">Ferrari</option>
            <option value="alpine">Alpine</option>
            <option value="aston_martin">Aston Martin</option>
            <option value="alphatauri">AlphaTauri</option>
            <option value="alpha">Alpha Romeo Racing</option>
            <option value="williams">Williams</option>
            <option value="haas">Haas</option>
          </select>

          <label for="driver">Favourite Driver:</label>
          <select id="driver" name="driver">
            <option value="hamilton">Lewis Hamilton (GBR)</option>
            <option value="max_verstappen">Max Verstappen (NED)</option>
            <option value="norris">Lando Norris (GBR)</option>
            <option value="bottas">Valtteri Bottas (FIN)</option>
            <option value="perez">Sergio Perez (MEX)</option>
            <option value="sainz">Carlos Sainz (ESP)</option>
            <option value="leclerc">Charles Leclerc (MON)</option>
            <option value="gasly">Pierre Gasly (FRA)</option>
            <option value="ricciardo">Daniel Ricciardo (AUS)</option>
            <option value="ocon">Esteban Ocon (FRA)</option>
            <option value="alonso">Fernando Alonso (ESP)</option>
            <option value="vettel">Sebastian Vettel (GER)</option>
            <option value="tsunoda">Yuki Tsunoda (JPN)</option>
            <option value="stroll">Lance Stroll (CAN)</option>
            <option value="latifi">Nicholas Latifi (CAN)</option>
            <option value="russell">George Russell (GBR)</option>
            <option value="raikkonen">Kimi Raikkonen (FIN)</option>
            <option value="giovinazzi">Antonio Giovinazzi (ITA)</option>
            <option value="mick_schumacher">Mick Schumacher (GER)</option>
            <option value="mazepin">Nikita Mazepin (RAF)</option>
          </select>

          <label for="timezone">Timezone:</label>
          <!--Timezone Select Source: Nodesocket, 2012, https://gist.github.com/nodesocket/3919205-->
          <select name="timezone" id="timezone">
              <option value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
              <option value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
              <option value="-10:00">(GMT -10:00) Hawaii</option>
              <option value="-09:50">(GMT -9:30) Taiohae</option>
              <option value="-09:00">(GMT -9:00) Alaska</option>
              <option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
              <option value="-07:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
              <option value="-06:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
              <option value="-05:00">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
              <option value="-04:50">(GMT -4:30) Caracas</option>
              <option value="-04:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
              <option value="-03:50">(GMT -3:30) Newfoundland</option>
              <option value="-03:00">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
              <option value="-02:00">(GMT -2:00) Mid-Atlantic</option>
              <option value="-01:00">(GMT -1:00) Azores, Cape Verde Islands</option>
              <option value="+00:00">(GMT 00:00) Western Europe Time, London, Lisbon, Casablanca</option>
              <option value="+01:00">(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
              <option value="+02:00">(GMT +2:00) Kaliningrad, South Africa</option>
              <option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
              <option value="+03:50">(GMT +3:30) Tehran</option>
              <option value="+04:00">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
              <option value="+04:50">(GMT +4:30) Kabul</option>
              <option value="+05:00">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
              <option value="+05:50">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
              <option value="+05:75">(GMT +5:45) Kathmandu, Pokhara</option>
              <option value="+06:00">(GMT +6:00) Almaty, Dhaka, Colombo</option>
              <option value="+06:50">(GMT +6:30) Yangon, Mandalay</option>
              <option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
              <option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
              <option value="+08:75">(GMT +8:45) Eucla</option>
              <option value="+09:00">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
              <option value="+09:50">(GMT +9:30) Adelaide, Darwin</option>
              <option value="+10:00"selected="selected">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
              <option value="+10:50">(GMT +10:30) Lord Howe Island</option>
              <option value="+11:00">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
              <option value="+11:50">(GMT +11:30) Norfolk Island</option>
              <option value="+12:00">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
              <option value="+12:75">(GMT +12:45) Chatham Islands</option>
              <option value="+13:00">(GMT +13:00) Apia, Nukualofa</option>
              <option value="+14:00">(GMT +14:00) Line Islands, Tokelau</option>
            </select>
          
        </fieldset>
        <div class="container">
          <div class ="horizontal-center">
            <button type = "submit" name="registerBtn" id="registerBtn">Register</button>
          </div>
        </div>  
      </form>
      </div>
    
    <?php bottom_module(); 
    unset($_SESSION["registrationInProgress"]);
    ?>