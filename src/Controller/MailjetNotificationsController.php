<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MailjetNotificationsController extends AbstractController
{
    /**
     * @Route("/mailjet_notifications", name="mailjet_notifications")
     */
    public function notification(Request $request)
    {
        
        dump($request);
        $data = [
            "receive" => true
        ];
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}
