<?php

declare(strict_types=1);

namespace Spiral\DatabaseSeeder\Console\Command;

use Spiral\DatabaseSeeder\Scaffolder\Declaration\SeederDeclaration;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;

final class SeederCommand extends AbstractScaffolderCommand
{
    protected const NAME        = 'create:seeder';
    protected const DESCRIPTION = 'Create seeder for database seeding';
    protected const ARGUMENTS   = [
        ['name', InputArgument::REQUIRED, 'Seeder name'],
    ];
    protected const OPTIONS     = [
        [
            'comment',
            'c',
            InputOption::VALUE_OPTIONAL,
            'Optional comment to add as class header',
        ],
    ];

    public function perform(): int
    {
        /** @psalm-suppress PossiblyNullArgument */
        $io = new SymfonyStyle($this->input, $this->output);

        /** @var SeederDeclaration $declaration */
        $declaration = $this->createDeclaration(SeederDeclaration::class);

        $this->writeDeclaration($declaration);

        $io->success("Seeder {$declaration->getClass()->getName()} has been successfully created.");

        return self::SUCCESS;
    }
}
