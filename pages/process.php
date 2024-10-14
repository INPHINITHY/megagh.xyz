<?php
include_once(__DIR__.'/../includes/db.php');
function updateScores($team, $points, $wins, $losses, $draws, $gd) {
    global $db; // Database connection

    // Prepare the SQL statement to update the team stats
    $stmt = $db->prepare("UPDATE teams SET points = points + ?, wins = wins + ?, losses = losses + ?, draws = draws + ?, goal_difference = goal_difference + ? WHERE team_identifier = ?");
    $stmt->bind_param("iiissis", $points, $wins, $losses, $draws, $gd, $team);
    
    // Execute the statement
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $score1 = intval($_POST['score1']);
    $score2 = intval($_POST['score2']);

    // Initialize variables for wins, losses, draws, and goal difference
    $gd1 = $score1 - $score2; // Goal difference for Team 1
    $gd2 = $score2 - $score1; // Goal difference for Team 2
    $points1 = $points2 = $wins1 = $wins2 = $losses1 = $losses2 = $draws1 = $draws2 = 0;

    if ($score1 > $score2) {
        // Team 1 wins
        $points1 = 3;
        $wins1 = 1;
        $losses2 = 1;
    } elseif ($score2 > $score1) {
        // Team 2 wins
        $points2 = 3;
        $wins2 = 1;
        $losses1 = 1;
    } else {
        // Draw
        $points1 = $points2 = 1;
        $draws1 = $draws2 = 1;
    }

    // Update scores for both teams
    updateScores($team1, $points1, $wins1, $losses1, $draws1, $gd1, $team1);
    updateScores($team2, $points2, $wins2, $losses2, $draws2, $gd2, $team2);

    // Redirect back to leaderboard
    header('Location: tournaments.php');
    exit();
}
