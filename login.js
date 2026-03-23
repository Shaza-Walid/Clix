let form = document.getElementById("form");  // Get the form element by its ID

form.addEventListener("submit", (event) => {  // Add an event listener for the form submission
    /*
        Prevent the default form submission behavior (this means the page will not reload when the form is submitted)
        this is important for single-page applications where you want to handle the form submission with JavaScript
        this it usually done to provide a better user experience by avoiding full page reloads
    */
    event.preventDefault();   

    let email = document.getElementById("email").value;   // Get the value of the email input field
    let pass = document.getElementById("password").value; // Get the value of the password input field

    let data = {   // Create a data object to send to the server
        email: email,
        password: pass
    };

    fetch("http://localhost/clix/login.php", {      // Send a POST request to the PHP login script
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)    // Convert the data object to a JSON string
    })
    .then(res => res.json())   // Parse(convert) the JSON response from the server
    .then(res => {             // Handle the response data from the server
        console.log("Response from PHP:", res);  // Log(log means record the response) the response for debugging

        id = res.id;  // Extract the user ID from the response
        if(id == 0){  // Check if the ID is 0, indicating the user does not exist
            alert("You are not a user! Please sign up");
        } else {     // If the user exists, store the ID in local storage and redirect to posts.html
            localStorage.clear();     // Clear any existing data in local storage
            localStorage.setItem("id", id);     // Store the user ID in local storage
            window.location.href = "posts.html";   // Redirect to the posts page
        }
    });
});

/*
    how this code works:
    1. The code starts by selecting the form element using its ID "form".
    2. An event listener is added to the form to listen for the "submit" event.
    3. When the form is submitted, the default behavior is prevented to avoid page reload.
    4. The email and password values are retrieved from the input fields.
    5. A data object is created containing the email and password.
    6. A POST request is sent to the PHP login script with the data object as a JSON string.
    7. The response from the server is parsed as JSON.
    8. The user ID is extracted from the response.
    9. If the ID is 0, an alert is shown indicating the user does not exist.
    10. If the user exists, the local storage is cleared, the user ID is stored, and the user is redirected to "posts.html".
*/

