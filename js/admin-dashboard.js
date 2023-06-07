document.getElementById('add-book-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Retrieve form data
    var form = event.target;
    var formData = new FormData(form);

    // Perform form submission using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/add_book.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request was successful
                var response = xhr.responseText;
                console.log(response); // You can handle the response as needed
                form.reset(); // Reset the form fields after successful submission
            } else {
                // Request encountered an error
                console.log('Error: ' + xhr.status);
            }
        }
    };

    xhr.send(formData);
});

function fetchBooks() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './php/get_books.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                displayBooks(response);
            } else {
                console.log('Error: ' + xhr.status);
            }
        }
    };
    xhr.send();
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
        coverImage.width = 100; // Adjust the width as needed
        coverImageCell.appendChild(coverImage);
  
        var actionCell = row.insertCell(7);
        var editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.onclick = function () {
          openEditModal(book.id);
        };
        actionCell.appendChild(editButton);
  
        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = function () {
          deleteBook(book.id);
        };
        actionCell.appendChild(deleteButton);
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

// Function to toggle visibility of the View Books section
function toggleViewBooks() {
    var viewBooksSection = document.getElementById('view-books-section');
    var addBookSection = document.getElementById('add-book-section');
    var adminActions = document.getElementById('admin-actions');

    viewBooksSection.style.display = 'block';
    addBookSection.style.display = 'none';
    adminActions.style.display = 'none';
}

// Function to toggle visibility of the Add Book section
function toggleAddBook() {
    var viewBooksSection = document.getElementById('view-books-section');
    var addBookSection = document.getElementById('add-book-section');
    var adminActions = document.getElementById('admin-actions');

    viewBooksSection.style.display = 'none';
    addBookSection.style.display = 'block';
    adminActions.style.display = 'none';
}

// Fetch the books from the server
fetchBooks();

// Edit Book Modal
var editModal = document.getElementById('edit-modal');
var editForm = document.getElementById('edit-book-form');
var editMessage = document.getElementById('edit-message');

function openEditModal(bookId) {
    // Reset the form and message
    var editForm = document.getElementById('edit-book-form');
    if (editForm) {
        editForm.reset();
        editMessage.textContent = '';

        // Get the book data
        getBookById(bookId)
            .then(function(book) {
                if (book) {
                    // Pre-fill the form with the book data
                    editForm.elements['id'].value = book.id;
                    editForm.elements['edit-title'].value = book.title;
                    editForm.elements['edit-author'].value = book.author;
                    editForm.elements['edit-description'].value = book.description;
                    editForm.elements['edit-genre'].value = book.genre;
                    editForm.elements['edit-availability'].value = book.availability;
                    editForm.elements['edit-quantity'].value = book.quantity;

                    // Show the edit modal
                    editModal.style.display = 'block';
                }
            })
            .catch(function(error) {
                console.log('Error: ' + error.message);
            });
    } else {
        console.log('Error: edit-book-form not found');
    }
}

function closeEditModal() {
    // Hide the edit modal
    fetchBooks();
    editModal.style.display = 'none';
}

// Function to update a book
function updateBook(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Retrieve form data
    var form = event.target;
    var formData = new FormData(form);

    // Perform form submission using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/update_book.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request was successful
                console.log('Response:', xhr.responseText); // Log the response text

                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log('Parsed response:', response); // Log the parsed response object

                    if (response.success) {
                        editMessage.textContent = 'Book updated successfully!';
                        // Refresh the book table
                        fetchBooks();
                    } else {
                        editMessage.textContent = 'Failed to update book. Please try again.';
                    }
                } catch (error) {
                    console.log('Error parsing JSON response:', error);
                }
            } else {
                // Request encountered an error
                console.log('Error: ' + xhr.status);
            }
        }
    };

    xhr.send(formData);
}
document.getElementById('edit-book-form').addEventListener('submit', updateBook);


// Delete a book
function deleteBook(bookId) {
    if (confirm('Are you sure you want to delete this book?')) {
        // Send a DELETE request to the server
        var xhr = new XMLHttpRequest();
        xhr.open('DELETE', './php/delete_book.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Book deleted successfully, refresh the book table
                        fetchBooks();
                    } else {
                        console.log('Failed to delete book');
                    }
                } else {
                    console.log('Error: ' + xhr.status);
                }
            }
        };

        // Send the book ID in the request body
        xhr.send(JSON.stringify({ bookId: bookId }));
    }
}

// Function to retrieve a book by its ID
function getBookById(bookId) {
    // Fetch books from the server and filter by ID
    return fetch('php/get_books.php')
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error: ' + response.status);
            }
        })
        .then(function(data) {
            // Find the book with the matching ID
            return data.find(function(book) {
                return book.id === bookId;
            });
        })
        .catch(function(error) {
            console.log('Error: ' + error.message);
        });
}