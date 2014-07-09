<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$document = JFactory::getDocument();
$modulePath = JURI::base() . 'modules/mod_phz_latest_message_for_facebook/';

$document->addScript($modulePath.'tmpl/js/scripts.js');
$document->addScript($modulePath.'tmpl/js/Autolinker.min.js');


$document->addStyleSheet($modulePath.'tmpl/css/stylesheet.css');
$scripts = array_keys($document->_scripts);
$scriptFound = false;

foreach($scripts as $script) {
    if(strpos($script,'jquery') !== false) {
        $scriptFound = true;
        break;
    }
}
 if(!$scriptFound) {
     $document->addScript("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
 }
?>

<div class="facebook-post">

<?php
foreach($postData->data as $item){
    if( isset($item->message) || isset($item->description) ) {
        ?>
        <a href="http://facebook.com/<?php echo $page_id=$params->get('page_id'); ?>"><img class="facebook-logo" alt="facebook logo" src="<?php echo $modulePath . "tmpl/images/facebookx.png"; ?>"/></a>
        <a href="http://facebook.com/<?php echo $page_id=$params->get('page_id'); ?>">
          <p class="facebook-username"><?php echo $item->from->name; ?></p>
        </a>
        <div class="fb-button-jemma"><div class="fb-like" data-href="http://facebook.com/<?php echo $page_id=$params->get('page_id'); ?>" data-layout="button_count" data-colorscheme="dark" data-action="like" data-show-faces="false" data-share="false"></div><button><?php echo JText::_('MOD_PHZ_LATEST_MESSAGE_FOR_FACEBOOK_JOIN_US')?></button></div>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/fi_FI/sdk.js#xfbml=1&appId=579339135497873&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <p class="message"><?php
          if( isset($item->message) ){
            echo $item->message;
          } else {
            echo $item->description;
          }
        ?>
        </p>
        <div class="name-picture">
          <a href="http://facebook.com/<?php echo $page_id=$params->get('page_id'); ?>">
            <img class="profile-picture" alt="logo" src="https://graph.facebook.com/<?php echo $item->from->id;?>/picture"/>
          </a>
          <a href="http://facebook.com/<?php echo $page_id=$params->get('page_id'); ?>">
            <p class="name"><?php echo $item->from->name;?></p>
          </a>
        </div>
        <?php break;
    }
  }
?>


</div>
