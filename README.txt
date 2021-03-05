PDF Application is a php CMS which relies on fpdf, and whicws a server administrator to deploy the presentation of a contract, 
allows the user to sign the contract, outputs the contract to a PDF file, and then allows both the user and the administrator 
access to the output pdf file.  

The login information for the user site, located at https://pdfapplication.000webhostapp.com
is:

username is either test or administrator, 
and password is password.

Installation of this package should be straight forward for those whom are experienced in dealing with a LAMP server,
so detail will not be given here. Refer to fpdf's documentation to learn how to use fpdf. This package requires a
fair bit of understanding php in order to use it effectively. It is not for the novice.
The main files that you will want to change for your purposes with respect to content are:
/scripts/connect.php
/inc/ipsum.txt 
/sign.php
/pdfexample.php

The scripts folder contains connect.php in which the SQL database connection informaton should be set.
SQL.txt contains the names and structure of the SQL tables necessary to run the applicaton. 

Questions about, and bugs related to, fpdf should be directed to http://fpdf.org.
Bugs pertaining directly to fpdf and "how do I" questions pertaining directly to fpdf 
will be automatically closed without comment if sumbmitted here. 
