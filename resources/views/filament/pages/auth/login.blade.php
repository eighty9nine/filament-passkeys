<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}

            {{ $this->registerAction }}
        </x-slot>
    @endif

    <div class="w-full max-w-md mx-auto">
        <!-- Custom header section -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                <x-heroicon-o-lock-closed class="w-8 h-8 text-primary-600" />
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $this->getHeading() }}
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                {{ $this->getSubHeading() }}
            </p>
        </div>

        <!-- Login form -->
        <x-filament-panels::form wire:submit="authenticate">
            {{ $this->form }}

            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        </x-filament-panels::form>

        <!-- Additional custom content -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                By signing in, you agree to our Terms of Service and Privacy Policy.
            </p>
        </div>
    </div>
</x-filament-panels::page.simple>
