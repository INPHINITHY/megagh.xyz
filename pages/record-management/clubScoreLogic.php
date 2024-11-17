<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php'); // Redirect to login page
    exit();
}

// Get the form data
$team1 = $_POST['team1'] ?? '';
$team1_score = $_POST['team1_score'] ?? 0;
$team1_win = $_POST['team1_win'] ?? 0;
$team1_draw = $_POST['team1_draw'] ?? 0;
$team2 = $_POST['team2'] ?? '';
$team2_score = $_POST['team2_score'] ?? 0;
$team2_win = $_POST['team2_win'] ?? 0;
$team2_draw = $_POST['team2_draw'] ?? 0;

// Load existing scores data from the JSON file
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


$team1Division = in_array($team1, $divisionTeams['divisionOneTeams']) ? 'divisionOneTeams' : 'divisionTwoTeams';
$team2Division = in_array($team2, $divisionTeams['divisionOneTeams']) ? 'divisionOneTeams' : 'divisionTwoTeams';


// Find teams in both divisions
$team1Index = findTeam($data[$team1Division], $team1);
$team2Index = findTeam($data[$team2Division], $team2);

// Ensure both teams exist in data
if ($team1Index === null || $team2Index === null) {
    echo "Error: One or both teams not found.";
    exit();
}

// Determine the outcome of the match
if ($team1_score > $team2_score) {
    // Team 1 wins
    $data[$team1Division][$team1Index]['wins'] += 1;
    $data[$team2Division][$team2Index]['loss'] += 1;
} elseif ($team1_score < $team2_score) {
    // Team 2 wins
    $data[$team2Division][$team2Index]['wins'] += 1;
    $data[$team1Division][$team1Index]['loss'] += 1;
} else {
    // Draw
    $data[$team1Division][$team1Index]['draws'] += 1;
    $data[$team2Division][$team2Index]['draws'] += 1;
}

// Update points
$team1_points = $team1_win * 3 + $team1_draw;
$team2_points = $team2_win * 3 + $team2_draw;
$data[$team1Division][$team1Index]['points'] += $team1_points;
$data[$team2Division][$team2Index]['points'] += $team2_points;

// Update goal stats
$data[$team1Division][$team1Index]['gf'] += $team1_score;
$data[$team1Division][$team1Index]['ga'] += $team2_score;
$data[$team2Division][$team2Index]['gf'] += $team2_score;
$data[$team2Division][$team2Index]['ga'] += $team1_score;

// Update goal difference (GD)
$data[$team1Division][$team1Index]['gd'] += $team1_score - $team2_score;
$data[$team2Division][$team2Index]['gd'] += $team2_score - $team1_score;

// Save updated scores to JSON file
file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

// Redirect back to the tournament page
header('Location: /pages/tournament.php');
exit();
?>