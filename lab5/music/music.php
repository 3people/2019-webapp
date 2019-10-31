<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
      <?php
         $song_count = count(glob("lab5/musicPHP/songs/*.mp3"));
      ?>
		<p>
			I love music.
			I have <?= $song_count?> total songs,
			which is over <?= (int)($song_count / 10)?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
			<ol>
            <?php
            if(isset($_GET["newspages"])){
               $newspages = $_GET["newspages"];   
            }else{
               $newspages = 5;
            }
            for ($i=11; $i >= 12-$newspages; $i--) {?>
               <li><a href="https://www.billboard.com/archive/article/201910">2019-<?=$i?></a></li>
            <?php } ?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
         <?php
            $arr_fav = array("Roses", "Green Day", "Blink182");
            array_push($arr_fav, "Queen");
            foreach($arr_fav as $fav){?>
               <li> <?= $fav ?> </li>
            <?php } ?>
			</ol>

         <ol>
         <?php
            foreach(file("favorite.txt") as $fav_txt){
               $exploded = explode(" ", $fav_txt);
               $imploded = implode("_", $exploded);?>
               <li><a href = "http://en.wikipedia.org/wiki/ <?= $imploded ?> "> <?= $fav_txt ?> </a></li>
         <?php } ?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
            <?php
            foreach (glob("lab5/musicPHP/songs/*.mp3") as $mp3) {?>
               <li class="mp3item"> 
                  <?= $mp3 ?>
               </li>
            <?php } ?>

            <?php
            foreach (glob("lab5/musicPHP/songs/*.mp3") as $new_mp3) {
               $file_with_size[basename($new_mp3)] = (int)(filesize($new_mp3)/ 1024);
            }
            arsort($file_with_size);
            
            foreach($file_with_size as $file_name => $file_size){?>
               <li class="mp3item"> 
                  <a href = "lab5/musicPHP/songs/<?= $file_name ?>" download> <?= $file_name ?> </a> (<?= $file_size ?> KB) </li>
            <?php } ?>
				<!-- Exercise 8: Playlists (Files) -->
            <?php
            foreach(array_reverse(glob("lab5/musicPHP/songs/*.m3u")) as $playlist){?>
               <li class="playlistitem"> <?= basename($playlist) ?>:
                  <ul>
                     <?php
                     $files = file($playlist);
                     shuffle($files);
                     foreach($files as $playlist_music){
                        if(strpos($playlist_music, "#") === false){?>
                           <li> <?= $playlist_music ?> </li>
                     <?php }} ?> 
                  </ul>
               </li>
            <?php } ?>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
