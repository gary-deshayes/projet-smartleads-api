<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/token")
 */
class TokenController extends AbstractController
{
    /**
     * @Route("/generate", name="api_token_generate", methods={"POST"})
     */
    public function generate(Request $request)
    {

        $user = $this->getDoctrine()
            ->getRepository(Salesperson::class)
            ->findOneBy(['email' => $request->get("email")]);
        dump($user);

        if (!$user) {
            throw $this->createNotFoundException();
        }

        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $request->get("password"));

        if (!$isValid) {
            throw new BadCredentialsException();
        }

        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => $user->getEmail(),
                'exp' => time() + 3600, // 1 hour expiration
            ]);

        return new JsonResponse(['token' => $token]);
    }
}
