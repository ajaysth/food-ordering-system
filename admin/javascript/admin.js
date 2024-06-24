function sure()
{ 
    debugger
    let logOut=confirm("Are you sure you want to log out?");
    if(logOut == TRUE){
        
        window.location.href("../logout.php");
        
    }else{
        window.location.href("../cancel.php");
            
    }
}


// function myFunction() {
//    var element = document.body;
//    element.classList.toggle("dark-mode");
// }


// function confirmLogout() {
//     return confirm("Are you sure you want to log out?");
// }

// document.getElementById('cancelButton').addEventListener('click', function(event) {
//     event.preventDefault();
//     window.location.href = '../logout.php'; // Redirect to the desired URL
// });