<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateRandomPostCommand extends Command
{
    protected static $defaultName = 'app:generate-random-post';
    protected static $defaultDescription = 'Run app:generate-random-post';
    private PostManager $postManager;

    /*
     * crontab:
     * 0 12 * * * /usr/local/bin/php /var/www/html/bin/console app:generate-random-post
     *
     * Moved a logic of generating random post to the PostManager because of single responsibility principle.
     * Based on this, added PostManager injection, removed unnecessary EntityManger and LoremIpsum.
     */
    public function __construct(PostManager $postManager, string $name = null)
    {
        parent::__construct($name);
        $this->postManager = $postManager;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->postManager->generateRandomPost();

        $output->writeln('A random post has been generated.');

        return Command::SUCCESS;
    }
}
