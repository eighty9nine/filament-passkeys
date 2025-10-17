// Import CSS
import '../css/filament-passkeys.css';

import {
    browserSupportsWebAuthn,
    startAuthentication,
    startRegistration,
} from '@simplewebauthn/browser'

// Filament Passkeys Plugin JavaScript
console.log('Filament Passkeys plugin loaded');

// Add your passkey functionality here
export default {
    // Plugin initialization code
};

window.browserSupportsWebAuthn = browserSupportsWebAuthn;
window.startAuthentication = startAuthentication;
window.startRegistration = startRegistration;
