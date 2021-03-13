# Let'sRate 
College project: A simple movie rating website which allows you to rate and view the comment of each movies, the rating and comment will also make public.

# Installation
Create a MySQL database for the website by referring to the database_dump.sql.
Put all the images of moive into a "image" folder and named with number. 
Open the index.php with web browser.

# Features
All users are anonymous user till they have registered to be a normal user and logged in.
Your identity can be distinguished by looking at the navigation bar.
If you are normal user, your italicized uesrname will be displayed next to the account icon.
If you are anonymous user, there are no username next to the account icon.

Right of anonymous user: 
view the list of movies, details of movies, comments of movies from normal user.

Right of normal user:
all the right of anonymous user, rate movies, comment movies
*A user can only rate a particular movie once, and cannot change the rating afterwards

Navigation bar:
Home - Home page of the website
All movies - List of movies
Register - Register form
Login - Login form
Logout - Logout (only occur when user logged in)
Search - Case-insensitive search function (keywords typed by user will be searched by title, description, genre, director, starring, language, running time and releasedate)

List of movies only show parts of the detail of a movies and 'View/Rate' button.
'View/Rate' button - redirect to the detail page of the movie.

Detail page of the movies:
The page include all the details of the movie, average score, comments.
Rate function - click the star button to represent intended score (1 to 5, where 1 is lowest, 5 is highest).
Comment function - type the comment in the text area.

# Built With
HTML, CSS, JavaScript, PHP, MySQL Database, Bootstrap

# Copyright
Constructed by Peter CHUI.
All images in the website are come from internet.
