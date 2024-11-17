<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /index.php'); // Redirect to login page
    exit();
}

$filename = './results.json';
if (file_exists($filename)) {
    $data = json_decode(file_get_contents($filename), true);
} else {
    echo "Error: results.json file not found.";
    exit();
}

function findTeam(&$teams, $teamName) {
    foreach ($teams as $index => $team) {
        if ($team['name'] === $teamName || $team['short-hand'] === $teamName) {
            return $index; // Return the index of the team
        }
    }
    return null; // Team not found
}

$divisionTeams = [
    'divisionOneTeams' => [
        'Les Panthers',
        'eFootball Giants',
        'eSports Panda',
        'Immortal Souls of eSports',
        'Legendary Gamers Club',
        'Les Addicts Du Pes',
        'Black Mamba',
        'Vawulence Evolution Club'
    ],
    'divisionTwoTeams' => [
        'Elite Pro Gamers',
        'Majestic Wiz',
        'Sports Boys Arena',
        'Militant Boyz Clan',
        'Nocturnal Terror Tribe',
        'MEC Galaxy Boys',
        'Ninja Bros',
        'Wild Hunters'
    ]
];
// Combine both divisions' teams into one array
$allTeams = array_merge($divisionTeams['divisionOneTeams'], $divisionTeams['divisionTwoTeams']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css-library/style.css">
    <?php include('./../../includes/links.php'); ?>
    <title>Record Match</title>
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
}
    </style>
</head>

<body>
<header>
        <?php include('./../../includes/nav.php'); ?>
</header>

<div class="main-content center" >
<form class="login-form" method="POST" action="">
    <h2 class="center">Record Match Results</h2>
    <p class="center">Each must be recorded seperately not at once like GnT vs Panda</p>
    <div class="form-input-material" style="place-items:center">
        <label for="team1">Home</label><br>
            <select name="team1" id="team1" required>
            <?php foreach ($allTeams as $team): ?>
                    <option value="<?php echo htmlspecialchars($team); ?>"><?php echo htmlspecialchars($team); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="grid-three-columns" >
                <div>
                    <label for="team1_score">Goals</label><br>
                    <input type="number" name="team1_score" style="width: 50px;"  required min="0" >
                </div>
                <div>
                    <label for="team1_win">Wins</label><br>
                    <input type="number" name="team1_win" id="team1_win" style="width: 50px;"  required min="0">
                </div>
                <div>
                    <label for="team1_draw">Draws</label><br>
                    <input type="number" name="team1_draw" id="team1_draw" style="width: 50px;"  required min="0">
                </div>
            </div>
        </div>
        <!-- Away Team -->
    <div class="form-input-material" style="place-items:center">
        <div class="grid-three-columns" >
                <div>
                    <label for="team2_score">Goals</label><br>
                    <input type="number" name="team2_score" style="width: 50px;"  required min="0">
                </div>
                <div>
                    <label for="team2_win">Wins</label><br>
                    <input type="number" name="team2_win" id="team1_win" style="width: 50px;"  required min="0">
                </div>
                <div>
                    <label for="team2_draw">Draws</label><br>
                    <input type="number" name="team2_draw" id="team2_draw" style="width: 50px;"  required min="0">
                </div>
            </div>
        
        <select name="team2" id="team2" required>
        <?php foreach ($allTeams as $team): ?>
                <option value="<?php echo htmlspecialchars($team); ?>"><?php echo htmlspecialchars($team); ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="team2">Away</label>
    </div>
        <div>
            <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>
</div>
</body>
</html>
