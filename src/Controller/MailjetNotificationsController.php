<?php

namespace App\Controller;

use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Repository\OperationSentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailjetNotificationsController extends AbstractController
{
    /**
     * @Route("/mailjet_notifications", name="mailjet_notifications")
     */
    public function notification(Request $request, OperationSentRepository $operationRepository)
    {
        $content = json_decode($request->getContent());
        foreach ($content as $notif) {
            $messageID = $notif->MessageID;
            $event = $notif->event;
            $operation_sent = $this->getDoctrine()->getRepository(OperationSent::class)->getByMessageID($messageID);

            if ($operation_sent["nombre"] > 0) {
                switch ($event) {
                    case "open":
                        $this->getDoctrine()->getRepository(OperationSent::class)->setStateOperationSent(2, $messageID);
                        break;
                    case "unsub":
                        $this->getDoctrine()->getRepository(OperationSent::class)->setStateOperationSent(4, $messageID);
                        break;
                }
            }
        }

        $this->getDoctrine()->getManager()->flush();

        $data = [
            "receive" => true,
        ];
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
