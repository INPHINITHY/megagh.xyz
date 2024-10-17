<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('./../../includes/links.php'); ?>
    <title>ninja</title> 
</head>
<body class="body-light">
    <header class="header">
        <?php include('./../../includes/nav.php'); ?>
    </header>
    
    <?php
    // Load player stats data for the club
    $team = isset($_GET['team']) ? htmlspecialchars($_GET['team']) : 'Ninja Bros'; // Default team if not provided

    $playerStatsFile = __DIR__ . '/player_stats.json';
    $minAppearances = 5; // Set minimum appearances required

    // Check if the player stats file exists
    if (file_exists($playerStatsFile)) {
        // Read and decode the JSON file
        $playerStats = json_decode(file_get_contents($playerStatsFile), true);
        
        // Check if the specified team exists in the stats
        if (isset($playerStats['teams'][$team])) {
            $players = $playerStats['teams'][$team]['players'];
    
            // Filter players based on minimum appearances for qualified players
            $qualifiedPlayers = array_filter($players, function($player) use ($minAppearances) {
                return $player['appearances'] >= $minAppearances; // Only include players meeting the threshold
            });
    
            // Sort qualified players by their average score (goals per appearance)
            usort($qualifiedPlayers, function($a, $b) {
                $scoreA = $a['appearances'] > 0 ? $a['goals'] / $a['appearances'] : 0; // Avoid division by zero
                $scoreB = $b['appearances'] > 0 ? $b['goals'] / $b['appearances'] : 0;
                return $scoreB <=> $scoreA; // Sort by descending score
            });
    
            // Output sorted players in a table format
            echo "<h2 class='center'>Players for {$team}</h2>";
            echo "<table  style='width: 100%; border-collapse: collapse;'>";
            echo "<thead>
                    <tr>
                        <th>Rank</th>
                        <th style='text-align:left'>Player Name</th>
                        <th>Goals</th>
                        <th>Appearances</th>
                        <th>Average Score (%)</th>
                    </tr>
                  </thead>
                  <tbody>";
    
            $rank = 1;
            foreach ($qualifiedPlayers as $player) {
                $avgScore = $player['appearances'] > 0 ? round($player['goals'] / $player['appearances'] * 100, 2) : 0; // Average score as a percentage
                echo "<tr>
                        <td class='td-rank'>{$rank}</td>
                        <td class='team-cell' style='width:170px'>{$player['player_name']}</td>
                        <td>{$player['goals']}</td>
                        <td>{$player['appearances']}</td>
                        <td>" . number_format($avgScore, 2) . "</td>
                      </tr>";
                $rank++;
            }
    
            echo "</tbody></table>";
        } else {
            echo "<h2>Team '{$team}' not found.</h2>";
        }
    } else {
        echo "<h2>Player stats file not found.</h2>";
    }?>
    

    <div class="player-card-grid">
        <?php foreach ($players as $player): ?>  <!-- Use all players for card display -->
            <div class="player-card">
                <img src="/assets/images/players/<?php echo $player['img']; ?>.jpg" alt="<?php echo $player['player_name']; ?>" />
                <h3><?php echo $player['player_name']; ?></h3>
                <ul>
                    <li>Goal  <?php echo $player['goals']; ?></li>
                    <li>GD  <?php echo $player['gd']; ?></li>
                    <li>Apps  <?php echo $player['appearances']; ?></li>
                    <li>Avg  <?php echo number_format($player['goals'] / max($player['appearances'], 1), 2); ?></li>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <footer class="footer" style="background-color: #929fba">
        <?php include('./../../includes/footer.php'); ?>
    </footer>
</body>
</html>
