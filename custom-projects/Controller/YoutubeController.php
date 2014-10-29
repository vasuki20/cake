<?php

App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class YoutubeController extends AppController {

    public function getDetails() {

        $this->autoRender = false;
        // For the video >>> youtube.com/watch?v=37l11UzbvvA
// Video id = 37l11UzbvvA;

        $vid = "oANQ1TIh2tY";

// set video data feed URL

        $feedURL = 'http://gdata.youtube.com/feeds/api/videos/' . $vid;
        
       // print_r($feedURL);

// read feed into SimpleXML object

        $entry = simplexml_load_file($feedURL);
      //  print_r($entry);
        $video = $this->parseVideoEntry($entry);
      //  print_r($video);

        echo $video->title;
        echo '<br>';
        echo $video->thumbnailURL;
        echo '<br>';
        echo $video-> watchURL;
    }

    

// function to parse a video <entry>
private function parseVideoEntry($entry) {      
  $obj= new stdClass;

  // get author name and feed URL
  $obj->author = $entry->author->name;
  $obj->authorURL = $entry->author->uri;

  // get nodes in media: namespace for media information
  $media = $entry->children('http://search.yahoo.com/mrss/');
  $obj->title = $media->group->title;
  $obj->description = $media->group->description;

  // get video player URL
  $attrs = $media->group->player->attributes();
  $obj->watchURL = $attrs['url']; 

  // get video thumbnail
  $attrs = $media->group->thumbnail[0]->attributes();
  $obj->thumbnailURL = $attrs['url']; 

  // get <yt:duration> node for video length
  $yt = $media->children('http://gdata.youtube.com/schemas/2007');
  $attrs = $yt->duration->attributes();
  $obj->length = $attrs['seconds']; 

  // get <yt:stats> node for viewer statistics
  $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
  $attrs = $yt->statistics->attributes();
  $obj->viewCount = $attrs['viewCount']; 

  // get <gd:rating> node for video ratings
  $gd = $entry->children('http://schemas.google.com/g/2005'); 
  if ($gd->rating) { 
    $attrs = $gd->rating->attributes();
    $obj->rating = $attrs['average']; 
  } else {
    $obj->rating = 0;         
  }

  // get <gd:comments> node for video comments
  $gd = $entry->children('http://schemas.google.com/g/2005');
  if ($gd->comments->feedLink) { 
    $attrs = $gd->comments->feedLink->attributes();
    $obj->commentsURL = $attrs['href']; 
    $obj->commentsCount = $attrs['countHint']; 
  }

  // get feed URL for video responses
  $entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
  $nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/
  schemas/2007#video.responses']"); 
  if (count($nodeset) > 0) {
    $obj->responsesURL = $nodeset[0]['href'];      
  }

  // get feed URL for related videos
  $entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
  $nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/
  schemas/2007#video.related']"); 
  if (count($nodeset) > 0) {
    $obj->relatedURL = $nodeset[0]['href'];      
  }

  // return object to caller  
  return $obj;      
} 
}

?>