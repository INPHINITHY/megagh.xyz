<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('./../../includes/links.php'); ?>
<title>WELCOME </title> 
</head>
<style>
	
</style>
<body class="body-light">
    <header class="header">
        	<?php include('./../../includes/nav.php'); ?>
    </header>
	<?php
// Load player stats data for the club
$team = isset($_GET['team']) ? htmlspecialchars($_GET['team']) : 'Immortal Souls of eSports'; // Default team if not provided

$playerStatFile = __DIR__ . '/player_stats.json';
$minAppearances = 0; // Set minimum appearances required

// Check if the player stats file exists
if (file_exists($playerStatFile)) {
    // Read and decode the JSON file
    $playerStats = json_decode(file_get_contents($playerStatFile), true);
    
    // Check if the specified team exists in the stats
    if (isset($playerStats['teams'][$team])) {
        $players = $playerStats['teams'][$team]['players'];

        // Prepare an array for qualified players with default values
        $qualifiedPlayers = [];

        foreach ($players as $player) {
            // Set default values if not present
            $player['wins'] = $player['wins'] ?? 0;
            $player['draws'] = $player['draws'] ?? 0;
            $player['losses'] = $player['losses'] ?? 0;
            $player['gd'] = $player['gd'] ?? 0;
            $player['total_points'] = $player['total_points'] ?? 0;
            $player['rating'] = $player['rating'] ?? 0;
            $player['goals'] = $player['goals'] ?? 0;
            $player['appearances'] = $player['appearances'] ?? 0;

            // Only include players meeting the threshold
            if ($player['appearances'] >= $minAppearances) {
                $qualifiedPlayers[] = $player; // Add player to qualified players
            }
        }

        // Sort qualified players by their rating
        usort($qualifiedPlayers, function($a, $b) {
            return $b['rating'] <=> $a['rating']; // Sort by descending rating
        });

         // Output sorted players in a table format
         echo"<div class='card-section'>";
         echo "<h2 class='center'>Players for {$team}</h2>";
         echo "<table style='width: 100%; border-collapse: collapse;'>";
         echo "<thead>
                 <tr>
                     <th>#</th>
                     <th style='text-align:left'>Player</th>
                     <th class = 'hide'>Goals</th>
                     <th>MP</th>
                     <th class = 'hide'>W</th>
                     <th class = 'hide'>D</th>
                     <th class = 'hide'>L</th>
                     <th class = 'hide'>GD</th>
                     <th>PPG</th>
                     <th>Rating</th>
                 </tr>
               </thead>
               <tbody>";
 
         $rank = 1;
         foreach ($qualifiedPlayers as $player) {
             $pointsPerGame = $player['total_points'] / max($player['appearances'], 1); // Avoid division by zero
             echo "<tr>
                     <td class='td-rank'>{$rank}</td>
                     <td class='team-cell' style='width:50px'>{$player['player_name']}</td>
                     <td class = 'hide'>{$player['goals']}</td>
                     <td>{$player['appearances']}</td>
                     <td class = 'hide'>{$player['wins']}</td>
                     <td class = 'hide'>{$player['draws']}</td>
                     <td class = 'hide'>{$player['losses']}</td>
                     <td class = 'hide'>{$player['gd']}</td>
                     <td>" . number_format($pointsPerGame, 2) . "</td>
                     <td>" . number_format($player['rating'], 2) . "</td>
                   </tr>";
             $rank++;
         }
 
         echo "</tbody></table>";
         echo "</div>";
     } else {
         echo "<h2>Team '{$team}' not found.</h2>";
     }
 } else {
     echo "<h2>Player stats file not found.</h2>";
 }
 ?>
 

<div class="player-card-grid">
<?php foreach ($players as $player): ?>  <!-- Use all players for card display -->
    <?php
        // Ensure all data is set with defaults for the player
        $player['goals'] = $player['goals'] ?? 0;
        $player['gd'] = $player['gd'] ?? 0;
        $player['appearances'] = $player['appearances'] ?? 0;
        $player['wins'] = $player['wins'] ?? 0;
        $player['total_points'] = $player['total_points'] ?? 0;
        $player['rating'] = $player['rating'] ?? 0;
    ?>
<div class="player-card-2"> 
    <img class="img" src="/assets/images/players/les_addicts_du_pes/<?php print $player['img']; ?>.jpg" alt="<?php print $player['player_name']; ?>"/>
    <div class="player-card-2-name">
        <h2><?php print $player['player_name']; ?></h2>
    </div>
        <div class="player-card-2-overview center">
            <div class="grid-three-columns">
                <div>Goals<br><?php print $player['goals']; ?></div>
                <div>GD<br><?php print $player['gd']; ?></div>
                <div>Matches<br><?php print $player['appearances']; ?></div>
            </div>
            <div class="grid-three-columns">
                <div>Win<br><?php print $player['wins']; ?></div>
                <div>Point<br><?php print $player['total_points']; ?></div>
                <div>Rating<br><?php print number_format($player['rating'], 2); ?></div>
            </div>
        </div>
</div>

<?php endforeach; ?>
</div>

<footer class="footer" style="background-color: #929fba">
    <?php include('./../../includes/footer.php'); ?>
</footer>
</body>
</html>