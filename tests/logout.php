<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Confirm Box</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Existing Logout Button -->
    <button id="logoutButton">Logout</button>

    <!-- Custom Confirmation Box -->
    <div id="customConfirmBox" class="hidden">
        <div class="confirm-content">
            <p>Are you sure you want to logout?</p>
            <button id="confirmYes">Yes</button>
            <button id="confirmNo">No</button>
        </div>
    </div>

    <script >
        document.getElementById('logoutButton').addEventListener('click', function() {
    showCustomConfirm("Are you sure you want to logout?", function(result) {
        if (result) {
            // Replace with the actual logout logic, for example:
            window.location.href = '../index.php';
            alert('Logged out!');
        } else {
            alert('Logout cancelled!');
        }
    });
});

function showCustomConfirm(message, callback) {
    document.querySelector('#customConfirmBox .confirm-content p').textContent = message;
    document.getElementById('customConfirmBox').classList.remove('hidden');

    function handleConfirmYes() {
        document.getElementById('customConfirmBox').classList.add('hidden');
        callback(true);
        cleanup();
    }

    function handleConfirmNo() {
        document.getElementById('customConfirmBox').classList.add('hidden');
        callback(false);
        cleanup();
    }

    function cleanup() {
        document.getElementById('confirmYes').removeEventListener('click', handleConfirmYes);
        document.getElementById('confirmNo').removeEventListener('click', handleConfirmNo);
    }

    document.getElementById('confirmYes').addEventListener('click', handleConfirmYes);
    document.getElementById('confirmNo').addEventListener('click', handleConfirmNo);
}

    </script>
</body>
</html>
