<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /index.php'); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./../../includes/links.php'); ?>
    <title>Record Match</title>
</head>
<body>
    <h2 class="center">Record Match Results</h2>
    <form method="POST" action="process_match.php" class="match-form">
        <label for="team1">Team 1:</label>
        <select name="team1" id="team1" required>
            <option value="Les Panthers">Les Panthers</option>
            <option value="eFootball Giants">eFootball Giants</option>
            <option value="eSports Panda">eSports Panda</option>
            <option value="Immortal Souls of eSports">Immortal Souls of eSports</option>
            <option value="Legendary Gamers Club">Legendary Gamers Club</option>
            <option value="Les Addicts Du Pes">Les Addicts Du Pes</option>
            <option value="Black Mamba">Black Mamba</option>
            <option value="Vawulence Evolution Club">Vawulence Evolution Club</option>
        </select>

        <label for="team1_score">Team 1 Score:</label>
        <input type="number" name="team1_score" id="team1_score" required min="0">

        <label for="team2">Team 2:</label>
        <select name="team2" id="team2" required>
            <option value="Les Panthers">Les Panthers</option>
            <option value="eFootball Giants">eFootball Giants</option>
            <option value="eSports Panda">eSports Panda</option>
            <option value="Immortal Souls of eSports">Immortal Souls of eSports</option>
            <option value="Legendary Gamers Club">Legendary Gamers Club</option>
            <option value="Les Addicts Du Pes">Les Addicts Du Pes</option>
            <option value="Black Mamba">Black Mamba</option>
            <option value="Vawulence Evolution Club">Vawulence Evolution Club</option>
        </select>

        <label for="team2_score">Team 2 Score:</label>
        <input type="number" name="team2_score" id="team2_score" required min="0">

        <button type="submit">Submit Match</button>
    </form>
</body>
</html>
