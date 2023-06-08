// Fetch books from the server
function fetchBooks() {
    // Make an AJAX request to fetch the books
    fetch('./php/get_books.php')
      .then(response => response.json())
      .then(data => {
        // Clear the table body
        var table = document.getElementById('book-list');
        table.innerHTML = '';
  
        // Iterate over the books and add rows to the table
        data.forEach(book => {
          var row = table.insertRow();
  
          // Add cells to the row
          var titleCell = row.insertCell();
          titleCell.textContent = book.title;
  
          var authorCell = row.insertCell();
          authorCell.textContent = book.author;
  
          var descriptionCell = row.insertCell();
          descriptionCell.textContent = book.description;
  
          var genreCell = row.insertCell();
          genreCell.textContent = book.genre;
  
          var availabilityCell = row.insertCell();
          availabilityCell.textContent = book.availability ? 'Available' : 'Not Available';
  
          var quantityCell = row.insertCell();
          quantityCell.textContent = book.quantity;
  
          var coverImageCell = row.insertCell();
          var coverImage = document.createElement('img');
          coverImage.src = book.cover_image;
          coverImage.alt = book.title;
          coverImageCell.appendChild(coverImage);
  
          var actionsCell = row.insertCell();
          var rentButton = document.createElement('button');
          rentButton.textContent = 'Rent';
          rentButton.onclick = function () {
            addToCart(book);
            updateBookQuantity(book.id, book.quantity);
          };          
          actionsCell.appendChild(rentButton);
        });
      })
      .catch(error => {
        console.error('Error fetching books:', error);
      });
  }
  

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

// Function to retrieve the book ID
function getBookIdFromServer(bookId) {
  return fetch(`./php/get_book_id.php?bookId=${bookId}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Failed to retrieve book ID');
      }
      return response.json();
    })
    .then(data => {
      console.log('Response from server:', data); // Log the response
      if (data.success) {
        return data.id; // Retrieve the correct property name
      } else {
        throw new Error(data.message);
      }
    })
    .catch(error => {
      console.error('Failed to retrieve book ID:', error);
      throw error;
    });
}


// Add a book to the cart
function addToCart(book) {
  var cartItems = document.getElementById('cart-items');
  var cartCount = document.getElementById('cart-count');

  // Retrieve the book ID using the getBookIdFromServer function
  getBookIdFromServer(book.id)
    .then(bookId => {
      if (bookId !== null) {
        // Create a new item element
        var itemElement = document.createElement('div');
        itemElement.textContent = book.title;
        itemElement.setAttribute('data-book-id', bookId);

        // Append the item to the cart
        cartItems.appendChild(itemElement);

        // Update the cart count
        var count = parseInt(cartCount.textContent) || 0;
        cartCount.textContent = count + 1;
      } else {
        console.error('Failed to retrieve valid book ID for:', book.title);
      }
    })
    .catch(error => {
      console.error('Failed to retrieve book ID:', error);
    });
}
  function checkoutRent() {
  var cartItems = document.getElementById('cart-items');
  var cartCount = document.getElementById('cart-count');

  // Retrieve the cart items
  var items = cartItems.children;
  var books = [];

  // Retrieve the book IDs from the cart items
  var promises = Array.from(items).map(item => {
    var bookId = item.getAttribute('data-book-id');

    // Retrieve the actual book ID using getBookIdFromServer function
    return getBookIdFromServer(bookId)
      .then(actualBookId => {
        if (actualBookId !== null) {
          // Push the book object to the books array
          books.push({ id: actualBookId });
        }
      });
  });

  // Wait for all promises to resolve
  Promise.all(promises)
    .then(() => {
      // Clear the cart items and count
      cartItems.innerHTML = '';
      cartCount.textContent = '0';

      // Call the addToConfirmationTable function to add the books to the confirmation table
      addToConfirmationTable(books);

      // Update book quantities in the table and database
      for (var j = 0; j < books.length; j++) {
        var book = books[j];
        updateBookQuantity(book.id, 1);
      }

      // Refresh the book list to update the quantity in the table
      fetchBooks();
    })
    .catch(error => {
      console.error('Failed to retrieve book ID:', error);
    });
}
  
  
  function updateBookQuantity(bookId, rentedQuantity) {
    // Create a new FormData object
    var formData = new FormData();

    // Append the bookId and rentedQuantity to the FormData object
    formData.append('bookId', bookId);
    formData.append('rentedQuantity', rentedQuantity);

    // Make an AJAX request to update the quantity in the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/update_book_quantity.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Book quantity successfully updated in the database
                        console.log('Book quantity updated in the database');
                        console.log('Response:', response);
                    } else {
                        // Error updating book quantity
                        console.error('Failed to update book quantity:', response.message);
                    }
                } catch (error) {
                    // Error parsing JSON response
                    console.error('Failed to parse JSON response:', error);
                }
            } else {
                // Error making the request
                console.error('Failed to update book quantity:', xhr.statusText);
            }
        }
    };

    // Send the FormData object as the request body
    xhr.send(formData);
}

// Books to Confirm
// Function to add books to the confirmation table
function addToConfirmationTable(books) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', './php/add_to_confirmation_table.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          console.log('Books added to confirmation table');
        } else {
          console.error('Failed to add books to confirmation table:', response.message);
        }
      } else {
        console.error('Failed to add books to confirmation table:', xhr.statusText);
      }
    }
  };

  xhr.send(JSON.stringify({ books: books }));
}

function fetchConfirmationBooks() {
  fetch('./php/get_confirmation_books.php')
    .then(response => response.json())
    .then(data => {
      renderConfirmationBooks(data);
    })
    .catch(error => {
      console.error('Error fetching confirmation books:', error);
    });
}

function renderConfirmationBooks(books) {
  const confirmationList = document.getElementById('confirmation-list');

  // Clear existing table rows
  confirmationList.innerHTML = '';

  books.forEach(book => {
    const row = document.createElement('tr');

    const titleCell = document.createElement('td');
    titleCell.textContent = book.title;
    row.appendChild(titleCell);

    const authorCell = document.createElement('td');
    authorCell.textContent = book.author;
    row.appendChild(authorCell);

    const descriptionCell = document.createElement('td');
    descriptionCell.textContent = book.description;
    row.appendChild(descriptionCell);

    const genreCell = document.createElement('td');
    genreCell.textContent = book.genre;
    row.appendChild(genreCell);

    const rentDateCell = document.createElement('td');
    rentDateCell.textContent = book.rent_date ? book.rent_date : 'Not available';
    row.appendChild(rentDateCell);

    const returnDateCell = document.createElement('td');
    returnDateCell.textContent = book.return_date ? book.return_date : 'Not available';
    row.appendChild(returnDateCell);

    const statusCell = document.createElement('td');
    statusCell.textContent = book.status ? book.status : 'Not available';
    row.appendChild(statusCell);

    const requestedByCell = document.createElement('td');
    requestedByCell.textContent = book.request_by ? book.request_by : 'Not available';
    row.appendChild(requestedByCell);

    confirmationList.appendChild(row);
  });
}

// Call the function to fetch and display the confirmation books
fetchConfirmationBooks();
