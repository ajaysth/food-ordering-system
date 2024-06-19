function sure(){
    var logOut=confirm("Are you sure you want to log out?");
    if(logOut == TRUE){
        window.location.href="logout.php";
    }else{
        // document.write("logout failed");
        // window.location.href("index.php");
    }
}