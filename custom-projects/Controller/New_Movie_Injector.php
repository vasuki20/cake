<?php
/// starts the db

include 'Logger.php';

$logfilename='/var/www/html/testing/vasuki/New_Movie_Injector_Log.txt';


$con = mysqli_connect("localhost:3306","root","9944200629.a","moviedata") OR die('Could not connect to MySQL: ' . mysqli_connect_error());

$con2 = mysqli_connect("localhost:3306","root","9944200629.a","yoonic") OR die('Could not connect to MySQL: ' . mysqli_connect_error());

echo "begin";


///movie block
	$m_catid = "-";
	$m_channelid = "-";
	$m_subcatid = "-";
	$m_syqicmovieid = "-";
	$m_title = "-";
	$m_type = "-";
	$m_desc = "-";
	$m_imagethumb = "-";
	$m_director = "-";
	$m_cast = "-";
	$m_genre = "-";
	$m_tag = "-";
	$m_language = "-";
	$m_subtitle = "-";
	$m_credit = "-";
	$m_duration = "-";
	$m_cp = "-";
	$m_telcoregion = "-";
	$m_abr = "-";
	$m_rtsp1 = "-";
	$m_rtsp2 = "-";
	$m_createdby = "-";
	$m_bundleid = "-";

	print_r($m_catid);
	
	$id_result = mysqli_query($con, "SELECT `syqic_movie_id` FROM `vod_tbl`");
	if ($id_result) { // If it ran OK, display the records.
	
		while ($row = mysqli_fetch_array($id_result)) {
			$syqic_movie_id = $row['syqic_movie_id'];
			echo ' ';
// 			echo $syqic_movie_id;
			
			
			

			
			
			/// select the properties
			$channel_result = mysqli_query($con, "select channel_id,category_id,bundle_id,content_type from channel_tbl where syqic_channel_id = $syqic_movie_id");
			$channel_row = mysqli_fetch_array($channel_result);
						
			/// grabs all ID's associated with selected channels
			$channel_dir = $channel_row['content_type'];
			///set the telco
			$m_bundleid = $channel_row['bundle_id']; //1 = free, 2 = basic, 3 = premium
			$m_catid = $channel_row['category_id']; //channels_category

			$m_channelid = $channel_row['channel_id'] ; //channels table
			
			
			$m_cp = "JJJ"; // check with shym
			$m_telcoregion = "Maxis"; // check with shym
			print_r('<br>channel_id for '.$syqic_movie_id.' is ------>'.$m_channelid);
			
			
			
			if(empty($m_channelid))
			{
				print_r("Empty Channel ID. So Skipping.....");
				logToFile($logfilename, $m_channelid, 'Failure - Empty Channel ID');
				
				continue;
			}
			
					
			/// select the properties
			$vodblk1 = mysqli_query($con, "SELECT `syqic_movie_id`, `channel_dir`,	`movie_title`, 	`bundle_id`,
					`image_thumb`, 	`abr_url`, 	`rtsp_low_bitrate`, `rtsp_high_bitrate` , `channel_id`
					FROM `vod_tbl` WHERE `syqic_movie_id` = '$syqic_movie_id' ");
					$vod_result = mysqli_fetch_array($vodblk1);
						
					$m_syqicmovieid = 	$vod_result[0];
					//$m_subcatid= 		$vod_result[1];
			$m_title = 			$vod_result[2];
			$m_title = mysqli_real_escape_string($con,$m_title);
				
			//$m_bundleid = 		$vod_result[3];
				
				
				
			$m_imagethumb = 	$vod_result[4];
			$m_imagethumb = mysqli_real_escape_string($con,$m_imagethumb);
			$m_abr = 			$vod_result[5];
			$m_rtsp1 = 			$vod_result[6];
			$m_rtsp2 = 			$vod_result[7];
			//$m_subcatid = 		$vod_result[8];
			
			print_r($m_imagethumb);
			
			
			
			
			
			// block2
			$vodblk2 = mysqli_query($con, "SELECT `director`, `cast`, `genre`, `subtitle`, `category`, `duration`
					FROM `vod_details_tbl` WHERE `syqic_movie_id` = '$syqic_movie_id' ");
					$vod_result2 = mysqli_fetch_array($vodblk2);
					$m_director = 		$vod_result2[0];
					$m_cast = 			$vod_result2[1];
					$m_genre = 			$vod_result2[2];
					$m_subtitle = 		$vod_result2[3];
					$m_category = 		$vod_result2[4];
					$m_duration = 		$vod_result2[5];
					$m_director = mysqli_real_escape_string($con,$m_director);
					$m_cast = mysqli_real_escape_string($con,$m_cast);
					$m_genre = mysqli_real_escape_string($con,$m_genre);
					$m_subtitle = mysqli_real_escape_string($con,$m_subtitle);
					$m_duration = mysqli_real_escape_string($con,$m_duration);
						
					echo "block 2: " . $m_category . "\n";
					
					
					
					
					
					/// block 3
					//confirm with shym
					$vodblk3 = mysqli_query($con, "SELECT `language`, `description`
							FROM `vod_xltn_tbl` WHERE `syqic_movie_id` = '$syqic_movie_id' and language = 'en'");
							$vod_result3 = mysqli_fetch_array($vodblk3);
							$m_desc = 			$vod_result3[1];
							$m_language = 		$vod_result3[0];
							$m_desc = mysqli_real_escape_string($con,$m_desc);
							$m_language = mysqli_real_escape_string($con,$m_language);
							echo "block 3: " . $m_language . "\n";
							
							
							
							$movie_insert_query = "INSERT INTO movies (
							category_id,
							channel_id,
							sub_category_id,
							title,
							type,
							description,
							image_thumb,
							director,
							cast,
							genre,
							tag,
							language,
							subtitle,
							credit,
							duration,
							cp,
							telco_region,
							abr,
							rtsp_1,
							rtsp_2,
							bundle_id)
							VALUES (
							'$m_catid',
							'$m_channelid',
							'$m_syqicmovieid',
							'$m_title',
							'$m_category',
							'$m_desc',
							'$m_imagethumb',
							'$m_director',
							'$m_cast',
							'$m_genre',
							'$m_tag',
							'$m_language',
							'$m_subtitle',
							'$m_credit',
							'$m_duration',
							'$m_cp',
							'$m_telcoregion',
							'$m_abr',
							'$m_rtsp1',
							'$m_rtsp2',
							'$m_bundleid' )";

							
							
							
							print_r('<br>'.$movie_insert_query);
							/// insert into table
							mysqli_query( $con2,$movie_insert_query);
							logToFile($logfilename, $m_channelid, 'Success');
								
							
							
							
							resetVars();
								
		}
	
	
		mysqli_free_result($id_result); // Free up the resources.
	
	}
	






	function resetVars()
	{
		echo "<br>resetting the movie blok.... \n";
		$m_catid = "-";
		$m_channelid = "-";
		$m_subcatid = "-";
		$m_syqicmovieid = "-";
		$m_title = "-";
		$m_type = "-";
		$m_desc = "-";
		$m_imagethumb = "-";
		$m_director = "-";
		$m_cast = "-";
		$m_genre = "-";
		$m_tag = "-";
		$m_language = "-";
		$m_subtitle = "-";
		$m_credit = "-";
		$m_duration = "-";
		$m_cp = "-";
		$m_telcoregion = "-";
		$m_abr = "-";
		$m_rtsp1 = "-";
		$m_rtsp2 = "-";
		$m_createdby = "-";
		$m_bundleid = "-";
	}


///close db
mysqli_close($con);
mysqli_close($con2);

?>
