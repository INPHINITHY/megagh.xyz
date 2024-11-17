<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('./../../includes/links.php'); ?>
    <title>WELCOME</title> 
</head>
<style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #eceffc;
        }
        @media only screen and (max-width:960px){	
	.grid-three-columns{
		-ms-grid-columns:1fr 1fr 1fr;
		grid-template-columns:1fr 1fr 1fr;
	}
   
} .off{display:none}
    </style>
<body class="body-light">
    <header class="header">
            <?php include('./../../includes/nav.php'); ?>
    </header>
<style>
    @media only screen and (max-width:960px){	
	.grid-two-columns{
		-ms-grid-columns:1fr;
		grid-template-columns:1fr 1fr;
	}
}
</style>
<div class="grid-three-columns" style = "place-items:center">
                <div>
                    <a class="btn btn-primary" href="/pages/record-management/clubScoreLogic.php" role="button">Club Scores</a>
                </div>
                <div>
                    <a class="btn btn-primary" href="/pages/record-management/playerScoresForm.php" role="button">Player Scores</a>
                </div>
                <div>
                    <a class="btn btn-primary" href="?action=logout"role="button">Logout</a>
                </div>
            </div>
<?php include('./playerScroesLogic.php')?><!--the logic is here -->
    <!-- Form to select teams -->
<div class="main-content center" >
    <form method="post" action="" class="login-form <?php echo (!empty($team1) && !empty($team2)) ? 'off' : ''; ?>">
        <h2 class="center">SELECT THE CLUBS</h2>
            <div class="form-input-material" style="place-items:center">
                <label for="team1">HOME:</label><br>
                <select name="team1" id="team1" required onchange="this.form.submit()">
                    <option value="">-- Select HOME --</option>
                    <?php foreach ($teams as $team): ?>
                    <option style="width:200px" value="<?php echo htmlspecialchars($team); ?>" <?php echo ($team1 === $team) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($team); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-input-material" style="place-items:center">
                <label for="team2">AWAY:</label><br>
                <select name="team2" id="team2" required onchange="this.form.submit()">
                    <option style="width:200px" value="">-- Select Team 2 --</option>
                    <?php foreach ($teams as $team): ?>
                        <option value="<?php echo htmlspecialchars($team); ?>" <?php echo ($team2 === $team) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($team); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

    </form>
        <?php if (!empty($team1) && !empty($team2)): 
        ?>
</div>
<div class="main-content center" >
        <!-- Form to select players for the VS match -->
    <form method="post" action=""  class="login-form">
        <h2 class="center">PLAYER GOALS</h2>
            <input type="hidden" name="team1" value="<?php echo htmlspecialchars($team1); ?>">
            <input type="hidden" name="team2" value="<?php echo htmlspecialchars($team2); ?>"><!-- important for server side dont mess with -->
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <h3 class="center">Match <?php echo $i; ?></h3>
                <!-- Check for previously submitted players -->
                <?php
                    $selectedPlayer1 = isset($_POST['player1_' . $i]) ? $_POST['player1_' . $i] : '';
                    $selectedPlayer2 = isset($_POST['player2_' . $i]) ? $_POST['player2_' . $i] : '';
                ?>
        <div class="form-input-material" style="place-items:center">
            <label for="player1_<?php echo $i; ?>"><?php echo htmlspecialchars($team1); ?> Player:</label><br>
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
            <input style= "width:50px" type="number" name="score1_<?php echo $i; ?>" id="score1_<?php echo $i; ?>" required>
        </div>

        <div class="form-input-material" style="place-items:center">
            <label for="player2_<?php echo $i; ?>"><?php echo htmlspecialchars($team2); ?> Player:</label><br>
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
            <input style= "width:50px" type="number" name="score2_<?php echo $i; ?>" id="score2_<?php echo $i; ?>" required>
        </div>
        <?php endfor; ?>
        <button name="submit_scores" class="btn btn-primary" type="submit">Submit</button>
    </form>
    <?php endif; ?> 
</div>
</body>
</html>