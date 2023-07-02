# Automatic Online Timetable Generator Website

The Automatic Online Timetable Generator Website is a web-based project aimed at simplifying the process of generating timetables hassle-free and without any human errors. This project was developed as part of my academic work, and its main objective is to provide a user-friendly interface for generating schedules quickly and efficiently. It includes features such as a login and logout system, CSS-style features, support for multiple users, and data encryption for enhanced security.

## Implementation

The website is developed using HTML (Hyper Text Markup Language), CSS (Cascading Style Sheet), and PHP (Personal Home Page) languages. The data, including all the timetables and messages created by the admin, is stored in a database. The user details, entered during the sign-up process, are also stored in the database, with encryption applied to sensitive information like passwords. The md5 encryption method is used for password encryption.

The project starts with the index.php file, which serves as the homepage of the website. It includes the necessary HTML, CSS, and PHP code to display the login page. Users can log in using their username and password, which are verified against the encrypted passwords stored in the database. Upon successful login, the user is redirected to the homepage of the website.

The website provides different functionalities based on the user role:

- Admin Login:

  - Create Timetable
  - Time Details
  - Subject Details
  - Add all: Subject and Teacher
  - Remove all: Subject and Teacher
  - Preview and Print Timetable
  - Teacher-Related Accounts Details
  - Student-Related Account Details

- Teacher Login:

  - Timetable: Preview and Print Option
  - File: Upload, Remove, and Change Permission

- Student Login:
  - Preview and Print Timetable
  - File: Search and Download

## Description

The Automatic Online Timetable Generator Website can be used for various purposes, including generating timetables without any errors. It is suitable for educational institutions, private institutes, government offices, and even army purposes. The website also provides a convenient file sharing feature for teachers to store and share files with students. Students can access the files from their personal accounts and download them for offline use.

This project was developed as part of my academic work, and it demonstrates my skills and understanding of web development technologies. It showcases my ability to design and implement a functional and user-friendly web application.

## Installation and Usage

To set up the Automatic Online Timetable Generator Website, follow these steps:

1. Clone or download the repository to your local machine.
2. Set up a compatible web server environment with PHP and MySQL support.
3. Import the provided MySQL database file to create the necessary tables and data.
4. Update the database connection details in the appropriate PHP files.
5. Deploy the website on your web server.

For detailed installation instructions and configuration options, please refer to the documentation provided in the repository.

## Contributions

Contributions to this project are welcome. If you would like to contribute, please follow the guidelines mentioned in the repository's contribution documentation. You can contribute by addressing issues, adding new features, improving code quality, or enhancing the user interface.

## Support and Feedback

If you encounter any issues, have suggestions for improvements, or need assistance with the project, please create an issue in the repository. The project maintainers and community members will be glad to help and provide support.

## License

The Automatic Online Timetable Generator Website is an academic project and does not have a specific license. It is solely for educational purposes and personal use.
