<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include(__DIR__. '/../includes/links.php'); ?>
 <title>CLUBS</title>
</head>
<body class="body-light" >	
	
<header class="header">
	<?php include(__DIR__. '/../includes/nav.php'); ?>
</header>
	<div class="container-lm" style='background-color:#AA767C'>
	<h1 id="clubs">CLUBS</h1>
	</div>
	<div class="container-card">
	<div class="card-section">
		<div class="center">
			just a sample of posible registartions
            <h2>Contactez-nous</h2>
            <form action="contact.php" method="post">
                <input type="text" name="name" placeholder="Nom" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" placeholder="Message" required></textarea>
                <input type="submit" value="Envoyer">
            </form>
        </div>
		<a href="/club_page.php?team=Les Panthers">Les Panthers</a>
<a href="/pages/clans/eFootball Giants.php">eFootball Giants</a>

		<div>
    <?php
// Load all player stats
$playerStatsFile = __DIR__ . '/player_stats.json';
$allPlayers = [];
if (file_exists($playerStatsFile)) {
    $playerStats = json_decode(file_get_contents($playerStatsFile), true);
    foreach ($playerStats as $team => $teamData) {
        foreach ($teamData['players'] as $playerName => $stats) {
            $allPlayers[] = [
                'name' => $playerName,
                'team' => $team,
                'goals' => $stats['goals'],
                'appearances' => $stats['appearances'],
                'score' => $stats['goals'] / max($stats['appearances'], 1)
            ];
        }
    }
    usort($allPlayers, function($a, $b) {
        return $b['score'] - $a['score']; // Sort by descending score
    });
}
?>

<h2 class="center">Player Rankings</h2>
<table class="player-ranking-table">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Player</th>
            <th>Team</th>
            <th>Goals</th>
            <th>Appearances</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allPlayers as $index => $player): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $player['name']; ?></td>
                <td><?php echo $player['team']; ?></td>
                <td><?php echo $player['goals']; ?></td>
                <td><?php echo $player['appearances']; ?></td>
                <td><?php echo number_format($player['score'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>



    </div>
		<div class="grid-four-columns">
			<div class="linear-card mamba">
			<img src="/assets/images/clan-logos/mamba.jpg" alt="">
			    <h3>Black Mamba </h3>
				<ul>
					<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
					<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
				</ul>
			</div>
			<div class="linear-card epg">
			<img src="/assets/images/clan-logos/epg.jpg" alt="">
			    <h3>Elite Pro Gamers</h3>
				<ul>
					<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
					<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
				</ul>
			</div>
			<div class="linear-card giants">
			<img src="/assets/images/clan-logos/egiants.jpg" alt="">
			    <h3>eFootball GIANTS</h3>
				<ul>
					<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
					<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
				</ul>			
			</div>
			<div class="linear-card panda">
			<img src="/assets/images/clan-logos/panda.jpg" alt="">
			    <h3>eSports PANDA </h3>
				<ul>
					<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
					<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="grid-four-columns">
			<div class="linear-card immortal">
				<img src="/assets/images/clan-logos/ims.jpg" alt="">
					<h3>Immortal Souls of eSports </h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card legendary">
				<img src="/assets/images/clan-logos/lgc.jpg" alt="">
			    <h3>Legendary Gamers Clan</h3>
				<ul>
					<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
					<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
				</ul>
			</div>
			<div class="linear-card addicts">
				<img src="/assets/images/clan-logos/addicts.jpg" alt="">
			    <h3>Les Addicts Du PES</h3>
				<ul>
					<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
					<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
				</ul>			
			</div>
			<div class="linear-card panthers">
				<img src="/assets/images/clan-logos/lpg.jpg" alt="">
					<h3>Les Panthers </h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
		</div>
		<div class="grid-three-columns">
			<div class="linear-card majestic">
				<img src="/assets/images/clan-logos/wiz.jpg" alt="">
					<h3>Majestic Wiz</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card galaxy">
				<img src="/assets/images/clan-logos/mgb.jpg" alt="">
					<h3>MEC Galaxy Boys </h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card militant">
				<img src="/assets/images/clan-logos/mbc.jpg" alt="">
					<h3>Militant Boyz Clan</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
		</div>
		<div class="grid-three-columns">
			<div class="linear-card ninja">
				<img src="/assets/images/clan-logos/ninja.jpg" alt="">
					<h3>Ninja Bro's</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card nocturnal">
				<img src="/assets/images/clan-logos/ntt.jpg" alt="">
					<h3>Nocturnal Terror Tribe</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card vawulence">
				<img src="/assets/images/clan-logos/sba.jpg" alt="">
					<h3>Sports Boys Arena</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
		</div>
		<div class="grid-three-columns">
			<div class="linear-card vawulence">
				<img src="/assets/images/clan-logos/vec.jpg" alt="">
					<h3>Vawulence Evolution</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card hunters">
				<img src="/assets/images/clan-logos/hunters.jpg" alt="">
					<h3> Wild Hunters</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
			<div class="linear-card ibb">
				<img src="/assets/images/clan-logos/ibb.jpg" alt="">
					<h3>Incredible Bullion Boys</h3>
					<ul>
						<li><a href="" title="instagram"><i class="bi bi-instagram"></i></a></li>
						<li><a href="" title="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
					</ul>
			</div>
		</div>
	</div> 
</body>
<footer class="footer center" style="background-color: #929fba">
            <?php include(__DIR__.'/../includes/footer.php'); ?>
</footer>
</html>
