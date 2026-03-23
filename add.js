let form = document.getElementById("form");   // Get the form element by its ID
let id = localStorage.getItem("id");          // Retrieve the user ID from local storage

form.addEventListener("submit", (event) => {   // Add an event listener for the form submission
    /*
        Prevent the default form submission behavior (this means the page will not reload when the form is submitted)
        this is important for single-page applications where you want to handle the form submission with JavaScript
        this it usually done to provide a better user experience by avoiding full page reloads
    */
    event.preventDefault();

    let content = document.getElementById("content").value;   // Get the value of the content input field

    let data = {          // Create a data object to send to the server
        content: content,
        id: id
    };

    fetch("http://localhost/clix/add.php", {           // Send a POST request to the PHP add script
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)          // Convert the data object to a JSON string for sending
    })
    .then(res => res.json())        // Parse(convert) the JSON response from the server
    .then(res => {                  // Handle the response data from the server
        if (res.msg === "ok") {
            alert("Added successfully");
            window.location.href = "posts.html";   // Redirect to the posts page after successful addition
        } else {
            alert("Failed to add, please try again");
        }
    })
    .catch(err => {
        alert("Error connecting to the server");
        console.error(err);
    });
});

/*
    how this code works:
    1. The code starts by selecting the form element using its ID "form" and retrieves the user ID from local storage.
    2. An event listener is added to the form to listen for the "submit" event.
    3. When the form is submitted, the default behavior is prevented to avoid page reload.
    4. The content value is retrieved from the input field.
    5. A data object is created containing the content and user ID.
    6. A POST request is sent to the PHP add script with the data object as a JSON string.
    7. The response from the server is parsed as JSON.
    8. Based on the response, the user is either alerted of a successful addition and redirected to "posts.html" or shown a failure message.
    9. Any network or parsing errors are logged to the console and an error message is shown to the user.
*/
