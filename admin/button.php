<!DOCTYPE html>
<html>
<head>
    <title>Logout Confirmation</title>
</head>
<body>
    <form id="logoutForm" onsubmit="return confirmLogout();">
        <button type="submit">Logout</button>
        <button type="button" id="cancelButton">Cancel</button>
    </form>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }

        document.getElementById('cancelButton').addEventListener('click', function(event) {
            event.preventDefault();
            alert("Logout cancelled"); // Close confirm box or any other logic
        });
    </script>
</body>
</html>
