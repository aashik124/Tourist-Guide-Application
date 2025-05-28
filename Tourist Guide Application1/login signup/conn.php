<?php
$host='localhost';
$user='root';
$password='';
$db='touristguide';
$con = mysqli_connect($host,$user,$password,$db);
//     if(!$con){
//         echo"connection failed";
//     }
//     else{
//         echo"connection Success";
//         }
     //Query to create database
     $db_query= "CREATE DATABASE  IF NOT EXISTS TouristGuide";//Query/statement

     //return true value if query executed successfully
             $query = mysqli_query($con,$db_query);
           
             // if(!$query){
             //     echo"<br>unable create database";
             // }
             // else{
             //echo"<br> database successfully created ";
             // }
              
         
     //Query create table
     $tbl_query="CREATE TABLE  if not exists user_tbl(id INT PRIMARY KEY auto_increment,Username varchar(50),Email varchar(50),Phone_no varchar(15),gender  varchar(10),Password varchar(60),verification_code VARCHAR(255), is_verified BOOLEAN NOT NULL DEFAULT 0)";
        $query1=mysqli_query($con,$tbl_query);
        //      if(!$query1){
        //          echo"<br>unable create table";
        //      }
        //      else{
        //           echo"<br> create table successfully"; 
        //   } 
        ?>