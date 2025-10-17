<?php

namespace EightyNine\Passkeys\Concerns;

use Spatie\LaravelPasskeys\Models\Concerns\InteractsWithPasskeys as SpatieInteractsWithPasskeys;

trait InteractsWithPasskeys{
    use SpatieInteractsWithPasskeys;

    // You can add additional methods or properties here if needed
    // For example, you might want to override some methods from the Spatie trait
    // or add new functionality specific to your application.

}