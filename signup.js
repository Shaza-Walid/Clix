let form = document.getElementById("form");   // Get the form element by its ID

form.addEventListener("submit", (event) => {  // Add an event listener for the form submission
    /*
        Prevent the default form submission behavior (this means the page will not reload when the form is submitted)
        this is important for single-page applications where you want to handle the form submission with JavaScript
        this it usually done to provide a better user experience by avoiding full page reloads
    */
    event.preventDefault();

    let username = document.getElementById("username").value;   // Get the value of the username input field
    let email = document.getElementById("email").value;         // Get the value of the email input field
    let pass = document.getElementById("password").value;       // Get the value of the password input field
    let data = { username, email, password: pass };       // Create a data object to send to the server

    fetch("signup.php", {    // Send a POST request to the PHP signup script
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        /*
         to include cookies if any (optional->depending on your server setup)
         we can use 'include' to send cookies for cross-origin requests
         or 'same-origin' to send cookies only for same-origin requests
         we don't need this for most simple signup forms (we can skip this line in this project)
        */
        credentials: "same-origin" 
    })
    .then(res => res.json())      // Parse(convert) the JSON response from the server
    .then(r => {                  // Handle the response data from the server
        if (r.status === "success") {
            // Signup successful, redirect to profile or login
            window.location.href = "profile.html";
        } else {
            alert("Error: " + (r.error || "Unknown error"));
        }
    })
    .catch(err => console.error("Signup error:", err));        // Handle any network or parsing errors
});

/*
    how this code works:
    1. The code starts by selecting the form element using its ID "form".
    2. An event listener is added to the form to listen for the "submit" event.
    3. When the form is submitted, the default behavior is prevented to avoid page reload.
    4. The username, email, and password values are retrieved from the input fields.
    5. A data object is created containing the username, email, and password.
    6. A POST request is sent to the PHP signup script with the data object as a JSON string.
    7. The response from the server is parsed as JSON.
    8. Based on the response, the user is either redirected to the profile page or shown an error message.
    9. Any network or parsing errors are logged to the console.
*/