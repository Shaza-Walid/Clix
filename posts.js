document.addEventListener("DOMContentLoaded", fetchPosts);   // Fetch posts when the DOM is fully loaded by calling fetchPosts function

// Function to fetch and display posts
function fetchPosts() {
    fetch("http://localhost/clix/posts.php")   // Send a GET request to the PHP posts script
        .then(res => res.json())  // Parse(convert) the JSON response from the server
        .then(data => {          // Handle the response data from the server
            console.log("Posts data:", data);    // Log(record) the posts data for debugging
            const postsArray = data.posts;    // Get the posts array from the response

            // Validate that postsArray is indeed an array. if not, log an error and return
            if (!Array.isArray(postsArray)) {
                console.error("Posts data is not an array", postsArray);
                return;
            }

            const postsContainer = document.getElementById("posts");  // Get the posts container by its ID(means to get the HTML element with ID "posts")
            postsContainer.innerHTML = "";  // Clear existing posts

            // Iterate over each post and create a div element to display it
            postsArray.forEach(post => {
                const postDiv = document.createElement("div");   // Create a new div element for the post
                postDiv.className = "post";
                /*
                    Set the inner HTML of the post div with post content and Like button
                    the div includes the username, content, total likes, and a Like button
                    the Like button has a data attribute to store the post ID for later use
                    the button text changes based on whether the user has liked the post or not by checking post.liked_by_user if greater than 0 or not
                    post.total_likes displays the total number of likes for the post
                    post.liked_by_user represents whether the current user has liked the post (greater than 0 means liked)
                */
                postDiv.innerHTML = `
                        <h3>${post.username}</h3>
                        <p>${post.content}</p>
                        <span>Likes: ${post.total_likes}</span>
                        <button 
                            class="like-btn" 
                            data-post-id="${post.id}"
                        >
                            ${post.liked_by_user > 0 ? "Liked ✔" : "Like"}
                        </button>

                    `;
                // Append the post div to the posts container
                postsContainer.appendChild(postDiv);
            });

            /*
            how the like button works:
            1. Each Like button has a data attribute (data-post-id) that stores the ID of the post it corresponds to.
            2. An event listener is added to each Like button to listen for click events.  
            3. When a Like button is clicked, the sendLike function is called with the post ID retrieved from the button's data attribute.
            4. The sendLike function sends a POST request to the like.php endpoint with the post ID to register the like.
            5. After liking a post, the fetchPosts function is called again to refresh the posts and update the like counts and button states.
            6. The button text changes to "Liked ✔" if the user has already liked the post, based on the post.liked_by_user value.
            7. The total number of likes for each post is displayed next to the Like button.
            8. This approach ensures that the UI reflects the current like status and count for each post dynamically.
            */

            // Attach Like button events
            document.querySelectorAll(".like-btn").forEach(btn => {
                btn.addEventListener("click", () => {      // Add click event listener to each Like button
                    const postId = btn.dataset.postId;     // Get the post ID from the button's data attribute
                    sendLike(postId);                      // Call the sendLike function to handle the like action
                });
            });

        })
        .catch(err => console.error("Error fetching posts:", err));
}

function sendLike(postId) {
    fetch("http://localhost/clix/like.php", {         // Send a POST request to the PHP like script
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "post_id=" + postId
    })
        .then(res => res.json())         // Parse(convert) the JSON response from the server
        .then(response => {              // Handle the response data from the server
            console.log("Like response:", response);
            fetchPosts(); // Refresh posts to update like counts
        })
        .catch(err => console.error("Error liking post:", err));
}

/*
    how this code works:
    1. When the DOM content is loaded, the fetchPosts function is called to load posts from the server.
    2. The fetchPosts function sends a GET request to the posts.php endpoint to retrieve posts data.
    3. The response is parsed as JSON and the posts array is extracted.
    4. Each post is displayed in the posts container with a Like button.
    5. An event listener is added to each Like button to handle clicks.
    6. When a Like button is clicked, the sendLike function is called with the post ID.
    7. The sendLike function sends a POST request to the like.php endpoint with the post ID to register the like.
    8. After liking a post, the fetchPosts function is called again to refresh the posts and update the like counts.
    9. Error handling is included to log any issues during fetching or liking posts.
    10. The Like button text changes to "Liked ✔" if the user has already liked the post.
    11. The total number of likes for each post is displayed next to the Like button.
*/