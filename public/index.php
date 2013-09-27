<?php

require '../Slim/Slim.php';

\Slim\Slim::registerAutoloader();

date_default_timezone_set('Europe/Prague');

$app = new \Slim\Slim(array("view"=>new \custom\myView()));

//define templates dir and set default layout for application
$app->view()->setLayout("default_layout.php");
$app->config(array('templates.path'=>'view/templates'));

//register a translator with the app and specify the folder the translator should check for languages.
$app->view()->setTranslator(new \custom\Translator('../lang'));
$app->view()->translator->setDefaultLanguage('en');
//specify languages - quicker than having the translator check the langs folder for available langs.
$app->availableLangs = array('hu','en','cz');

//add hook for language translation
$app->hook('slim.before', function() use($app){
    $env = $app->environment();
    $pathInfo = $env['PATH_INFO'] . (substr($env['PATH_INFO'], -1) !== '/' ? '/' : '');

    // extract lang from PATH_INFO
    foreach($app->availableLangs as $availableLang) {
        $match = '/'.$availableLang;
        if (strpos($pathInfo, $match.'/') === 0) {
            $app->view()->translator->setLang($availableLang);
            $env['PATH_INFO'] = substr($env['PATH_INFO'], strlen($match));

            if (strlen($env['PATH_INFO']) == 0) {
                $env['PATH_INFO'] = '/';
            }
            break;
        }
    }
   // $app->view()->setPathInfo($env['PATH_INFO']);
});

//config db access
$app->container->singleton('db', function(){
    return new \custom\db\mysqlPdoAdapter('mysql:dbname=lewire', 'lewire', 'lewire123', array());
});

//set error handling
//$app->error(function(\Exception $e)use ($app){
    //set the response to send an error code if not done automatically by slim.
    //if the request was not ajax/xhr then provide a nice 404 page otherwise just provide an http response code.
//});


/**************************************routing********************************/

$app->get('/',function() use ($app){
    $review = new \custom\db\review();
    $result = $review->getAllReviews();
    $app->view()->appendLayoutData(array('title'=>"test"));
    $app->render('index.php',array(
        'result' => $result
    ));
});

$app->get('/reviews', function() use($app){
    $app->render('reviews.php');
    
});

$app->get('/addreview', function() use ($app){
    $data[':name'] = $app->request()->post("name");
    $data[':review'] = $app->request()->post("erview");
    $data[':date'] = date('Y-m-d');
    $review = new \custom\db\review();
    $review->addReview($data);
});

$app->get('/contact/',function(){
    $app->render('contact.php');
});


$app->run();

?>
