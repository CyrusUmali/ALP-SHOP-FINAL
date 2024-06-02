
const authKey = 'SignedIn';

var authVerify = localStorage.getItem('authToken');


if (authKey == authVerify) {
    console.log("YESS");
    window.location.href = 'user-page.php';
}
else {
    console.log("Nahhh");
}