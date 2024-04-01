<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>
    <h2>Send Email</h2>
    <form action="send_email.php" method="post">
        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subject" value="Test email"><br>
        <label for="body">Body:</label><br>
        <textarea id="body" name="body">This is a test email body</textarea><br>
        <label for="recipient">Recipient Email:</label><br>
        <input type="email" id="recipient" name="recipient" value="recipient@example.com"><br>
        <input type="submit" value="Send Email" name="submit">
    </form>
</body>
</html>
