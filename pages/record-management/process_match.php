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
$filename = 'results.json';
if (file_exists($filename)) {
    $scores = json_decode(file_get_contents($filename), true);
} else {
    $scores = [];
}

// Initialize data for both teams if they don't exist in the scores array
if (!isset($scores[$team1])) {
    $scores[$team1] = ['wins' => 0, 'draws' => 0, 'losses' => 0, 'gd' => 0, 'points' => 0];
}
if (!isset($scores[$team2])) {
    $scores[$team2] = ['wins' => 0, 'draws' => 0, 'losses' => 0, 'gd' => 0, 'points' => 0];
}

// Determine the outcome of the match
if ($team1_win > $team2_win) {
    // Team 1 wins
    $scores[$team1]['wins'] += 1;
    $scores[$team2]['losses'] += 1; 
} elseif ($team1_win < $team2_win) {
    // Team 2 wins
    $scores[$team2]['wins'] += 1;
    $scores[$team1]['losses'] += 1;
}

//pionts update
$team1_point =  $team1_win * 3 + $team1_draw;
$team2_point =  $team2_win * 3 + $team2_draw;

$scores[$team1]['points'] += $team1_point;
$scores[$team2]['points'] += $team2_point;

// Update goal difference (GD)
$team1_gd = $team1_score - $team2_score;
$team2_gd = $team2_score - $team1_score;

$scores[$team1]['gd'] += $team1_gd;
$scores[$team2]['gd'] += $team2_gd;

// Save the updated scores to the JSON file
file_put_contents($filename, json_encode($scores));

// Redirect back to the tournament page
header('Location: /pages/tournament.php');
exit();
?>
