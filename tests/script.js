document.getElementById('logoutButton').addEventListener('click', function() {
    showCustomConfirm("Are you sure you want to logout?", function(result) {
        if (result) {
            // Replace with the actual logout logic, for example:
            // window.location.href = 'logout_url';
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
