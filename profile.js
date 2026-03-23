document.addEventListener("DOMContentLoaded", loadProfile);   // Load profile data when the DOM is fully loaded

// Function to load profile data
function loadProfile() {
    fetch("profile.php", { credentials: "same-origin" })  // Send a GET request to the PHP profile script
        .then(res => {    // Check if the response is ok, then parse(convert) as JSON
            if (!res.ok) throw new Error("Network response was not ok");
            return res.json();
        })
        .then(data => {      // Handle the response data from the server
            console.log("Profile data:", data);  // Log(record) the profile data for debugging
            // display username on the top profile page
            const username = data.user && data.user.username ? data.user.username : "User";  // default to "User" if username is not available
            const welcomeEl = document.getElementById("welcome");       // Get the welcome element by its ID(means to get the HTML element with ID "welcome")
            if (welcomeEl) welcomeEl.textContent = `Welcome ${username} !`;     // Set the welcome message with the username

            // display posts
            const postsDiv = document.getElementById("posts");   // Get the posts container by its ID(means to get the HTML element with ID "posts")
            postsDiv.innerHTML = "";   // Clear existing posts

            const posts = data.posts || [];   // Get the posts array from the response, default to empty array if not available
            if (!Array.isArray(posts) || posts.length === 0) {     //if no posts available, show message
                postsDiv.innerHTML = "<p>No posts yet.</p>";
                return;
            }

            // Iterate over each post and create a card element to display it
            posts.forEach(post => {
                const card = document.createElement("div");    // Create a new div element for the post card
                card.className = "post";
                /*
                    Use escapeHtml to prevent XSS attacks by escaping special characters in post content
                    card innerHTML includes post content, creation date, and Edit and Delete buttons with onclick handlers
                */
                card.innerHTML = `
                    <p>${escapeHtml(post.content)}</p>
                    <small>${post.created_at}</small>
                    <div>
                        <button class="button btn" style="padding: 8px 20px;
                                background: #00C4B3;
                                color: white;
                                border: none;
                                border-radius: 10px;
                                cursor: pointer;
                                font-size: 16px;
                                transition: 0.2s;"
                            onclick="editPost(${post.id})">Edit</button>
                        <button class="button btn" style="padding: 8px 20px;
                                background: #00C4B3;
                                color: white;
                                border: none;
                                border-radius: 10px;
                                cursor: pointer;
                                font-size: 16px;
                                transition: 0.2s;"
                            onclick="deletePost(${post.id})">Delete</button>
                    </div>
                `;
                postsDiv.appendChild(card);    // Append the post card to the posts container
            });
        })
        .catch(err => {           // Handle any network or parsing errors by logging the error and showing a message
            console.error("Error loading profile:", err);
            const postsDiv = document.getElementById("posts");
            if (postsDiv) postsDiv.innerHTML = "<p>Error loading posts.</p>";
        });
}

// Function to handle editing a post
function editPost(id) {
    window.location.href = "edit.php?id=" + id;
}

// Function to handle deleting a post
function deletePost(id) {
    if (!confirm("Are you sure you want to delete this post?")) //confirm function shows a dialog box with OK and Cancel options
        return;
    fetch("delete.php?id=" + id, {
        method: "GET",
        credentials: "same-origin"
    })
        .then(res => {   // Check if the response is ok, then parse as text
            if (!res.ok) throw new Error("Network response not ok");
            return res.text();
        })
        .then(text => {   // Handle the response text from the server by showing an alert and reloading the profile
            alert(text);
            loadProfile(); // Reload posts
        })
        .catch(err => {     // Handle any network or parsing errors by logging the error and showing an alert
            console.error("Error deleting post:", err);
            alert("Error deleting post.");
        });
}

// Function to escape HTML special characters to prevent XSS attacks
function escapeHtml(unsafe) {
    if (!unsafe) return "";
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

/*
    how this code works:
    1. When the DOM content is loaded, the loadProfile function is called to fetch and display user profile data.
    2. The loadProfile function sends a GET request to "profile.php" to retrieve user information and posts.
    3. The response is checked for success and parsed as JSON.
    4. The username is extracted from the response and displayed in the welcome message.
    5. The posts are iterated over, and for each post, a card element is created with the post content, creation date, and Edit/Delete buttons.
    6. The Edit button redirects to "edit.php" with the post ID as a query parameter.
    7. The Delete button calls the deletePost function, which sends a GET request to "delete.php" to delete the specified post.
    8. After deletion, the posts are reloaded to reflect the changes.
    9. An escapeHtml function is provided to sanitize post content before displaying it in the HTML.
    10. Error handling is included to log any issues during loading or deleting posts and to provide user feedback.
*/