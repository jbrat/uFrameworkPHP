<?php

require __DIR__ . '/../vendor/autoload.php';

use Http\Request;
use Http\Response;
use Model\StatusFinder;
use \Model\UserFinder;
use Tools\Verification;
use \Persistance\UserMapper;
use Persistance\StatusMapper;
use DataBase\DataBase;
use Model\Status;
use Model\User;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

/**
 * Mapper et Finder
 */
$conn = new DataBase();
$userMapper = new UserMapper($conn);
$statusMapper = new StatusMapper($conn);

$statusFinder = new StatusFinder($conn);
$userFinder = new UserFinder($conn);


/**
 * Index
 */
$app->get('/', function () use ($app) {
    //return $app->render('index.php');
    $app->redirect('/statuses');
});

$app->get('/statuses', function (Request $request) use ($app,$statusFinder) {
  
    $statuses = $statusFinder->findAll();
    
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
    if($_SESSION['login']) {
        $login = $_SESSION['login'];
    } else {
        $login = "Anonymous";
    }
    
    return $app->render("status.php",array('statuses'   => $statuses,
                                           'login'      => $login ));
});

$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app,$statusFinder) {
    
    if(!Verification::checkInteger($id)) {
        $response = new Response("Error with the object ID",400);
        $response->send();
        return;    
    }
    $status = $statusFinder->findOneById($id);
    
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
    
    return $app->render("statusesForm.php",array('user'     => $_SESSION['login'],
                                                 'erreur'   => '',
                                                 'message'  => ''));
});

$app->post('/statuses', function (Request $request) use ($app,$statusMapper) {

    $message = $request->getParameter('message');
    $user = $request->getParameter('username'); 
    
    if(!isset($user) || !isset($message)) {
        $erreur = "Empty parameters";
        $response = new Response($erreur,400);
        $response->send();
        return  $app->render('statusesForm.php',array('user'     => $user,
                                                     'message'  => $message,
                                                     'error'    => $erreur));
    }
    
    if(!Verification::checkTweetMessage($message)) {
        $erreur = "The message size is larger than 140";
        $response = new Response($erreur,400);
        $response->send();
        return $app->render('statusesForm.php',array('user'     => $user,
                                                     'message'  => $message,
                                                     'error'    => $erreur));
    }
    
    $statusMapper->persist(new Status(null,$user,$message,date("Y-m-d H:i:s")));
    $response = new Response("Status add correctly",201);
    $response->send();
    
    $app->redirect('/statuses',201);  
    
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app,$statusMapper,$statusFinder) {

    if(!Verification::checkInteger($id)) {
        $response = new Response("Error with the object ID",400);
        $response->send();
        return;    
    }
    if(!$statusFinder->findOneById($id)) {
        $response = new Response("Object doesn't exist",416);
        $response->send();
        return; 
    }
    $statusMapper->remove($id);
    $app->redirect('/statuses');
});

/////////////////////////////////////////////////////////////////////////////////////////////////
//                          AUTHENTIFICATION                                                   //
/////////////////////////////////////////////////////////////////////////////////////////////////


$app->get('/login', function (Request $request) use ($app) {
    $login = $request->getParameter('login');
    
    return $app->render('login.php',array('login'   => $login,
                                          'erreur'  => ''));
});

$app->get('/register', function (Request $request) use ($app) {
    return $app->render('register.php');
});

$app->post('/login', function (Request $request) use ($app,$userFinder) {
    $login = $request->getParameter('login');
    $password = $request->getParameter('password');
    
    if(!isset($login) || !isset($password)) {
        $erreur = "Empty parameters";
        /*$response = new Response($erreur,400);
        $response->send();*/
        return $app->render('login.php',array('erreur'   => $erreur,
                                              'login'    => $login));
    }
    
    $user = $userFinder->findOneByLogin($login);
    
    if(!password_verify($password, $user->getPassword())) {
        $erreur = "Password incorrect";
        /*$response = new Response($erreur,400);
        $response->send();*/
        return $app->render('login.php',array('erreur'   => $erreur,
                                              'login'    => $login));
    }
    
    $_SESSION['is_authenticated'] = true;
    $_SESSION['id'] = $user->getId();
    $_SESSION['login'] = $user->getLogin();
    
    $app->redirect('/statuses');
});

$app->post('/register', function (Request $request) use ($app,$userMapper) {
    
    $login = $request->getParameter('user');
    $password = $request->getParameter('password');
    $password_verif = $request->getParameter('password2');
    
    if(!isset($login) || !isset($password)) {
        $erreur = "Empty parameters";
        /*$response = new Response($erreur,400);
        $response->send();*/
        return $app->render('register.php',array('erreur'   => $erreur,
                                                 'login'    => $login));
    }
    
    if(!($password == $password_verif)) {
        $erreur = "The two password aren't similars";
        return $app->render('register.php',array('erreur'   => $erreur,
                                                 'login'    => $login));
    }
    
    $userMapper->persist(new User(null,$login, password_hash($password,PASSWORD_DEFAULT)));
    
    $app->redirect('/login?login='.$login);  
    
});

$app->get('/logout', function(Request $request) use ($app) {
    session_destroy();
    $app->redirect('/statuses');
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
