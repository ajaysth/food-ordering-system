function sure(){
    let logOut=confirm("Are you sure you want to log out?");
    if(logOut==TRUE){
        window.location.href("../logout.php");
    }else{
        document.write("logout failed");
    }
}


function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}
