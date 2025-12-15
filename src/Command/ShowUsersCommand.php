<?php

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:show-users',
    description: 'Show all users',
)]
class ShowUsersCommand extends Command
{
    public function __construct(private UserRepository $userRepository)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->userRepository->findAll();

        foreach ($users as $user) {
            $output->writeln('ID: ' . $user->getId());
            $output->writeln('Email: ' . $user->getEmail());
            $output->writeln('Password (hashed): ' . $user->getPassword());
            $output->writeln('Roles: ' . implode(', ', $user->getRoles()));
            $output->writeln('---');
        }

        return Command::SUCCESS;
    }
}
