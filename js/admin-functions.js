

$('.stop-submit').submit(function (e) {
    e.preventDefault();
});

//Submit form to add books
$('#add-book-form').submit(function (e) {

    let form = document.querySelector('form');
        formData = new FormData(form);

    $.ajax({
        processData: false,
        contentType: false,

        url: './php/add_book.php',
        type: 'POST',
        data: formData,
        success: function(response,responseStatus){
            console.log(responseStatus); // You can handle the response as needed
            form.reset(); // Reset the form fields after successful submission
            previewFile();
        },
        error: function(response,responseStatus){
            console.log("Error: "+responseStatus);
        }
    });
});

function fetchBooks() {
    $.ajax({
        url: "./php/get_books.php",
        method: "GET",
        success: function(response, responseStatus){
            console.log(response);
            displayBooks(response);
        },
        error: function(response,responseStatus){
            console.log("Error: "+responseStatus);
        }
    });
}


//Preview cover images
function previewFile() {
    var preview = $('#cover');
    var file 	= document.querySelector('#cover_image').files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.attr("src", reader.result);
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.attr("src","");
    }
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
        var node = document.createElement("div");
        node.innerHTML += "<form class='stop-submit m-0' action='php/library_functions.php' method='post'><input type='hidden' class='m-0' name='delete' value='"+book.id+"'><input type='submit'  class='bg-transparent text-secondary w-100 m-0' value='Delete'></form>";
        node.innerHTML += "<form class='stop-submit m-0' action='php/library_functions.php' method='post'><input type='hidden' class='m-0' name='edit' value='"+book.id+"'><input type='submit'  class='bg-transparent text-secondary w-100 m-0' value='Edit'></form>";
        actionCell.appendChild(node);
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


//Toggle main body
$('.book-toggle').click(function() {
    $('.admin-panels').hide();
    var target = '#' + $(this).data('target');
    $(target).show();
});

$('.admin-panels').hide();
$("#main-dashboard").show();
filterBooksByGenre();
