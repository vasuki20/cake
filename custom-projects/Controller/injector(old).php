<?php
include 'Logger.php';

/// starts the db
ini_set ( 'max_execution_time', 600 );

// parsing configuration file
$ini_array = parse_ini_file ( "configuration.ini" );

$db = $ini_array ['db'];
$logfilename = $ini_array ['logfilename_inje_' . $db];
$host = $ini_array ['host_' . $db]; // mobile.e1.sg server :
$username = $ini_array ['username_' . $db];
$password = $ini_array ['password_' . $db];
$db_name = $ini_array ['db_name_' . $db];

// $host="localhost:3306"; // mobile.e1.sg server :
// $username="root";
// $password="9944200629.a";
// $db_name="moviedata";

print_r ( $host );

echo 'Connection in progress...';
$con = @mysqli_connect ( $host, $username, $password, $db_name ) or die ( 'Could not connect to MySQL: ' . mysqli_connect_error () );
$con2 = @mysqli_connect ( $host, $username, $password, 'yoonic' ) or die ( 'Could not connect to MySQL: ' . mysqli_connect_error () );
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
	$m_rtsp3 = "-";
	$m_createdby = "-";
	$m_bundleid = "-";
	$m_published="-";


	// Check connection
	if (mysqli_connect_errno())
	  {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	else
	{	
		///initial reset
		/*
		/// grabs all ID's associated with selected channels
		$channel_dir = '14.IndoTV';
		///set the telco
		$m_bundleid = 1; //1 = free, 2 = basic, 3 = premium
		$m_catid = 6; //channels_category
		$m_cp = "JJJ";
		$m_telcoregion = "Maxis";
		$m_channelid = 1; //channels table
		*/
		
		//////
		
		$channel_result = mysqli_query($con2, "SELECT id, bundleid, category_id, syqic_channel FROM channels ");
		$count1=0;
		$count2=0;
		while ( $row = mysqli_fetch_row ($channel_result ))
		{
			$count1++;
// 			//print_r($row);
			$channel_dir = $row[3];
			$m_bundleid =  $row[1];
			$m_cp = "JJJ";
			$m_telcoregion = "Maxis";
			$m_catid =  $row[2];
			$m_channelid =  $row[0];
			
				
			//echo "Current Channel: " . $channel_dir . "\n";
				
			///initial reset
				echo 'before while<br>';
				$query_temp="SELECT `syqic_movie_id` FROM `vod_tbl` WHERE `channel_dir` = '$channel_dir' ";
				print_r($query_temp);
			$id_results = mysqli_query($con,$query_temp );
			while ( $row=mysqli_fetch_row($id_results ) )
			{
				
				
				//echo "Current movie id: " . $row[0] . "\n";
			
			
				/// select the properties
				$vodblk1 = mysqli_query($con, "SELECT `syqic_movie_id`, `channel_dir`,	`movie_title`, 	`bundle_id`,
						`image_thumb`, 	`abr_url`, 	`rtsp_high_bitrate`,`rtsp_med_bitrate`, `rtsp_low_bitrate` ,`published`, `channel_id`
						FROM `vod_tbl` WHERE `syqic_movie_id` = '$row[0]' ");
						$vod_result = mysqli_fetch_array($vodblk1);
			
						$m_syqicmovieid = 	$vod_result[0];
						//$m_subcatid= 		$vod_result[1];
				$m_title = 					$vod_result[2];
				$m_title =	mysqli_real_escape_string ( $con, $m_title );
				
				
				
				$query_dup="SELECT count(*) FROM `movies` WHERE `channel_id` = '$m_channelid' and `title` = '$m_title' and `published` = 0";
// 				print_r($query_dup);
				$mov_dup_res = mysqli_query($con2, $query_dup) or die(mysqli_error($con2));;
				while ( $row_dup=mysqli_fetch_row($mov_dup_res ))
				{
					if($row_dup[0]==0)
					{
						echo "<br>---Not Duplicate &#2433; ----$row_dup[0]";
						//$m_bundleid = 		$vod_result[3];
						$count2++;
						
							
							
						$m_imagethumb = 	$vod_result[4];
						$m_imagethumb =mysqli_real_escape_string ( $con, $m_imagethumb);
						$m_abr = 			$vod_result[5];
						$m_rtsp1 = 			$vod_result[6];
						$m_rtsp2 = 			$vod_result[7];
						$m_rtsp3 =          $vod_result[8];
						$m_published = 		$vod_result[9];
						//$m_subcatid = 		$vod_result[8];
						//$m_subcatid = 1;
						//echo "block 1: " . $m_title . "\n";
							
						/// block2
						$vodblk2 = mysqli_query($con, "SELECT `director`, `cast`, `genre`, `subtitle`, `category`, `duration`
								FROM `vod_details_tbl` WHERE `syqic_movie_id` = '$row[0]' ");
						$vod_result2 = mysqli_fetch_array($vodblk2);
						$m_director = 		$vod_result2[0];
						$m_cast = 			$vod_result2[1];
						$m_genre = 			$vod_result2[2];
						$m_subtitle = 		$vod_result2[3];
						$m_category = 		$vod_result2[4];
						$m_duration = 		$vod_result2[5];
						$m_director = mysqli_real_escape_string ( $con, $m_director);
						$m_cast = mysqli_real_escape_string ( $con, $m_cast);
						$m_genre = mysqli_real_escape_string ( $con, $m_genre);
						$m_subtitle = mysqli_real_escape_string ( $con, $m_subtitle);
						$m_duration = mysqli_real_escape_string ( $con, $m_duration);
							
						//echo "block 2: " . $m_category . "\n";
							
							
						/// block 3
						$vodblk3 = mysqli_query($con, "SELECT `language`, `description`
								FROM `vod_xltn_tbl` WHERE `syqic_movie_id` = '$row[0]' LIMIT 1");
						$vod_result3 = mysqli_fetch_array($vodblk3);
						$m_desc = 			$vod_result3[1];
						$m_language = 		$vod_result3[0];
						$m_desc = mysqli_real_escape_string ( $con, $m_desc);
						$m_language = mysqli_real_escape_string ( $con, $m_language);
						//echo "block 3: " . $m_language . "\n";
						echo  "<br>";
						echo '----';
						$m_abr=str_replace('\'', '\\\'', $m_abr);
						$m_rtsp1=str_replace('\'', '\\\'', $m_rtsp1);
						$m_rtsp2=str_replace('\'', '\\\'', $m_rtsp2);
						$m_rtsp3=str_replace('\'', '\\\'', $m_rtsp3);
						//echo "rtsp 1: " . $m_rtsp1 ."\n";
						//echo "rtsp 3: ". $m_rtsp3 . "\n";
						
						$query="INSERT INTO movies (
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
						rtsp_3,
						bundle_id,
published)
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
						'$m_rtsp3',
						'$m_rtsp2',
						'$m_rtsp1',
						'$m_bundleid',
'$m_published' )";
						//print_r($query);
// 						echo "Query : " . $query . "\n";
						// 				/// insert into table
						mysqli_query( $con2,$query) or die(mysqli_error($con2));
							
						echo "Title: " . $m_title . "\n";	
							
						// 				$i++;
						/// internal while
						logToFile ( $logfilename, $m_channelid, 'Success - syqic_movie_id successfully inserted' );
							
					}
					
					else
					{
						echo "<br>---Duplicate ; ---$row_dup[0]";
						
						logToFile ( $logfilename, $m_channelid, 'Duplicate Id--Skipped' );
						
					}
					
				}
			
									
			}
				// Free result set
				mysqli_free_result($id_results);
					
				/// channelrow while
			
		}
		
		print_r('<br>Inner Count->'.$count1);
		print_r('<br>Outer Count->'.$count2);
		
		///////
		
	}

	


//logToFile ( $logfilename, $syqic_channel, 'Success - syqic_channel_id successfully inserted' );
///close db
mysqli_close($con);
mysqli_close($con2);


?>
