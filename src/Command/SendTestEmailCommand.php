<?php

namespace App\Command;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendTestEmailCommand extends Command
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:send-test-email')
            ->setDescription('Sends a test email.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = (new Email())
            ->from('imco12.service@gmail.com')
            ->to('hussien.chakra@gmail.com')
            ->subject('Test Email')
            ->text('This is a test email.');

        $this->mailer->send($email);

        $output->writeln('Test email sent.');

        return Command::SUCCESS;
    }
}
