<?php

namespace EightyNine\Passkeys\Commands;

use Illuminate\Console\Command;

class PasskeysCommand extends Command
{
    public $signature = 'filament-passkeys';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
