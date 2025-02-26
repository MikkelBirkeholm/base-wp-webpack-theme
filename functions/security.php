<?php

function send_security_headers() {
    // Enable X-Content-Type-Options
    header( 'X-Content-Type-Options: nosniff' );
    
    // Enable X-Frame-Options
    header( 'X-Frame-Options: SAMEORIGIN' );
    
    // Enable X-XSS-Protection
    header( 'X-XSS-Protection: 1; mode=block' );
    
    // Enable Strict-Transport-Security
    header( 'Strict-Transport-Security: max-age=31536000' );
    
    // Content-Security-Policy while allowing inline styles and scripts and allow google fonts and google tag manager
    // header( "Content-Security-Policy: default-src 'self' https://mydomain.com; font-src 'self' https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; script-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://www.googletagmanager.com https://tag.safary.club https://cdn.cookie3.co https://s2.adform.net https://track.adform.net; img-src 'self' https://mydomain.com; connect-src 'self' https://tag.safary.club https://region1.google-analytics.com https://c.staging.cookie3.co;" );
    
        // Referrer-Policy
    header( 'Referrer-Policy: no-referrer-when-downgrade' );
    
    // Feature-Policy
    header( "Feature-Policy: accelerometer 'none'; camera 'none'; geolocation 'none'; gyroscope 'none'; magnetometer 'none'; microphone 'none'; payment 'none'; usb 'none';" );
    
    // Clear the X-Powered-By header
    header_remove( 'X-Powered-By' );

    // Expect CT
    header( 'Expect-CT: enforce, max-age=86400' );

    // X Permitted Cross Domain Policies
    // header( 'X-Permitted-Cross-Domain-Policies: none' );
}

add_action( 'send_headers', 'send_security_headers' );