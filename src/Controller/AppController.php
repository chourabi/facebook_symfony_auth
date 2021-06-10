<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;





class AppController extends AbstractController
{
  /**
   * @var ClientRegistry
   */
  private $clientRegistry;

  /**
   * @var EntityManagerInterface
   */
  private $em;



  /**
   * FacebookAuthenticator constructor.
   * @param ClientRegistry $clientRegistry
   * @param EntityManagerInterface $em
   */
  public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em)
  {
    $this->clientRegistry = $clientRegistry;
    $this->em = $em;
  }


  /**
   * @Route("/home", name="app_home")
   */
  public function homeindex(): Response
  {
    session_start();

    $fb = new \Facebook\Facebook([
      'app_id' => '755271938478430',
      'app_secret' => 'c13457845dcefb8287b1a3da83d9ea7c',
      'default_graph_version' => 'v2.10',
    ]);


    $helper = $fb->getRedirectLoginHelper();

    $login_url = $helper->getLoginUrl("http://localhost:8000/home", ['pages_show_list']);



    try {
      $token = $helper->getAccessToken();

      if (isset($token)) {
        $tokenString = $token->getValue();

        $res = $fb->get('me?fields=id,name,accounts', $tokenString);
        $user = $res->getGraphUser();

        //dump($user->getProperty('accounts'));
        $accounts = $user->getProperty('accounts');

        foreach ($accounts as $key => $account) {
          dump($account);
          $pageAccessToken = $account->getProperty("access_token");
          $pageName = $account->getProperty("name");
          $pageId = $account->getProperty("id");

          dump($pageAccessToken);
          dump($pageName);
          dump($pageId);


          // post to page
          /*$ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . $pageId . '/feed?message=Hello Fans!&access_token=' . $pageAccessToken);


          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');


          $headers = array();
          $headers[] = 'Authorization: Bearer ' . $pageAccessToken;
          $headers[] = 'Content-Type: application/json';
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          $result = curl_exec($ch);

          $object = (json_decode($result));

          dump($object);*/


          // post to page
          /*try {
                            // Returns a `Facebook\FacebookResponse` object
                            $response = $fb->post(
                              $pageId.'/feed',
                              array (
                                'message' => 'This is a test message',
                              ),
                              $pageAccessToken
                            );
                          } catch(Facebook\Exceptions\FacebookResponseException $e) {
                            echo 'Graph returned an error: ' . $e->getMessage();
                            exit;
                          } catch(Facebook\Exceptions\FacebookSDKException $e) {
                            echo 'Facebook SDK returned an error: ' . $e->getMessage();
                            exit;
                          }*/
        }
      }
    } catch (\Throwable $th) {
      throw $th;
    }


    if (isset($_SESSION['fb_token'])) {
      dump($_SESSION['fb_token']);
    }

    return $this->render('app/index.html.twig', ["login_url" => $login_url]);
  }
}
