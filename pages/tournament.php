<?php
// tournament_page.php

// Load the scores from the JSON file
$filename =$_SERVER['DOCUMENT_ROOT'] .'/pages/record-management/results.json';
if (file_exists($filename)) {
    $scores = json_decode(file_get_contents($filename), true);
} else {
    $scores = [];
}

// Define the teams to match your current HTML
$divisionOneTeams = [
    'Les Panthers',
    'eFootball Giants',
    'eSports Panda',
    'Immortal Souls of eSports',
    'Legendary Gamers Club',
    'Les Addicts Du Pes',
    'Black Mamba',
    'Vawulence Evolution Club'
];

$divisionTwoTeams = [
    'Elite Pro Gamers',
    'Majestic Wiz',
    'Sports Boys Arena',
    'Militant Boyz Clan',
    'Nocturnal Terror Tribe',
    'MEC Galaxy Boys',
    'Ninja Bros',
    'Wild Hunters'

]

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . '/../includes/links.php'); ?>
    <title>TOURNAMENTS</title>
    <style>
        
        @media only screen and (max-width:720px){
            .card-section {
            margin: 20;
            padding: 5px;
        }
        }
    </style>
</head>
<body>
    <header class="header">
        <?php include('./../includes/nav.php'); ?>
    </header>
    <?php
    
    echo"<div class='card-section'>";
    echo "<h2 class='center'>Division One</h2>";
            echo "<table  style='width: 100%; border-collapse: collapse;'>";
            echo "<thead>
                <tr>
                        <th>Rank</th>
                        <th style='text-align:left'>Team</th>
                        <th>P</th>
                        <th>MP</th>
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th>GD</th>
                </tr>
            </thead>
            <tbody>";
                // Sort teams by points (highest to lowest)
                usort($divisionOneTeams, function($team1, $team2) use ($scores) {
                    return ($scores[$team2]['points'] ?? 0) - ($scores[$team1]['points'] ?? 0);
                });

                // Loop through the teams and output the table rows
                $rank = 1;
                foreach ($divisionOneTeams as $team) {
                    $teamData = $scores[$team] ?? ['points' => 0, 'wins' => 0, 'draws' => 0, 'losses' => 0, 'gd' => 0];

                    // Assign different classes for points/rank styling
                    $pointsClass = '';
                    if ($rank == 1) {
                        $pointsClass = 'fst';
                    } elseif ($rank == 2) {
                        $pointsClass = 'snd';
                    } elseif ($rank == 3) {
                        $pointsClass = 'trd';
                    }

                    // Output table row
                    echo "<tr>
                        <td class='td-rank'>{$rank}</td>
                        <td class='team-cell'>
                            <img src='/assets/images/clan-logos/" . strtolower(str_replace(' ', '-', $team)) . ".jpg' alt=''>
                            <span class='team-name'>{$team}</span>
                            <span class='team-name short'>" . strtoupper(substr($team, 0, 3)) . "</span>
                        </td>
                        <td class='td-points {$pointsClass}'>{$teamData['points']}</td>
                        <td>" . ($teamData['wins'] + $teamData['draws'] + $teamData['losses']) . "</td>
                        <td>{$teamData['wins']}</td>
                        <td>{$teamData['draws']}</td>
                        <td>{$teamData['losses']}</td>
                        <td>{$teamData['gd']}</td>
                    </tr>";
                    $rank++;
                }
                echo "</tbody></table>";
                echo "</div>";
                ?>
<?php

echo "<div class='card-section'>";
    echo "<h2 class='center'>Division Two</h2>";
            echo "<table  style='width: 100%; border-collapse: collapse;'>";
            echo "<thead>
                <tr>
                        <th>Rank</th>
                        <th style='text-align:left'>Team</th>
                        <th>P</th>
                        <th>MP</th>
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th>GD</th>
                </tr>
            </thead>
            <tbody>";
                // Sort teams by points (highest to lowest)
                usort($divisionTwoTeams, function($team1, $team2) use ($scores) {
                    return ($scores[$team2]['points'] ?? 0) - ($scores[$team1]['points'] ?? 0);
                });

                // Loop through the teams and output the table rows
                $rank = 1;
                foreach ($divisionTwoTeams as $team) {
                    $teamData = $scores[$team] ?? ['points' => 0, 'wins' => 0, 'draws' => 0, 'losses' => 0, 'gd' => 0];

                    // Assign different classes for points/rank styling
                    $pointsClass = '';
                    if ($rank == 1) {
                        $pointsClass = 'fst';
                    } elseif ($rank == 2) {
                        $pointsClass = 'snd';
                    } elseif ($rank == 3) {
                        $pointsClass = 'trd';
                    }

                    // Output table row
                    echo "<tr>
                        <td class='td-rank'>{$rank}</td>
                        <td class='team-cell'>
                            <img src='/assets/images/clan-logos/" . strtolower(str_replace(' ', '-', $team)) . ".jpg' alt=''>
                            <span class='team-name'>{$team}</span>
                            <span class='team-name short'>" . strtoupper(substr($team, 0, 3)) . "</span>
                        </td>
                        <td class='td-points {$pointsClass}'>{$teamData['points']}</td>
                        <td>" . ($teamData['wins'] + $teamData['draws'] + $teamData['losses']) . "</td>
                        <td>{$teamData['wins']}</td>
                        <td>{$teamData['draws']}</td>
                        <td>{$teamData['losses']}</td>
                        <td>{$teamData['gd']}</td>
                    </tr>";
                    $rank++;
                }
                echo "</tbody></table>";
                echo "</div>";
                ?>
    <footer class="footer" style="background-color: #929fba">
        <?php include('./../includes/footer.php'); ?>
    </footer>
</body>
</html>
