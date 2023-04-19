# Open Review
Open Review is a web application similar to [Glassdoor](https://www.glassdoor.com/index.htm) where employees of a company an anonymously review their employers. Open Review also allows users to view statistics/trends of company reviews over time.

## Setup
### AMPPS
The solution stack [AMPPS](https://ampps.com/downloads/) was used to develop the web application. However, only PHP version 8.1 or newer and MySQL is required to run the application.

### Database setup
The application requires a connection to a MySQL database. Before running the application, you must add the credentials (host, data, user, and pass) to the [config.php](resources/config.php) file. To create and populate the tables in the MySQL database the [open_review_s_dump.sql](resources/open_review_s_dump.sql) script can be used. This file is quite large and may take a long time to populate the database as it contains many companies reviews for a select few of those companies.

## Running the application
To run the application, place the project folder inside the `ampps\www\` folder, open up AMPPS and enable/run PHP, and MySQL. Head to [http://localhost:8000/`project-folder`](http://localhost:8000/) in your browser to view the website (or using your own configured AMPPS port).