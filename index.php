<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dota2leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
    <link href="./assets/css/dota2minimapheroes.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
<?php
		if($_GET["division"]) {
			$division = ($_GET["division"]);
		} else {
			$division = "americas";
		}
		
		include './src/api.php';
		$api = new api();

		$api->url = 'http://www.dota2.com/webapi/ILeaderboard/GetDivisionLeaderboard/v0001?division='.$division;

		try {
		$s = $api->get_api_data();
		} catch (Exception  $e ) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
		} 
		$server_time = date("Y-m-d H:i:s", $s->server_time);
		$time_posted = date("Y-m-d H:i:s", $s->time_posted);
		$next_scheduled_post_time = date("Y-m-d H:i:s", $s->next_scheduled_post_time);
?>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Dota2leaderboard</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
	<?php 
		echo '<ul class="nav nav-tabs" role="tablist">';
		  echo '<li class="active"><a href="?division=americas">Americas</a></li>';
		  echo '<li><a href="?division=europe">Europe</a></li>';
		  echo '<li><a href="?division=china">China</a></li>';
		  echo '<li><a href="?division=se_asia">Sea</a></li>';
		echo '</ul>';
		
			echo '<table class="table table-bordered dire">';
				echo '<thead>';
					echo '<tr >';
						echo '<th>Rank</th>';
						echo '<th>Player</th>';
						echo '<th>MMR</th>';
						echo '<th>Country</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach($s->leaderboard as $lb){
					echo '<tr>';
						echo '<td>'.$lb->rank.'</td>';
						echo '<td>';
						if($lb->team_tag){
							echo $lb->team_tag.'.';
						}
						echo $lb->name.'</td>';
						echo '<td>'.$lb->solo_mmr.'</td>';
						if($lb->country) {
							echo '<td><img src="http://cdn.steamcommunity.com/public/images/countryflags/' . $lb->country . '.gif"</td>';
						} else {
							echo '<td></td>';
						}						
	
					echo '</tr>';
				}
				echo '</tbody>';
			echo '</table>';

		echo 'Server time: '.$server_time;
		echo '<br>';
		echo 'Last update: '.$time_posted;
		echo '<br>';
		echo 'Next update: '.$next_scheduled_post_time;
	
	?>
      </div>
      <hr>
    </div> <!-- /container -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap-transition.js"></script>
    <script src="./assets/js/bootstrap-alert.js"></script>
    <script src="./assets/js/bootstrap-modal.js"></script>
    <script src="./assets/js/bootstrap-dropdown.js"></script>
    <script src="./assets/js/bootstrap-scrollspy.js"></script>
    <script src="./assets/js/bootstrap-tab.js"></script>
    <script src="./assets/js/bootstrap-tooltip.js"></script>
    <script src="./assets/js/bootstrap-popover.js"></script>
    <script src="./assets/js/bootstrap-button.js"></script>
    <script src="./assets/js/bootstrap-collapse.js"></script>
    <script src="./assets/js/bootstrap-carousel.js"></script>
    <script src="./assets/js/bootstrap-typeahead.js"></script>
	

  </body>
</html>
