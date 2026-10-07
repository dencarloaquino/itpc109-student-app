# ITPC 109 – Student Information Management System

A Dockerized PHP + MySQL web application developed for the ITPC 109 Web Systems and Technologies laboratory activity.

## Technologies Used

- PHP 8.3
- Apache
- MySQL 8.4
- phpMyAdmin
- Docker Desktop
- Docker Compose
- Git and GitHub

## Application Features

- Add student records
- View student records
- Edit student records
- Update student records
- Delete student records
- MySQL database persistence
- phpMyAdmin database administration

## Project Structure

```text
itpc109-student-app/
├── docker/php/Dockerfile
├── src/
├── db/init.sql
├── compose.yaml
├── .gitignore
└── README.md

How to Run

Start the application:

docker compose up -d --build

Application:

http://localhost:8080

phpMyAdmin:

http://localhost:8081

Database

Database name:

student_db

Database user:

student_user

The application connects to the MySQL container using the Docker Compose service name db.

Stop the Application
docker compose down
Start Again
docker compose up -d
Author

ITPC 109 Student
