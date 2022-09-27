<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Laravel PDF Upload and Viewer
This is a simple laravel 8 PDF Upload and Viewer app.

## Tech stack used, including specific libraries / versions.
**Front-end side:**<br />
   ○ Bootstrap / Version 5<br />
   
**JS Libraries used** <br/>
    ○ pdf.js /version 2.0.385 <br />
    ○ Alertify / Version 1.13.1<br />
    ○ Jquery / Version 3.6.0<br />

**Back-end side:**<br />
        **Framework:** <br />
            ○ Laravel / Version 8 <br />
        **Database:** <br />
            ○ Mysql <br />


## Project setup guidelines. How to install and run on your local system
1. git clone https://github.com/scriptchief/laravel-pdf-upload
2. cd laravel-pdf-upload-and-viewer/
3. In project path terminal type **composer install**
4. In project path terminal type **npm install**
5. In project path terminal type **cp .env.example .env** (Note: In windows use this command **copy .env.example .env**)
6. In project path terminal type **php artisan key:generate**
7. Add your **database config** in the **.env file** (Note: Enter your database name)
8. In project path terminal type **php artisan migrate** (Note: Make sure phpmyadmin **Apache and Mysql** is started and **database is created**)
9. In project path terminal type **php artisan serve** (if the server opens up, **http://127.0.0.1:8000,**  then we are good to go)

**Note:** sample **pdfuploadandviewer.sql** file there on root folder if you want to skip step 8. Just import the file in your database. 


## Aproach to build the project
First understand the requirements then created a layout. Created all the required fields to upload a pdf with proper
validation both on front and backend side. Listing the data using mysql database with a limit of 10 in descending order.

## What i liked about this project
It is simple for end user to upload and view the pdf without using html iframe/embed/object tags.

## What you didn’t like
It is good project. There is nothing which i don't like.

## Where i faced issues
To convert pdf pages in html canvas.


## Estimated time to complete.
4-5 Hours

## What is pending by your side?
Nothing.