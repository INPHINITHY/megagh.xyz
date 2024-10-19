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
    .card-section{
            margin-top:100px;
        }
    @media only screen and (max-width:720px){
        .linear-card:hover{
		transform: scale(1);
	}

    }
</style>
<body class="body-light">
    <header class="header">
            <?php include('./../../includes/nav.php'); ?>
    </header>
            <?php
            // File path to the player stats JSON
            $playerStatsFile = $_SERVER['DOCUMENT_ROOT'].'/pages/clans/player_stats.json';

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

            // Handle form submission for score input
            if (isset($_POST['submit_scores'])) {
                for ($i = 1; $i <= 5; $i++) {
                    // Fetch player names and scores for this match
                    $player1 = isset($_POST['player1_' . $i]) ? $_POST['player1_' . $i] : '';
                    $player2 = isset($_POST['player2_' . $i]) ? $_POST['player2_' . $i] : '';
                    $score1 = isset($_POST['score1_' . $i]) ? intval($_POST['score1_' . $i]) : 0;
                    $score2 = isset($_POST['score2_' . $i]) ? intval($_POST['score2_' . $i]) : 0;

                    // Update appearances and goals for both players
                    foreach ($playerStats['teams'][$team1]['players'] as &$p1) {
                        if ($p1['player_name'] === $player1) {
                            $p1['goals'] += $score1;
                            $p1['appearances'] += 1;
                            $p1['gd'] += ($score1 - $score2);
                        
                            // Update wins, losses, draws, and total points
                            if ($score1 > $score2) {
                                $p1['wins'] += 1;
                                $p1['total_points'] += 3; // 3 points for a win
                            } elseif ($score1 < $score2) {
                                $p1['losses'] += 1;
                            } else {
                                $p1['draws'] += 1;
                                $p1['total_points'] += 1; // 1 point for a draw
                            }
                        
                    // Ensure appearances are greater than 0 to avoid division by zero
                        if ($p1['appearances'] > 0) {
                            // Update average score and win rate
                            $p1['average_score'] = $p1['goals'] / $p1['appearances'];
                            $p1['win_rate'] = ($p1['wins'] / $p1['appearances']) * 100;
                            $p1['points_per_game'] = $p1['total_points'] / $p1['appearances'];

                            // Calculate player rating
                            $p1['rating'] = (
                                ($p1['wins'] / $p1['appearances']) * 50 +   // Win rate contribution
                                ($p1['gd'] / $p1['appearances']) * 30 +     // Goal difference per appearance
                                ($p1['points_per_game'] * 30) -    // Points per game
                                ($p1['losses'] / $p1['appearances']) * 15   // Loss rate penalty
                            );
                        } else {
                            // Handle case where the player has no appearances
                            $p1['average_score'] = 0;
                            $p1['win_rate'] = 0;
                            $p1['points_per_game'] = 0;
                            $p1['rating'] = 0;
                        }

                            
                        }
                    }
                    foreach ($playerStats['teams'][$team2]['players'] as &$p2) {
                        if ($p2['player_name'] === $player2) {
                            $p2['goals'] += $score2;
                            $p2['appearances'] += 1;
                            $p2['gd'] += ($score2 - $score1);
                        
                            // Update wins, losses, draws, and total points
                            if ($p2['appearances'] > 0) {
                                // Update average score and win rate
                                $p2['average_score'] = $p2['goals'] / $p2['appearances'];
                                $p2['win_rate'] = ($p2['wins'] / $p2['appearances']) * 100;
                                $p2['points_per_game'] = $p2['total_points'] / $p2['appearances'];
                
                                // Calculate player rating
                                $p2['rating'] = (
                                    ($p2['wins'] / $p2['appearances']) * 50 +   // Win rate contribution
                                    ($p2['gd'] / $p2['appearances']) * 30 +     // Goal difference per appearance
                                    ($p2['points_per_game'] * 30) -    // Points per game
                                    ($p2['losses'] / $p2['appearances']) * 15   // Loss rate penalty
                                );
                            } else {
                                // Handle case where the player has no appearances
                                $p2['average_score'] = 0;
                                $p2['win_rate'] = 0;
                                $p2['points_per_game'] = 0;
                                $p2['rating'] = 0;
                            }
                        }
                    }
                }

                // Save updated player stats back to the JSON file
                if (file_put_contents($playerStatsFile, json_encode($playerStats))) {
                    echo "<h3>Scores Updated!</h3>";
                } else {
                    echo "<h3>Error writing to player stats file.</h3>";
                }
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
<div class="card-section">
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
            </div>   <!-- Input scores for both players -->
        </div>
        <hr>
    <?php endfor; ?>
</form>
<?php endif; ?>
</div>
</body>
<footer class="footer" style="background-color: #929fba">
        <?php include('./../../includes/footer.php'); ?>
</footer>
</html>