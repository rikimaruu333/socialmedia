let eyeicon = document.getElementById("eyeicon");
let password = document.getElementById("loginpassword");

eyeicon.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
        eyeicon.src = "pics/blackhide.png";
    }
    else{
        password.type = "password";
        eyeicon.src = "pics/show.png";
    }
}


var modal = document.getElementById("signupModal");
var btn = document.getElementById("openModalBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



$(document).ready(function() {

    $("#signupForm").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "signupprocess.php",
            data: formData,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }

        });
    });

});

$(document).ready(function() {
    $("#loginForm").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "loginprocess.php",
            data: formData,
            success: function(response) {
                console.log("Login response:", response); // Log the response
                // Trim the response before comparing
                if (response.trim() === "success") {
                    window.location.href = "profile.php"; // Redirect to profile page
                } else {
                    alert(response); // Display error message received from server
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});


