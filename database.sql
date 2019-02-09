
DROP DATABASE IF EXISTS richInternetApp;
CREATE DATABASE richInternetApp;

USE richInternetApp;

/* Create Tables */

CREATE TABLE users (
    email VARCHAR(128) NOT NULL,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    password VARCHAR(128) NOT NULL,
    PRIMARY KEY (email)
);

CREATE TABLE articles (
    articleId INT(6) AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    bodyText VARCHAR(10000) NOT NULL,
    coverImage VARCHAR(100),
    publishDate DATE NOT NULL,
    PRIMARY KEY (articleId)
);

/* Add Sample Users (userRole can be 1 = admin user, 2 = normal user) */

INSERT INTO users (email, firstName, lastName, password)
VALUES ('admin@comyn.pw','Admin', 'McAdminFace', 'admin');

/* Add Articles */

INSERT INTO articles (title, bodyText, coverImage, publishDate)
VALUES (
'Week 1 - Intro to Rich Internet Applications', 
'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda explicabo culpa quasi repellat earum aut nam voluptas repudiandae labore ipsa. Nostrum, eveniet. Architecto laborum quo minima, excepturi aspernatur modi! Laboriosam.',
'week1-cover.jpg',
'2019-02-08'
);

INSERT INTO articles (title, bodyText, coverImage, publishDate)
VALUES (
'Week 2 - Somesort of Title', 
'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda explicabo culpa quasi repellat earum aut nam voluptas repudiandae labore ipsa. Nostrum, eveniet. Architecto laborum quo minima, excepturi aspernatur modi! Laboriosam.',
'week2-cover.jpg',
'2019-02-11'
);
