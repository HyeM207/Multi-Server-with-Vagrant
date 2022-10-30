# vagrant_multi_vm
### Building a Multi-Server Environment with Vagrant  
Mini Project in Lecture 'Cloud Computing Services Security Management' (Seoul Women's University) 
<br/><br/>  

## 📝 Project 1_One DB Server and Two Web Server
Two Web servers refer to the DB tables of one DB server to manage the data, and each web server refers to a different database table.

> Two Web Server(Web server1/2) with One DB Server (DB server1) 

- 'Web server1' references 'response1' table in DB server1
- 'Web server2' references 'response2' table in DB server1

The table that you modify depends on which web server you connect to.  
<br/>
<br/>

## 📝 Project 2_Two DB Server and One Web Server
One Web server refers to the DB tables of two DB servers to manage the data, and each DB server has one database.  
The Input data on the Web server ara stored on two DB servers at the same time.  


> One Web Server(Web server1) with Two DB Server (DB server1/2) 

- 'Web server1' references 'response' table in DB server1
- 'Web server1' references 'response' table in DB server2

This enables service operations based on other DB servers, even if one DB server fails.
<br/>
