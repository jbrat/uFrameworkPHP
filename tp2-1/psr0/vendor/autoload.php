<?php

function autoload($className){
    
	$cacheFile = __DIR__ . '/cache.php';
        $map = require $cacheFile; 
	 

	if(in_array($className, $map)){
		throw new Exception("La classe a déjà été appelée");
	}
	else{
		$autoload_namespace =  __DIR__ . '/' . str_replace('\\','/',$className) . '.php'; 
		$autoload_underscore = __DIR__ . '/' . str_replace('_','/',$className) . '.php'; 
               
		if(file_exists($autoload_namespace)){
                        $map[$className] = $autoload_namespace;
			require_once $autoload_namespace;			
		}
		elseif(file_exists($autoload_underscore)){
                        $map[$className] = $autoload_underscore;
			require_once $autoload_underscore;
		}
		else{
			throw new Exception("Le fichier n'a pas été trouvé");
		}
	}
        write_cache($cacheFile, $map);
}

spl_autoload_register("autoload");

function write_cache($cacheFile,$cacheMap){

file_put_contents($cacheFile, sprintf(<<<CACHE
<?php

return %s;

CACHE
   	, var_export($cacheMap,true)
));

}
