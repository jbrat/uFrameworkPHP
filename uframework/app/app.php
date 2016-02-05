<?php

require __DIR__ . '/../vendor/autoload.php';

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
   
 
    $memory = new DBFinder();
    $statuses = $memory->findAll();

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

/////////////////////////////////////////////////////////////////////////////////////////////////
//                          AUTHENTIFICATION                                                   //
/////////////////////////////////////////////////////////////////////////////////////////////////


$app->get('/login', function (Request $request) use ($app) {
    return $app->render('login.php');
});

$app->get('/register', function (Request $request) use ($app) {
    return $app->render('register.php');
});

$app->post('/login', function (Request $request) use ($app) {
    
});

$app->post('/register', function (Request $request) use ($app) {
    
});


/////////////////////////////////////////////////////////////////////////////////////////////////
//                          FIREWALL                                                           //
/////////////////////////////////////////////////////////////////////////////////////////////////


$app->addListener('process.before', function(Request $req) use ($app) {
    session_start();

    $allowed = [
        '/login' => [ Request::GET, Request::POST ],
        '/statuses/(\d+)' => [ Request::GET ],
        '/statuses' => [ Request::GET, Request::POST ],
        '/register' => [ Request::GET, Request::POST ],
        '/' => [ Request::GET ],
    ];

    if (isset($_SESSION['is_authenticated'])
        && true === $_SESSION['is_authenticated']) {
        return;
    }

    foreach ($allowed as $pattern => $methods) {
        if (preg_match(sprintf('#^%s$#', $pattern), $req->getUri())
            && in_array($req->getMethod(), $methods)) {
            return;
        }
    }
    
    switch ($req->guessBestFormat()) {
        case 'json':
            throw new HttpException(401);
    }
    
    return $app->redirect('/login');
});

return $app;
