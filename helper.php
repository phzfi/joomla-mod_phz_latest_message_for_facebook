<?php
/**
 * Helper class for Hello World! module
 *
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modFacebookPostHelper
{
    

    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */
    public static function getPost( $params )
    {
        $access_token=$params->get('access_token');
        $page_id=$params->get('page_id');
        $memcache = new Memcache;
        $memcache->connect('localhost', 11211) or die ("Could not connect");
        $cache = $memcache->get('facebook-post-'.$page_id);
        if( !$cache){
         $data = file_get_contents('https://graph.facebook.com/'.$page_id.'/posts?access_token='.$access_token);
         $memcache->add('facebook-post-'.$page_id, $data, 0, 3600);
         return json_decode($data);   
        } else {
            return json_decode($cache);
        }

    }
}
?>