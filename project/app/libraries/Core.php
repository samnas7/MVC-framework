<?php
/* 
*App Core Class 
*Create Url & loads core controller
* URL FORMAT /contoller/method/params
*/

class Core{
    protected $currentController='Pages';
    protected $currentMethod='index';
    protected $params=[];

    public function __construct()
    {
        $url = $this->getUrl();
        
        //print_r($url);

        //look in controller for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]). '.php' ) ) {
            //if exists, set as controller 
            $this->currentController=ucwords($url[0]);
            
        }
        //unset 0 index
         unset($url[0]);
        //Require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';
        //Inststantiate controller class
        $this->currentController = new $this->currentController;

        //Check for second part of url
        if (isset($url[1])) {
            #check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                
        //unset 0 index
         unset($url[1]);
            }
        }
        ///get param
        $this->params = $url ? array_values($url) : [];
        //print_r($this->params);
        //Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }
    public function getUrl(){
        if(isset($_GET['url']) ){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
    
}