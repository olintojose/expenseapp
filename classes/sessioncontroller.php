<?php 

class SessionController extends Controller{

    private $userSession;
    private $username;
    private $userid;

    private $session;
    private $sites;

    private $user;

    function __construct(){

        parent::__construct();
        $this->init();

    }
    function init(){
        $this->session = new Session();

        $json = $this->getJSONFileConfig();
        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];
        $this->validateSession();

    }
    private function getJSONFileConfig(){
        $string = file_get_contents('Config/access.json');
        $json = json_decode($string, true);
        return $json;
    }
    public function validateSession(){
        error_log('SESSIONCONTROLLER::validateSession');
        //Existe la sesion
        if ($this->existsSession()){
            $role = $this->getUserSessionData()->getRole();

        // si la pagina a ingresar es publica
        if($this->isPublic()){

        }

        }else{
            //no esiste la sesion
        }
    }
    function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();
        if ($userid) return true;

        return false;
    }
    function getUserSessionData(){
        $id =  $this->userid;
        $this->user = new UserModel();
        $this->user->get($id);
        error_log('SESSIONCONTROLLER::getUserSessionData -> ' . $this->user->getUsername());
        return $this->user;
    }
    function isPublic(){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);
        for($i = 0; $i < sizeof($this->sites; $i++))
    }

    function getCurrentPage(){
        $actuakLink= trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actuakLink);
        error_log('SESSIONCONTROLLER::getCurrentPage -> ' . $url[2]);
        return $url[2];
    }
    
}

?>