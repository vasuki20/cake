$htmlBody = <<<END
<form method="GET">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
   <div>
   Enter date ->
   From: <input type = "date" name ="start" >
   To: <input type = "date" name ="end" >
   </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <input type="submit" value="Search">
</form>
END;


<?php
App::uses('AppController', 'Controller', 'Configure');

/**
 * Consumptions Controller
 *
 * @property Consumption $Consumption
 */
class SearchController extends AppController {



// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($_GET['q'] && $_GET['maxResults'] && $_GET['start'] && $_GET['end'] ) {
  // Call set_include_path() as needed to point to your client library.
require_once 'C:\xampp\php\google-api-php-client-master\src\Google\Client.php';
require_once 'C:\xampp\php\google-api-php-client-master\src\Google\Service\YouTube.php';

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google Developers Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyAcWCerpP1AerBZmGKF13_-qNPX_QOWK34';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
      ''	   		
      
    ));
  //  print_r($searchResponse);

    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['videoId']);
          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['channelId']);
          break;
        case 'youtube#playlist':
          $playlists .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }

    $htmlBody .= <<<END
    <h3>Videos</h3>
    <ul>$videos</ul>
    <h3>Channels</h3>
    <ul>$channels</ul>
    <h3>Playlists</h3>
    <ul>$playlists</ul>
END;
   }catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
    
  </head>
  <body>
    <?=$htmlBody?>
  </body>
</html>



