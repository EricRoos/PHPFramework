<?php
	
	abstract class Router{
		protected $url_map;
		public function __construct(){
			$this->url_map = array();
		}
		
		public function allow_url($request_type,$url,$controller){
			$this->url_map[$request_type][$url] = $controller;
		}
	
		private function convert_to_regex($url){
			$tokens = explode('/',$url);
			for($i = 0 ; $i < count($tokens) ; $i++){
				if($tokens[$i]{0} == ':' && strlen($tokens[$i]) > 1){
					$tokens[$i] = '([a-zA-Z0-9]*)';
				}
			}
			$ret = "\\";
			for($i = 0 ; $i < count($tokens) ; $i++){
					$ret .= '/'.$tokens[$i];
			}
			return $ret;
		}
	
		public function set_params($url,$matches){
			$params = array();
			$tokens = explode('/',$url);
			$matches_itr = 1;
			for($i = 0 ; $i < count($tokens) ; $i++){
				$token = $tokens[$i];
				$token_length = strlen($token);
				if($token_length > 0){
					if($token{0} == ':' && $token_length > 1){
						$param_name = substr($token,1,$token_length-1);
						$params[$param_name] = $matches[$matches_itr];
					}
				}
			}
			$_GET['params'] = $params;
		}
		public function get_method($request_type,$url){
			foreach(array_keys($this->url_map[$request_type]) as $pattern){
				$regex = $this->convert_to_regex($pattern);
				if(preg_match('/^'.$regex.'$/',$url,$matches)){		
					$this->set_params($pattern,$matches);
					return $this->url_map[$request_type][$pattern];
				}
			}
			return null;		
		}
		public function get_default_index($model){
			return $model;
		}

		public function get_default_show($model){
			return $this->get_default_index($model).'\/:id';
		}
		public function get_default_delete($model){
			return $this->get_default_show($model);
		}

		public function get_default_create($model){
			return $this->get_default_index($model);
		}

		public function get_default_new($model){
			return $this->get_default_index($model.'\/new');
		}
		
		public abstract function define_get();
		public abstract function define_post();
		public abstract	function define_put();
		public abstract function define_delete();

		public function define_resource($model,$controllers){
			foreach($controllers as $controller){
				switch($controller){
					case 'index':
						$this->allow_url('GET',$this->get_default_index($model),'index');
					break;

					case 'new':
						$this->allow_url('GET',$this->get_default_new($model),'new');
					break;

					case 'show':
						$this->allow_url('GET',$this->get_default_show($model),'show');
					break;
	
					case 'create':
						$this->allow_url('POST',$this->get_default_create($model),'create');
					break;
				}
			}
		}
	}
	require_once('user_router.php');	
	$router = new UserRouter();
	$request_type = $_SERVER['REQUEST_METHOD'];
	switch($request_type){
		case 'PUT':
			$router->define_put();	
		break;

		case 'POST':
			$router->define_post();
		break;

		case 'GET':
			$router->define_get();
		break;
	}

	$path = $_SERVER['REQUEST_URI'];
	$uri_tokens = explode('/',$path);
	$requested_model = $uri_tokens[1];
	$controller = '/app/controllers/application_controller.php';
	$_GET['controller'] = $requested_model;
	$_GET['method'] = $router->get_method($request_type,$path);
	require_once($_SERVER['DOCUMENT_ROOT'].$controller);
?>
