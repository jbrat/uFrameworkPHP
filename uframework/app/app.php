<?php


require __DIR__ . '/../autoload.php';

use Model\InMemoryFinder;
use \Exception\HttpException;
use \Model\JsonFinder;
use Http\Request;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);



/**
 * Index
 */
$app->get('/', function () use ($app) {
    return $app->render('index.php');
});

$app->get('/status', function (Request $request) use ($app) {
    
    $memory = new JsonFinder();
    $data = $memory->findAll();
    
    return $app->render("status.php",array('data'=>$data));
});

$app->get('/status/(\d+)', function (Request $request, $id) use ($app) {
    $memory = new JsonFinder();
    $status = $memory->findOneById($id);
    
    if(!isset($status)) {
        throw new HttpException(404,"Erreur de la recherche d'un status");
    }    
    return $app->render("unStatus.php",array('status'=>$status));
});

$app->get('/statuses', function (Request $request) use ($app) {
    return $app->render("statuses.php");
});

$app->post('/statuses', function (Request $request) use ($app) {
    
    $message = $request->getParameter('message');
    $user = $request->getParameter('username');
   
    $memory = new JsonFinder();
    $memory->writeStatus($user, $message);
    
    $app->redirect('/statuses');  
    
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app) {
   $memory = new JsonFinder();
   if($memory->deleteStatus($id)==-1) {
       throw new HttpException(404, "Object doesn't exist");
   }
   $app->redirect('/statuses');
});


return $app;
