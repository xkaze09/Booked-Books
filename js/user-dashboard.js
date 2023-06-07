// Toggle visibility of the View Books section for users
function toggleViewBooks() {
    var viewBooksSection = document.getElementById('view-books-section');
    var userActions = document.getElementById('user-actions');
  
    // Show the View Books section
    viewBooksSection.style.display = 'block';
    userActions.style.display = 'none';
  
    // Select the "All" genre option
    onGenreButtonClick('');
  }
  
  
  // Fetch the books from the server
  fetchBooks();
  
  // Display the books on the page
  function displayBooks(books) {
    var table = document.getElementById('book-list');
  
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
        coverImage.width = 100; // Adjust the width as needed
        coverImageCell.appendChild(coverImage);
  
        var actionCell = row.insertCell(7);
        var rentButton = document.createElement('button');
        rentButton.textContent = 'Rent';
        rentButton.onclick = function () {
          addToCart(book);
        };
        actionCell.appendChild(rentButton);
      })();
    }
  }
  
  // Filter books by genre
  function filterBooksByGenre(genre) {
    // Fetch books from the server and filter by genre
    fetch('php/get_books.php')
      .then(function(response) {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Error: ' + response.status);
        }
      })
      .then(function(data) {
        // Check if a genre is selected
        if (genre) {
          // Filter books by genre
          var filteredBooks = data.filter(function(book) {
            return book.genre === genre;
          });
  
          // Display the filtered books
          displayBooks(filteredBooks);
        } else {
          // No genre selected, display all books
          displayBooks(data);
        }
      })
      .catch(function(error) {
        console.log('Error: ' + error.message);
      });
  }
  
  // Button click event handler
  function onGenreButtonClick(genre) {
    // Call the filterBooksByGenre function with the selected genre
    filterBooksByGenre(genre);
  }
  
  // Add a book to the cart
  function addToCart(book) {
    var cartItems = document.getElementById('cart-items');
    var cartCount = document.getElementById('cart-count');
  
    // Create a new item element
    var itemElement = document.createElement('div');
    itemElement.textContent = book.title;
  
    // Append the item to the cart
    cartItems.appendChild(itemElement);
  
    // Update the cart count
    var count = parseInt(cartCount.textContent) || 0;
    cartCount.textContent = count + 1;
  }
  
  // Checkout and rent books from the cart
  function checkoutRent() {
    var cartItems = document.getElementById('cart-items');
    var cartCount = document.getElementById('cart-count');
  
    // Clear the cart items and count
    cartItems.innerHTML = '';
    cartCount.textContent = '0';
  
    // logic for renting the books and processing the checkout
    // ...
  }
  