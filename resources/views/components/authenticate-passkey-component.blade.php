<div x-data="{ loading: false, conditionalUISupported: false }" x-bind:aria-busy="loading.toString()">
    <script>
        let abortController = null;

        async function checkConditionalUISupport() {
            try {
                if (typeof PublicKeyCredential !== 'undefined' && 
                    typeof PublicKeyCredential.isConditionalMediationAvailable === 'function') {
                    return await PublicKeyCredential.isConditionalMediationAvailable();
                }
            } catch (error) {
                console.warn('Conditional UI check failed:', error);
            }
            return false;
        }

        async function startConditionalAuthentication() {
            try {
                // Abort any existing authentication
                if (abortController) {
                    abortController.abort();
                }
                
                abortController = new AbortController();
                
                const response = await fetch('{{ $authenticationOptionUrl }}');
                const options = await response.json();
                
                // Enable conditional mediation
                options.mediation = 'conditional';
                
                const startAuthenticationResponse = await startAuthentication({ 
                    optionsJSON: options,
                    signal: abortController.signal
                });

                const form = document.getElementById('passkey-login-form');
                
                // Create hidden input for the response
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'start_authentication_response';
                hiddenInput.value = JSON.stringify(startAuthenticationResponse);
                form.appendChild(hiddenInput);

                form.submit();
            } catch (error) {
                if (error.name === 'AbortError') {
                    console.log('Conditional authentication was aborted');
                } else if (error.name === 'NotAllowedError') {
                    console.log('Conditional authentication not allowed - likely no passkeys registered for this domain or user interaction required');
                } else {
                    console.error('Conditional authentication failed:', error);
                }
                // Reset abort controller on any error
                abortController = null;
            }
        }

        async function authenticateWithPasskey() {
            try {
                // Abort conditional authentication if running
                if (abortController) {
                    abortController.abort();
                }

                const response = await fetch('{{ $authenticationOptionUrl }}');
                const options = await response.json();

                const startAuthenticationResponse = await startAuthentication({ optionsJSON: options });

                const form = document.getElementById('passkey-login-form');

                form.addEventListener('formdata', ({formData}) => {
                    formData.set('start_authentication_response', JSON.stringify(startAuthenticationResponse));
                });

                form.submit();
            } catch (error) {
                console.error('Passkey authentication failed:', error);
                throw error;
            }
        }

        // Initialize conditional UI when component loads
        document.addEventListener('DOMContentLoaded', async () => {
            const supported = await checkConditionalUISupport();
            
            // Update Alpine.js data
            const component = document.querySelector('[x-data*="conditionalUISupported"]');
            if (component && component._x_dataStack) {
                component._x_dataStack[0].conditionalUISupported = supported;
            }
            
            // Set up email field listeners instead of auto-starting
            if (supported) {
                setupEmailFieldListeners();
            }
        });

        // Setup email field listeners for conditional authentication
        function setupEmailFieldListeners() {
            // Try multiple selectors to find the email field
            const selectors = [
                'input[autocomplete*="webauthn"]',
                'input[name="email"]',
                'input[type="email"]',
                'input[name="data.email"]', // Filament form fields
                '[wire\\:model*="email"]', // Livewire fields
                '.fi-input input[type="email"]' // Filament input wrapper
            ];
            
            let emailField = null;
            for (const selector of selectors) {
                emailField = document.querySelector(selector);
                if (emailField) {
                    console.log('Found email field with selector:', selector);
                    break;
                }
            }
            
            if (!emailField) {
                console.log('Email field not found. Retrying in 500ms...');
                setTimeout(setupEmailFieldListeners, 500);
                return;
            }

            // Add event listeners
            const startConditionalAuth = () => {
                console.log('Starting conditional authentication on user interaction...');
                if (!abortController) { // Only start if not already running
                    startConditionalAuthentication();
                }
            };

            emailField.addEventListener('focus', startConditionalAuth);
            emailField.addEventListener('click', startConditionalAuth);
            
            console.log('Email field listeners set up successfully');
        }

        // Restart conditional authentication when needed
        function restartConditionalAuthentication() {
            checkConditionalUISupport().then(supported => {
                if (supported) {
                    startConditionalAuthentication();
                }
            });
        }
    </script>

    <form id="passkey-login-form" method="POST" action="{{ $loginUrl }}">
        @csrf
    </form>
    
    <!-- Separator -->
    <div x-cloak class="my-4">
        <div class="flex items-center gap-3">
            <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Or') }}</span>
            <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
        </div>
    </div>
    @if($message = session()->get('authenticatePasskey::message'))
        <div class="bg-red-100 text-red-700 p-4 border border-red-400 rounded flex items-center gap-2">
            <x-filament::icon 
                icon="heroicon-o-exclamation-triangle" 
                class="h-5 w-5 flex-shrink-0" 
            />
            <span class="text-sm">{{ $message }}</span>
        </div>
    @endif

    <x-filament::button
        x-cloak
        type="button"
        color="primary"
        outlined
        class="w-full mt-2"
        x-bind:disabled="loading"
        x-on:click="loading = true; authenticateWithPasskey().catch(() => { loading = false })"
    >
        <div class="flex items-center justify-center">
            <svg x-cloak x-show="loading" class="h-5 w-5 mr-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            
            <x-filament::icon 
                x-cloak 
                x-show="!loading" 
                icon="heroicon-o-key" 
                class="h-5 w-5 mr-2" 
            />
            
            <span x-cloak x-show="!loading">
                @if ($slot->isEmpty())
                    {{ __('filament-passkeys::passkeys.actions.authencticate_using_passkey') }}
                @else
                    {{ $slot }}
                @endif
            </span>
            
            <span x-cloak x-show="loading">{{ __('Authenticating…') }}</span>
        </div>
    </x-filament::button>
</div>
