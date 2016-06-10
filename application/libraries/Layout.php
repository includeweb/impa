<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout{

    var $obj;
    var $layout;
    var $sidebar;
    var $folder;

    function Layout($layout = "layout"){
        $this->obj =& get_instance();
        $this->layout = $layout;
        $this->sidebar = false;
        $this->folder = '';
    }

    function setLayout($layout){
      $this->layout = $layout;
    }

    function setSidebar($sidebar,$active){
        $this->sidebar = $sidebar;

    }

    function setFolder($folder){
      $this->folder = $folder;
    }

    
   function view($view, $data=null, $return=false){
        $view = $this->folder . '/' . $view;
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view,$data,true);
        $loadedData['content_for_sidebar'] = $this->sidebar;

        if($data != null){
             foreach ($data as $key => $value) {
                $loadedData[$key] = $value;
            }
        }
        

        if($this->sidebar != false){
             $loadedData['content_for_sidebar'] = $this->obj->load->view($this->sidebar,array(),true);
        }

        if($return){
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        }else{
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }


   


}
?>