<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include(__DIR__. '/../includes/links.php'); ?>
<title>TOURNAMENTS</title>
</head>

<body >	
     <header class="header">
                <?php include( './../includes/nav.php'); ?>
     </header>

	
    <main>
        <section class="featured-match">
            <h1>Featured Match</h1>
            <div class="match">
                <div class="team">
                    <img src="team1-logo.png" alt="Team 1">
                    <span>Manchester United</span>
                </div>
                <div class="score">2 - 1</div>
                <div class="team">
                    <img src="team2-logo.png" alt="Team 2">
                    <span>Liverpool</span>
                </div>
            </div>
        </section>

        <section class="standings">
            <h2>Current Standings</h2>
            <table>
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Team</th>
                        <th>Played</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Manchester City</td>
                        <td>9</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Arsenal</td>
                        <td>9</td>
                        <td>21</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Liverpool</td>
                        <td>9</td>
                        <td>20</td>
                    </tr>
                    https://chatgpt.com/share/670c9111-eb00-8011-bb1e-bcdf4d05c818
                    <!-- More teams here -->
                </tbody>
            </table>
        </section>
    </main>


<footer class="footer" style="background-color: #929fba">
            <?php include('./../includes/footer.php'); ?>
</footer>
</body>
</html>
