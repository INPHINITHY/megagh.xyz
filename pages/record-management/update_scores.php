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
    <link rel="stylesheet" href="/css-library/style.css">
    <?php include('./../../includes/links.php'); ?>
    <title>Record Match</title>
    <style>
        label{
            display:block;
        }
        .grid-three-columns{
            gap:20px
        }
    </style>
</head>
<body class='resbody'>
    <h2 class="center">Record Match Results</h2>
    <p class="center">Each must be recorded seperately not at once like GnT vs Panda</p>
    <form id='scoreform' method="POST" action="process_match.php" class="match-form">
        <div class="grid-three-columns" style="place-items:center">
        <div class='linear-card'>
        <div class="grid-four-columns" style="place-items:center">
            <div>
                <label for="team1"><p class="form-text">Home</p></label>
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
            </div>
            <div>
                <label for="team1_score"><p class="form-text">Goals</p></label>
                <input type="number" name="team1_score" id="team1_score" required min="0">
            </div>
            <div>
                <label for="team1_win"><p class="form-text">Wins</p></label>
                <input type="number" name="team1_win" id="team1_win" required min="0">
            </div>
            <div>
                <label for="team1_draw"><p class="form-text">Draws</p></label>
                <input type="number" name="team1_draw" id="team1_draw" required min="0">
            </div>
        </div>
        </div>
        <div><button type="submit">Submit Match</button></div>
        <div class='linear-card'>
        <div class="grid-fpur-columns">
            <div>
                <label for="team2"><p class="form-text">Away</p></label>
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
            </div>
            <div>
                 <label for="team2_score"><p class="form-text">Goals</p></label>
                 <input type="number" name="team2_score" id="team2_score" required min="0">
            </div>
            <div>
                <label for="team2_win"><p class="form-text">Wins</p></label>
                <input type="number" name="team2_win" id="team2_win" required min="0">
            </div>
            <div>
                <label for="team2_draw"><p class="form-text">Draws</p></label>
                <input type="number" name="team2_draw" id="team2_draw" required min="0">
            </div>
        </div>
        </div>
        </div>
    </form>
    <div><p>ignore if you are inly recording for teams</p>
         <?php include('./process_players.php') ?>
    </div>
   </body>
</html>
