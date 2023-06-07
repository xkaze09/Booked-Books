// Global variables for storing the cart items and rented book IDs
var cartItems = [];
var rentedBookIds = [];

function fetchBooks() {
  fetch("./php/get_books.php")
    .then((response) => response.json())
    .then((data) => {
      console.log(data); // Log the data object for debugging

      if (data.length > 0) { // Check if books are available
        const books = data; // Assign the array of books directly
        updateBookList(books);
      } else {
        console.error("No books available.");
      }
    })
    .catch((error) => {
      console.error("Error fetching books:", error);
    });
}



// Toggle the visibility of the book list
function toggleViewBooks() {
  var bookList = document.getElementById("book-list");
  if (bookList.style.display === "none") {
    bookList.style.display = "block";
  } else {
    bookList.style.display = "none";
  }
}

// Update the book list in the user dashboard
function updateBookList(books) {
  const bookListContainer = document.getElementById("book-list");
  bookListContainer.innerHTML = "";

  if (books.length === 0) {
    bookListContainer.innerHTML = "<p>No books available.</p>";
  } else {
    books.forEach((book) => {
      const bookItem = createBookItem(book);
      bookListContainer.appendChild(bookItem);
    });
  }
}

// Create a book item element
function createBookItem(book) {
  const bookItem = document.createElement("div");
  bookItem.classList.add("book-item");

  const titleElement = document.createElement("h3");
  titleElement.textContent = book.title;
  bookItem.appendChild(titleElement);

  const authorElement = document.createElement("p");
  authorElement.textContent = "By " + book.author;
  bookItem.appendChild(authorElement);

  const descriptionElement = document.createElement("p");
  descriptionElement.textContent = book.description;
  bookItem.appendChild(descriptionElement);

  const genreElement = document.createElement("p");
  genreElement.textContent = "Genre: " + book.genre;
  bookItem.appendChild(genreElement);

  const addButton = document.createElement("button");
  addButton.textContent = "Add to Cart";
  addButton.addEventListener("click", () => addToCart(book.id));
  bookItem.appendChild(addButton);

  return bookItem;
}

// Display the books on the page
function displayBooks(books) {
    var table = document.getElementById('book-table');

    // Clear existing table rows
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }

    // Iterate over the books and create table rows
    for (var i = 0; i < books.length; i++) {
        (function () {
            var book = books[i];
            var row = table.insertRow(i + 1);

            // Insert cells with book information
            var titleCell = row.insertCell(0);
            titleCell.textContent = book.title;

            var authorCell = row.insertCell(1);
            authorCell.textContent = book.author;

            var descriptionCell = row.insertCell(2);
            descriptionCell.textContent = book.description;

            var genreCell = row.insertCell(3);
            genreCell.textContent = book.genre;

            var availabilityCell = row.insertCell(4);
            availabilityCell.textContent = book.availability;

            var quantityCell = row.insertCell(5);
            quantityCell.textContent = book.quantity;

            var coverImageCell = row.insertCell(6);
            var coverImage = document.createElement('img');
            coverImage.src = book.cover_image;
            coverImage.width = 100;
            coverImageCell.appendChild(coverImage);

            var actionCell = row.insertCell(7);
            var rentButton = document.createElement('button');
            rentButton.textContent = 'Rent';
            rentButton.onclick = function () {
                addToCart(book.id);
            };
            actionCell.appendChild(rentButton);
        })();
    }
}

// Fetch the book title from the server
function getBookTitle(bookId) {
  return new Promise((resolve, reject) => {
    fetch(`get_book_title.php?id=${bookId}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          resolve(data.title);
        } else {
          reject(new Error(data.message));
        }
      })
      .catch((error) => {
        reject(error);
      });
  });
}

// Add a book to the cart
function addToCart(bookId) {
  const cartCount = document.getElementById("cart-count");
  const currentCount = parseInt(cartCount.textContent);
  cartCount.textContent = currentCount + 1;

  const bookTitle = getBookTitle(bookId);
  console.log("Book added to cart:", bookId);
  console.log("Book Title:", bookTitle);
}

// Remove a book from the cart
function removeFromCart(bookId) {
    // Find the index of the book in the cart items array
    var index = cartItems.indexOf(bookId);

    // Remove the book from the cart items array
    if (index > -1) {
        cartItems.splice(index, 1);
    }

    // Update the cart indicator
    updateCartIndicator();

    // Update the cart content
    updateCartContent();
}

// Update the cart indicator
function updateCartIndicator() {
    var cartIndicator = document.getElementById('cart-indicator');
    cartIndicator.textContent = cartItems.length;
}

// Update the cart content
function updateCartContent() {
    var cartContent = document.getElementById('cart-content');

    // Clear existing cart content
    cartContent.innerHTML = '';

    // Iterate over the cart items and create list items
    for (var i = 0; i < cartItems.length; i++) {
        var bookId = cartItems[i];
        var bookTitle = getBookTitle(bookId);

        var listItem = document.createElement('li');
        listItem.textContent = bookTitle;

        var removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.onclick = function () {
            removeFromCart(bookId);
        };

        listItem.appendChild(removeButton);
        cartContent.appendChild(listItem);
    }
}

// Checkout the rent request
function checkoutRent() {
    // Get the user ID from the logged-in user (you may need to adjust this based on your implementation)
    var userId = getUserId(); // Replace this with your code to get the user ID

    // Prepare the data to send
    var rentData = {
        userId: userId,
        bookIds: cartItems
    };

    // Send the rent request to the server
    fetch('./php/rent_request.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(rentData)
    })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error: ' + response.status);
            }
        })
        .then(function(data) {
            // Process the response data
            handleRentResponse(data);
        })
        .catch(function(error) {
            console.log('Error: ' + error.message);
        });
}

// Process the rent response
function handleRentResponse(response) {
    // Check if the rent request was successful
    if (response.success) {
        // Clear the cart items and rented book IDs
        cartItems = [];
        rentedBookIds = [];

        // Update the cart indicator and cart content
        updateCartIndicator();
        updateCartContent();

        // Display a success message
        console.log('Rent request successful');
        console.log('Rent ID:', response.rentId);
    } else {
        // Display an error message
        console.log('Rent request failed');
        console.log('Error:', response.error);
    }
}

// Execute this code when the page finishes loading
window.addEventListener("load", () => {
  fetchBooks();
});