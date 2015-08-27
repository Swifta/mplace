<?php if(defined('SYSPATH') or die("No direct access allowed"));?>

<?php 
	class VAR_DUMP_Controller extends Website_Controller{
		
		public function __construct(){
			parent::__construct();
			
			$this->session = Session::instance();
			
			
		}
		
		function index(){
			 
			 
			 
			/*echo '<?xml version="1.0" encoding="utf-8"?>
				<branches>
					<branch>
						<branch-name>Aba</branch-name>
						<branch-no>1</branch-no>
					</branch>
				</branches>
			
			';
			
			exit(0);*/
			
           /* $ret = array();
            $arg = array();
            $arg['userName'] = ZENITH_SOAP_USER;
            $arg['Pwd'] = ZENITH_SOAP_PWD;
            $soap = new SoapClient(ZENITH_SOAP_URL);
            $fun_resp_branch = $soap->getBranchList($arg);
			
			
            foreach($fun_resp_branch->getBranchListResult->Branches as $value){
                $ret[$value->BranchNo] = $value->BranchName;
            }
			var_dump($ret);
			exit(0);
            return $ret;*/
			
			
			
			/*echo '<?xml version="1.0" encoding="utf-8"?>
				<branches>
					<branch>
						<branch-name>Aba</branch-name>
						<branch-no>1</branch-no>
					</branch>
					
					<branch>
						<branch-name>Zeba</branch-name>
						<branch-no>2</branch-no>
					</branch>
					
					<branch>
						<branch-name>Maka</branch-name>
						<branch-no>3</branch-no>
					</branch>
					
					<branch>
						<branch-name>Sema</branch-name>
						<branch-no>4</branch-no>
					</branch>
					
					
				</branches>
			
			';*/
			
			
            /*$arg = array();
            $arg['userName'] = ZENITH_SOAP_USER;
            $arg['Pwd'] = ZENITH_SOAP_PWD;
            $soap = new SoapClient(ZENITH_SOAP_URL);
            $fun_resp_branch = $soap->getBranchList($arg);
			
			echo '<?xml version="1.0" encoding="utf-8"?>
				<branches>';
            foreach($fun_resp_branch->getBranchListResult->Branches as $branch){
				echo "<branch>
						<branch-name>".$branch->BranchName."</branch-name>
						<branch-no>".$branch->BranchNo."</branch-no>
					</branch>";
            }
			
			echo '</branches>';*/
			
			
			  
   		/*$arg = array();
		$arg['userName'] = ZENITH_SOAP_USER;
        $arg['Pwd'] = ZENITH_SOAP_PWD;
		$soap = new SoapClient(ZENITH_SOAP_URL);
		$fun_resp_branch = $soap->getBranchList($arg);
		$branches = $fun_resp_branch->getBranchListResult->Branches;
		
		//foreach($branches as $b){
		?>
			alert(<?php echo $branches[0]->BranchName;?>);
		<?php // }*/
		
		
		$ret = array();
            $arg = array();
            $arg['userName'] = ZENITH_SOAP_USER;
            $arg['Pwd'] = ZENITH_SOAP_PWD;
            $soap = new SoapClient(ZENITH_SOAP_URL);
            $fun_resp_class = $soap->getAccountClass($arg);
            foreach($fun_resp_class->getAccountClassResult->ClassCode as $value){
                $ret[$value->ClassCodes] = $value->ClassName;
            }
   
  			var_dump($ret);
			
			exit(0);
           
        
        }
			
		
	
	}

?>