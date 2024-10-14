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
    <div class="container-card">
    <div class="tour-table">
    <table>
        <h2>Leaderboard</h2>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Team</th>
                <th>P</th>
                <th>MP</th>
                <th>W</th>
                <th>D</th>
                <th>L</th>
                <th>GD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class='team-cell'>
                    <img src="/assets/images/clan-logos/ibb.jpg" alt="">
                    <span class='team-name'>Manchester City</span>
                </td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
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
            </tbody>
    </table>
    </div>
    </div>
    </main>


<footer class="footer" style="background-color: #929fba">
            <?php include('./../includes/footer.php'); ?>
</footer>
</body>
</html>
