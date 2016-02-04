<?php

require __DIR__ . '/../vendor/autoload.php';

use \Model\JsonFinder;
use Http\Request;
use Http\Response;
use \Model\DBFinder;
use Tools\Verification;

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
    $limit = $request->getParameter('limit');
    $orderby = $request->getParameter('orderby');
 
    $memory = new DBFinder();
    $statuses = $memory->findAll($limit,$orderby);

    if(count($statuses)==0) {
        $response = new Response("",204);
        $response->send();
        return;
    }
    if(Request::guessBestFormat()=="json") {
        $response = new Response(json_encode($statuses),200);
        $response->send();
        return;
    }
    return $app->render("status.php",array('statuses'=>$statuses));
});

$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app) {
    
    if(!Verification::checkInteger($id)) {
        $response = new Response("Error with the object ID",400);
        $response->send();
        return;    
    }
    $memory = new DBFinder();
    $status = $memory->findOneById($id);
    
    if(!isset($status)) { 
        $response = new Response("Object doesn't exist",416);
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
    
    $memory = new DBFinder();
    if(!isset($user) || !isset($message)) {
        $response = new Response("Error parameters",400);
    }
    $memory->addStatus($user,$message);
    $response = new Response("Status add correctly",201);
    $response->send();
    
    $app->redirect('/statuses',201);  
    
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app) {

    if(!Verification::checkInteger($id)) {
        $response = new Response("Error with the object ID",400);
        $response->send();
        return;    
    }
    
    $memory = new DBFinder();
    if ($memory->deleteStatus($id)==-1) {
       $response = new Response("Object doesn't exist",416);
       $response->send();
       return;
    }
   $app->redirect('/statuses');
});

$app->get('/database', function (Request $request) use ($app) {
    $memory = new DBFinder();
    $memory->findAll();
});


return $app;
