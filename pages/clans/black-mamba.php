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
$team = isset($_GET['team']) ? htmlspecialchars($_GET['team']) : 'Black Mamba'; // Default team if not provided

$playerStatsFile = __DIR__ . '/player_stats.json';

// Check if the player stats file exists
if (file_exists($playerStatsFile)) {
    // Read and decode the JSON file
    $playerStats = json_decode(file_get_contents($playerStatsFile), true);
    
    // Check if the specified team exists in the stats
    if (isset($playerStats['teams'][$team])) {
        $players = $playerStats['teams'][$team]['players'];

        // Sort players by their average score (goals per appearance)
        usort($players, function($a, $b) {
            $scoreA = $a['appearances'] > 0 ? $a['goals'] / $a['appearances'] : 0; // Avoid division by zero
            $scoreB = $b['appearances'] > 0 ? $b['goals'] / $b['appearances'] : 0;
            return $scoreB <=> $scoreA; // Sort by descending score
        });

        // Output sorted players
        echo "<h2>Players for {$team}</h2>";
        echo "<ul>";
        foreach ($players as $player) {
            $avgScore = $player['appearances'] > 0 ? round($player['goals'] / $player['appearances'] * 100, 2) : 0; // Average score as a percentage
            echo "<li>{$player['player_name']} - Goals: {$player['goals']}, Appearances: {$player['appearances']}, Average Score: {$avgScore}%</li>";
        }
        echo "</ul>";
    } else {
        echo "<h2>Team '{$team}' not found.</h2>";
    }
} else {
    echo "<h2>Player stats file not found.</h2>";
}
?>


<div class="player-card-grid">
    <?php foreach ($players as $playerName => $stats): ?>
        <div class="player-card">
            <img src="/assets/images/players/<?php echo strtolower(str_replace(' ', '_', $playerName)); ?>.jpg" alt="<?php echo $playerName; ?>" />
            <h3><?php echo $playerName; ?></h3>
            <p>Goals: <?php echo $stats['goals']; ?></p>
            <p>Appearances: <?php echo $stats['appearances']; ?></p>
            <p>Score: <?php echo number_format($stats['goals'] / max($stats['appearances'], 1), 2); ?></p>
        </div>
    <?php endforeach; ?>
</div>
<footer class="footer" style="background-color: #929fba">
        <?php include('./../../includes/footer.php'); ?>
    </footer>
</body>
</html>
