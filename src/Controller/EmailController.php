<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\RawMessage;
use Symfony\Component\Routing\Attribute\Route;

final readonly class EmailController
{
    public function __construct(
        private MailerInterface $mailer,
    )
    {
    }

    #[Route(path: '/email', name: 'email', methods: ['GET'])]
    public function __invoke(): Response
    {
        $email = (new TemplatedEmail())
            ->from('test@example.com')
            ->to('test@example.com')
            ->htmlTemplate('email.html.twig')
            ->subject('Test');

        $this->mailer
            ->send($email);

        return new Response('Done');
    }
}
