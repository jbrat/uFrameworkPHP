<?php

require __DIR__ . '/../vendor/autoload.php';

use \Model\JsonFinder;
use Http\Request;
use Http\Response;
use \Model\DBFinder;

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

$app->get('/statuses', function (Request $request) use ($app) {
    $memory = new JsonFinder();
    $data = $memory->findAll();

    if(count($data)==0) {
        $response = new Response("",204);
        $response->send();
    }
    if(Request::guessBestFormat()=="json") {
        $response = new Response(json_encode($data),200);
        $response->send();
        return;
    }
    
    return $app->render("status.php",array('data'=>$data));
});

$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app) {

    $memory = new JsonFinder();
    $status = $memory->findOneById($id);
    
    if(!isset($status)) { 
        $response = new Response("Object doesn't exist",404);
        $response->send();
        return;    
    }
    if (Request::guessBestFormat()=='json') {
        $response = new Response(json_encode($status),200);
        $response->send();
        return;
    }
       
    return $app->render("unStatus.php",array('status'=>$status));
});

$app->get('/statusesForm', function (Request $request) use ($app) {
    return $app->render("statuses.php");
});

$app->post('/statuses', function (Request $request) use ($app) {

    $message = $request->getParameter('message');
    $user = $request->getParameter('username');
    
    $memory = new JsonFinder();
    $memory->writeStatus($user, $message);
    
    $response = new Response("",201);
    $response->send();
    
    $app->redirect('/statuses',201);  
    
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app) {

    $memory = new JsonFinder();
    if ($memory->deleteStatus($id)==-1) {
       $response = new Response("Object doesn't exist",404);
       $response->send();
       return;
    }
   $app->redirect('/status');
});

$app->get('/database', function (Request $request) use ($app) {
    $memory = new DBFinder();
    $memory->findAll();
});


return $app;
