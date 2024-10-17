<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('./../../includes/links.php'); ?>
    <title>WELCOME</title> 
</head>
<style>
    .grid-two-columns{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    @media only screen and (max-width:720px){
        .linear-card:hover{
		transform: scale(1);
	}

    }
</style>
<body class="body-light">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // File path to the player stats JSON
    $playerStatsFile = $_SERVER['DOCUMENT_ROOT'].'/pages/clans/player_stats.json';
    if (file_exists($playerStatsFile)) {
        $jsonContent = file_get_contents($playerStatsFile);
        $playerStats = json_decode($jsonContent, true); // Initialize player stats
    } else {
        echo "Player stats file not found!";
        exit;
    }
    if (file_put_contents($playerStatsFile, json_encode($playerStats, JSON_PRETTY_PRINT)) === false) {
        echo "<h2>Error writing to player stats file.</h2>";
    } else {
        echo "<h3>Scores Updated!</h3>";
    }
    

    // Load and decode the player stats data
    $playerStats = json_decode(file_get_contents($playerStatsFile), true);

    // Fetch available teams from the data
    $teams = array_keys($playerStats['teams']);

    // Initialize selected team and player variables
    $team1 = isset($_POST['team1']) ? $_POST['team1'] : '';
    $team2 = isset($_POST['team2']) ? $_POST['team2'] : '';
    $player1 = isset($_POST['player1']) ? $_POST['player1'] : '';
    $player2 = isset($_POST['player2']) ? $_POST['player2'] : '';

    // Handle form submission for score input
    if (isset($_POST['submit_scores'])) {
        $score1 = isset($_POST['score1']) ? intval($_POST['score1']) : 0;
        $score2 = isset($_POST['score2']) ? intval($_POST['score2']) : 0;

        // Update appearances and goals for both players
        foreach ($playerStats['teams'][$team1]['players'] as &$p1) {
            if ($p1['player_name'] === $player1) {
                $p1['goals'] += $score1;
                $p1['appearances'] += 1;
                $p1['gd'] = isset($p1['gd']) ? $p1['gd'] + ($score1 - $score2) : ($score1 - $score2);
            }
        }
        foreach ($playerStats['teams'][$team2]['players'] as &$p2) {
            if ($p2['player_name'] === $player2) {
                $p2['goals'] += $score2;
                $p2['appearances'] += 1;
                $p2['gd'] = isset($p2['gd']) ? $p2['gd'] + ($score2 - $score1) : ($score2 - $score1);
            }
        }

        // Save updated player stats back to the JSON file
        file_put_contents($playerStatsFile, json_encode($playerStats));

        echo "<h3>Scores Updated! {$player1} vs {$player2}.</h3>";
    }

    // Handle team and player selection for the "vs" matchup
    if (!empty($team1) && !empty($team2)) {
        if (isset($playerStats['teams'][$team1]) && isset($playerStats['teams'][$team2])) {
            $playersTeam1 = $playerStats['teams'][$team1]['players'];
            $playersTeam2 = $playerStats['teams'][$team2]['players'];
        } else {
            echo "<h2>Invalid team selection.</h2>";
        }
    }
    ?>

    <!-- Form to select teams -->
    <h2 class="center">SELECT THE CLUBS</h2>
    <form method="post" action="">
    <div class='linear-card'>
    <div class="grid-two-columns" style="place-items:center">
        <div>
        <label for="team1">Select Team 1:</label>
        <select name="team1" id="team1" required onchange="this.form.submit()">
            <option value="">-- Select Team 1 --</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo htmlspecialchars($team); ?>" <?php echo ($team1 === $team) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($team); ?>
                </option>
            <?php endforeach; ?>
        </select>
        </div>
        <div>
        <label for="team2">Select Team 2:</label>
        <select name="team2" id="team2" required onchange="this.form.submit()">
            <option value="">-- Select Team 2 --</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo htmlspecialchars($team); ?>" <?php echo ($team2 === $team) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($team); ?>
                </option>
            <?php endforeach; ?>
        </select>
        </div>
        </div>
        </div>

    </form>

    <?php if (!empty($team1) && !empty($team2)): ?>
    <!-- Form to select players for the VS match -->
    <h2 class="center">PLAYER GOALS</h2>
<form method="post" action="">
<button type="submit" name="submit_scores">Submit Scores</button>
    <input type="hidden" name="team1" value="<?php echo htmlspecialchars($team1); ?>">
    <input type="hidden" name="team2" value="<?php echo htmlspecialchars($team2); ?>">

    <?php for ($i = 1; $i <= 5; $i++): ?>
        <div class='linear-card'>
        <h3 class="center">Match <?php echo $i; ?></h3>

        <!-- Check for previously submitted players -->
        <?php
            $selectedPlayer1 = isset($_POST['player1_' . $i]) ? $_POST['player1_' . $i] : '';
            $selectedPlayer2 = isset($_POST['player2_' . $i]) ? $_POST['player2_' . $i] : '';
        ?>
        <div class="grid-two-columns" style="place-items:center">
            <div>
                <label for="player1_<?php echo $i; ?>"><?php echo htmlspecialchars($team1); ?> Player:</label>
                <select name="player1_<?php echo $i; ?>" id="player1_<?php echo $i; ?>" required>
                    <option value="">-- Select Player --</option>
                    <?php foreach ($playersTeam1 as $player): ?>
                        <option value="<?php echo htmlspecialchars($player['player_name']); ?>" 
                            <?php echo ($selectedPlayer1 === $player['player_name']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($player['player_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="score1_<?php echo $i; ?>"><?php echo htmlspecialchars($selectedPlayer1); ?></label>
                <input type="number" name="score1_<?php echo $i; ?>" id="score1_<?php echo $i; ?>" required>
            </div>

            <div>
                <label for="player2_<?php echo $i; ?>"><?php echo htmlspecialchars($team2); ?> Player:</label>
                    <select name="player2_<?php echo $i; ?>" id="player2_<?php echo $i; ?>" required>
                        <option value="">-- Select Player --</option>
                        <?php foreach ($playersTeam2 as $player): ?>
                            <option value="<?php echo htmlspecialchars($player['player_name']); ?>" 
                                <?php echo ($selectedPlayer2 === $player['player_name']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($player['player_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <label for="score2_<?php echo $i; ?>"><?php echo htmlspecialchars($selectedPlayer2); ?></label>
                <input type="number" name="score2_<?php echo $i; ?>" id="score2_<?php echo $i; ?>" required>
            </div>
        </div>

        <!-- Input scores for both players -->
</div>
        <hr>
    <?php endfor; ?>
</form>

<?php endif; ?>
</body>
</html>