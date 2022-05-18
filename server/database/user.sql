# Create the user
CREATE USER 'task-user' @'localhost' IDENTIFIED BY '123456';

# Add all PRIVILEGES in the database
GRANT ALL PRIVILEGES ON `todo-app`.* TO 'task-user' @'localhost';