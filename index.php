<?php
$messages = file_exists('messages.json') ? json_decode(file_get_contents('messages.json'), true) : [];
$length = count($messages);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>The Nest Telephony System</title>
    <meta name="title" content="The Nest Telephony System" />
    <meta name="description"
        content="We're building a programmable telecom layer for hackers. Claim a keyword, get your own SMS API endpoint, or receive calls and route them wherever you want." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://telephony.hackclub.app" />
    <meta property="og:title" content="The Nest Telephony System" />
    <meta property="og:description"
        content="We're building a programmable telecom layer for hackers. Claim a keyword, get your own SMS API endpoint, or receive calls and route them wherever you want." />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://telephony.hackclub.app" />
    <meta property="twitter:title" content="The Nest Telephony System" />
    <meta property="twitter:description"
        content="We're building a programmable telecom layer for hackers. Claim a keyword, get your own SMS API endpoint, or receive calls and route them wherever you want." />
</head>

<body>
    <h1>telephony.hackclub.app</h1>
    <p>We're building a programmable telecom layer for hackers. Claim a keyword, get your own SMS API endpoint, or
        receive calls and route them wherever you want.</p>
    <p>Our phone number: <code id="number"></code></p>
    <p><b>Try it out.</b></p>
    <ul>
        <li>📞 Call our number and try out some projects</li>
        <small>Are you a nest user? <a href="https://nest.fillout.com/sip_extension_request">You can use the Nest
                telephony system to get a SIP extension!</a></small>
        <li>📠 Fax/text us something, it'll appear on this site!</li>
    </ul>

    <h2>Text and Fax Bulletin Board System (TFBBS)</h2>
    <p>Send a text (MMS supported) or fax, and we'll post it here! There are currently <?php echo $length; ?> posts.</p>
    <a href="/tfbbs.php">Check it out!</a>
    <details>
        <summary>TFBBS Privacy Policy</summary>
        <p>When you send a fax or text to TFBBS, we store your phone number for 30 days. After that, it's converted into
            a one-way hash, which is useful for spam control, but not identifiable.</p>
        <p>We use <a href="https://akismet.com" target="_blank">Akismet</a> to help identify and filter spam messages to
            keep the bulletin board clean and safe.</p>
        <p></p>Your location is estimated by looking up your area code and exchange (the first 6 digits, like <code
            id="number6"></code>) using <a href="https://localcallingguide.com"
            target="_blank">localcallingguide.com</a> for North America. For international numbers, we use your country
        code (e.g. +44 &rarr; United Kingdom).</p>

        <pre><code>{
    "from": "+1678XXXXXXX",
    "text": "hi!",
    "received_at": "2025-07-14T06:26:18.053+00:00",
    "media": [],
    "location": {
      "country": "United States",
      "city": "Gainesville",
      "state": "GA"
    },
    "phone_encrypted": false
}</code></pre>

        <b>Hashing logic (simplified):</b>
        <pre><code>function encryptPhoneNumber($phoneNumber) {
  return hash('sha256', $phoneNumber . $HASH_NOT_PUBLIC_FOR_OBVIOUS_REASONS);
}</code></pre>
    </details>
    <h2>Connect with SIP</h2>
    <ul>
        <li>Hostname: pbx.hackclub.app (IPv6 Only)</li>
        <li>Port: 5060</li>
        <li>Username: your extension</li>
        <li>Transport: UDP</li>
    </ul>
    <h2>Emergency services aren't supported</h2>
    <p>The Nest telephony system does not support access to 911 or any emergency services. Do not rely on Nest for any
        calls requiring police, fire, ambulance, or other emergency response. If you are experiencing an emergency, use
        traditional phone or mobile device to call 911. No idea why you'd try and rely on this anyways.</p>

</body>

</html>
