<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enter Scores</title>
</head>
<body>
        <form action="process.php" method="post">
    <h3>Enter Match Scores</h3>
    <label for="team1">Team 1:</label>
    <select name="team1" id="team1">
        <option value="LPG">Les Panthers (LPG)</option>
        <option value="GNT">eFootball Giants (GNT)</option>
        <option value="PANDA">eSports Panda (PANDA)</option>
        <!-- Add more teams as needed -->
    </select>
    <input type="number" name="score1" min="0" required placeholder="Score for Team 1">
    
    <label for="team2">Team 2:</label>
    <select name="team2" id="team2">
        <option value="GNT">eFootball Giants (GNT)</option>
        <option value="LPG">Les Panthers (LPG)</option>
        <option value="PANDA">eSports Panda (PANDA)</option>
        <!-- Add more teams as needed -->
    </select>
    <input type="number" name="score2" min="0" required placeholder="Score for Team 2">
    
    <input type="submit" value="Submit Scores">
</form>
</body>
</html>
