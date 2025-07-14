<?php
$messages = file_exists('messages.json') ? json_decode(file_get_contents('messages.json'), true) : [];
$length = count($messages);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Text and Fax Bulletin Board System | The Nest Telephony System</title>
    <meta name="title" content="Text and Fax Bulletin Board System | The Nest Telephony System" />
    <meta name="description"
        content="Send a text (MMS supported) or fax, and we'll post it here! So far, there are currently <?php echo $length; ?> posts." />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://telephony.hackclub.app/tfbbs.php" />
    <meta property="og:title" content="Text and Fax Bulletin Board System | The Nest Telephony System" />
    <meta property="og:description"
        content="Send a text (MMS supported) or fax, and we'll post it here! So far, there are currently <?php echo $length; ?> posts." />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://telephony.hackclub.app/tfbbs.php" />
    <meta property="twitter:title" content="Text and Fax Bulletin Board System | The Nest Telephony System" />
    <meta property="twitter:description"
        content="Send a text (MMS supported) or fax, and we'll post it here! So far, there are currently <?php echo $length; ?> posts." />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>

<body>
    <h1>Text and Fax Bulletin Board System</h1>
    <p>Text and/or fax this number and it'll appear here!</p>
    <?php
    $messages = file_exists('messages.json') ? json_decode(file_get_contents('messages.json'), true) : [];

    if (empty($messages)) {
        echo "<p>No messages received yet.</p>";
    } else {
        foreach (array_reverse($messages) as $msg) {
            echo "<article>";

            $fromDisplay = "Somebody";

            $locationDisplay = '';
            if (isset($msg['location'])) {
                $loc = $msg['location'];
                if ($loc['city'] && $loc['state']) {
                    $locationDisplay = " from {$loc['city']}, {$loc['state']}, {$loc['country']}";
                } else {
                    $locationDisplay = " from {$loc['country']}";
                }
            }

            echo "<header><strong>From:</strong> " . htmlspecialchars($fromDisplay) . htmlspecialchars($locationDisplay) . " <em>(" . htmlspecialchars($msg['received_at']) . ")</em></header>";
            echo "<p>" . nl2br(htmlspecialchars($msg['text'])) . "</p>";
            if (!empty($msg['media'])) {
                echo "<div>";
                foreach ($msg['media'] as $media) {
                    $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        echo "<img src=\"$media\" alt=\"Media\" style=\"max-width: 200px; margin-right: 10px;\">";
                    } else {
                        echo "<a href=\"$media\" target=\"_blank\">Download file</a><br>";
                    }
                }
                echo "</div>";
            }
            echo "</article><hr>";
        }
    }
    ?>
</body>

</html>
