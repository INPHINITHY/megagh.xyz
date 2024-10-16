<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('./../../includes/links.php'); ?>
    <title>WELCOME</title> 
</head>
<style>
    
</style>
<body class="body-light">
    <header class="header">
        <?php include('./../../includes/nav.php'); ?>
    </header>

    <?php
    // File path to the player stats JSON
    $playerStatsFile = __DIR__ . '/../clans/player_stats.json';

    // Check if the player stats file exists
    if (!file_exists($playerStatsFile)) {
        echo "<h2>Player stats file not found.</h2>";
        exit;
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
    <h2>Select Teams for Matchup</h2>
    <form method="post" action="">
        <label for="team1">Select Team 1:</label>
        <select name="team1" id="team1" required onchange="this.form.submit()">
            <option value="">-- Select Team 1 --</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo htmlspecialchars($team); ?>" <?php echo ($team1 === $team) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($team); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="team2">Select Team 2:</label>
        <select name="team2" id="team2" required onchange="this.form.submit()">
            <option value="">-- Select Team 2 --</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo htmlspecialchars($team); ?>" <?php echo ($team2 === $team) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($team); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if (!empty($team1) && !empty($team2)): ?>
        <!-- Form to select players for the VS match -->
        <h2>Select Players for VS Match</h2>
        <form method="post" action="">
            <input type="hidden" name="team1" value="<?php echo htmlspecialchars($team1); ?>">
            <input type="hidden" name="team2" value="<?php echo htmlspecialchars($team2); ?>">

            <label for="player1"><?php echo htmlspecialchars($team1); ?> Player:</label>
            <select name="player1" id="player1" required>
                <option value="">-- Select Player --</option>
                <?php foreach ($playersTeam1 as $player): ?>
                    <option value="<?php echo htmlspecialchars($player['player_name']); ?>" <?php echo ($player1 === $player['player_name']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($player['player_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="player2"><?php echo htmlspecialchars($team2); ?> Player:</label>
            <select name="player2" id="player2" required>
                <option value="">-- Select Player --</option>
                <?php foreach ($playersTeam2 as $player): ?>
                    <option value="<?php echo htmlspecialchars($player['player_name']); ?>" <?php echo ($player2 === $player['player_name']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($player['player_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Input scores for both players -->
            <h3>Input Scores for the Matchup</h3>
            <label for="score1"><?php echo htmlspecialchars($player1); ?>'s Score:</label>
            <input type="number" name="score1" id="score1" required>

            <label for="score2"><?php echo htmlspecialchars($player2); ?>'s Score:</label>
            <input type="number" name="score2" id="score2" required>

            <button type="submit" name="submit_scores">Submit Scores</button>
        </form>
    <?php endif; ?>

    <footer class="footer" style="background-color: #929fba">
        <?php include('./../../includes/footer.php'); ?>
    </footer>
</body>
</html>
