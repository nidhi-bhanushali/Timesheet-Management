<?PHP
$sender = 'bhanushalinidhi44@gmail.com';
$recipient = 'nidhi.cb@somaiya.edu';

$subject = "php mail test";
$message = "php test message";
$headers = 'From:' . $sender;

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>