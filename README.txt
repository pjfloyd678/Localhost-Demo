UPC Code Check
==================
These PHP scripts validate if a UPC code is valid.

1. Specifications
===================
The following specifications were provided:

UPC codes are a set of 12 numbers unique to a product. The last digit of the UPC code is called a check digit. This allows the scanner to perform an internal algorithm that constitutes the accuracy of the barcode content. Here is how the check digit is calculated for the other 11 digits, using the code 6 3938200039 3 in this example;

1. Add together the value of all of the digits in odd positions (digits 1, 3, 5, 7, 9 and 11).  [6 + 9 + 8 + 0 + 0 + 9 = 32];
2. Multiply that number by 3.  [32 * 3 = 96];
3. Add together the value of all of the digits in even positions (digits 2, 4, 6, 8 and 10).  [3 + 3 + 2 + 0 + 3 = 11];
4. Add this sum to the value in step 2.  [96 + 11 = 107];
5. Take the number in Step 4. To create the check digit, determine the number that, when added to the number in step 4, is a multiple of 10.  [107 + 3 = 110];
6. The check digit is therefore 3.

2. The Assignment
===================
Verify whether or not the UPC code “8 7283272832 4” is a valid code. Return true if the UPC code is valid, or false if the UPC code is not valid. 

3. Provided Answers
====================
I have provided 2 different ways to run the code for this assignment:
A.  Simple script
B.  Stand-alone web page

A. Simple Script - upccheck_simple.php
=======================================
This is a very simple script with no-validation. The script only takes 10 lines of code.

There are 1 way to execute the script and that is using the command line.
From the command-line (with PHP in the path), you can execute the script by running the following:
    php upccheck_simple.php "[UPC Code]"
    where:
        [UPC Code] = The UPC Code to check. Note: If there are spaces, place the UPC Code in Quotes.
    return: true or false (JSON)

Examples:
php upccheck_simple.php "6 3938200039 3"
  - returns: true
php upccheck_simple.php 872832728324
  - returns: false
php upccheck_simple.php "7 84236487230"
  - returns: true

B. Detailed Script with Validation - upccheck.php
==================================================
This is a more detailed version of the upccheck_simple.php script which includes validation and an option for detailed return values

The following script checks for:
1. A UPC Code must be provided.
2. The UPC Code must be 12 characters long.
3. The UPC Code must be all numeric.

The script also allows for different types of return values:
1. Simple JSON true or false.
2. Detailed JSON response with a code and text.

4. How to execute the script
==============================
There are 2 ways to execute the script
1.  Command Line
        upccheck.php "[UPC Code]" [debug]
    where:
        [UPC Code] = The UPC Code to check. Note: If there are spaces, place the UPC Code in Quotes.
        [debug] = If you would like a detailed response, use 1 (Optional)

2.  Website URL
        upccheck.php?upccode=[UPC Code]&debug=1
    where:
        [UPC Code] = The UPC Code to check. Please provide code without spaces or replaces spaces with "%20"
        [debug] = If you would like a detailed response, use 1 (Optional)

If you would like to view the web page, extract the files from upc.zip to a folder in any PHP based web container and run:
Example:
    http://localhost/upc/index.html

or do the following (with PHP in the path):
1. Extract the files from upc.zip to a folder (Ex: upc)
2. From a command line, do the following:
    a. Go into the new folder (Ex: cd upc)
    b. type the following: 
        php -S localhost:8080
        This will load a stand alone PHP server using upc folder as the base.
3. Open your favourite browser and go to: 
    http://localhost:8080

5. Script Return values
========================
The return values are as follows:
1. JSON true or false
2. JSON Array with the following: (If the debug value = 1)
    code: This is a code returned back from the script:
        200 - valid
        410 - No Command Line Argument (UPC Code) provided.
        411 - No UPC Code provided.
        412 - Invalid UPC Code (L:[Number]) - Length error - [number] = length provided 
        413 - Invalid UPC Code (Non-Numeric Value found)
        414 - Invalid UPC code ([number]) - Invalid UPC Code - [number] = the final total

If you have any questions, please feel free to contact me, Peter Floyd, at peterjfloyd@gmail.com with any questions.
