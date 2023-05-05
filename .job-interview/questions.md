## Questions :star2:

### Question 1. 

In a task it requires you to identify a string that contains the word "laravel" (case-insensitive). You've written the following code:

```
<?php

if (!strpos(strtolower($str), 'laravel')) {
    throw new Exception();
}

```

QA has come and said that it works for the string "I work with laravel", but not in the string "Laravel is great!", which should work as well. Explain why this happened, and how you would solve it using strpos().

**Answer: That happened because 'Laravel' begins with L in uppercase, while the code only accept it in lowercase**

**Solution: For this task I would use a REGEX expression to identify a string contains a word. But if it must use strpos() I would add another if sentence**


```
<?php

if (!strpos(strtolower($str), 'laravel') && !strpos(strtolower($str), 'Laravel')) {
    throw new Exception();
}

```

### Question 2. 

A client has called and said that they're noticing performance problems on their database when searching for a user by email address. You've checked, and the following query is running:

```
SELECT * FROM users WHERE email = 'user@test.com';
```

| id | select_type | table | type | possible_keys | key | key_len | ref | rows | Extra
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |
| 1 | SIMPLE | users | ALL | NULL | NULL | NULL | NULL | 10320 | Using where

**Answer: There is no indexation in the table. There should be a pagination in order to get less data instead of getting 10320 rows. Select All data for the user probably is not neccesary, only get specific important data (Select name, surname, email ... )**.

### Question 3.

Starting with PHP 5.5, what is the recommended way to hash user passwords? Show some code that illustrates how you would hash a user's password, and also how you would check that a password supplied by a user matches the password on file.

If your client cannot upgrade to PHP 5.5, and you have to hash passwords using existing PHP libraries, what is one library/package that makes this easy?

**Answer**: 

### Question 4. 

You're given a sorted index array that contains no keys. The array contains only integers, and your task is to identify whether or not the integer you're looking for is in the array. Write a function that searches for the integer and returns true or false based on whether the integer is present. Describe how you arrived at your solution.

### Question 5 

During a large data migration, you get the following error: Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 54 bytes). You've traced the problem to the following snippet of code:

```
$stmt = $pdo->prepare('SELECT * FROM large_table');
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $result) {
    // manipulate the data here
}
```

Refactor this code so that it stops triggering the memory error

**Answer: Getting all data with fetchAll makes the memory get fulled. Get one by one could be better**

```
$stmt = $pdo->prepare('SELECT * FROM large_table');
$stmt->execute();

while($result = $place->fetch(PDO::FETCH_ASSOC)){
    // manipulate the data here
}
```

**Ff the last code makes so many queries, I would use chucks to get 100 by 100 results**

### Question 6 

Write a function that takes a phone number in any form and formats it using a delimiter supplied by the developer. The delimiter is optional; if one is not supplied, use a dash (-). Your function should accept a phone number in any format (e.g. 123-456-7890, (123) 456-7890, 1234567890, etc) and format it according to the 3-3-4 US block standard, using the delimiter specified. Assume foreign phone numbers and country codes are out of scope.

Note: This question CAN be solved using a regular expression, but one is not REQUIRED as a solution. Focus instead on cleanliness and effectiveness of the code, and take into account phone numbers that may not pass a sanity check.

**Answer: I would use a regex, using three groups with "()" to get the specific data, using "." to specify any delimiter, using "\\(?" and "\\)?" to be optional the parenthesis in the first numbers**

```
public function cleanPhoneNumber(string $phoneNumber){
    if(preg_match(
        '^\(?([\d]{3,3})\)?.([\d]{3,3}).([\d]{4,4})$',
        $phoneNumber,
        $numbers
     )) {
        return "{$numbers[0]-$numbers[1]-$numbers[2]}";
    } else {
        throw new Error();
    }
}
```

### Question 7

In production, we'll be caching to memcache. On staging, we'll be caching to APC. In development, we won't be caching at all. Design a library that allows you to store and retrieve data from the cache (only two methods required) and fits the requirements of all three environments. Consider making use of anything appropriate (e.g. traits, classes, interfaces, abstract classes, closures, etc) to solve this problem.

Note: This is an architecture question. Please focus on the design of your library, rather than implementation or the specific caches I've described.

### Question 8

Write a complete set of unit tests using PHPUnit for the following code:

```
function fizzBuzz($start = 1, $stop = 100)
{
    $string = '';
	
    if ($stop < $start || $start < 0 || $stop < 0) {
        throw new InvalidArgumentException();
    }
	
    for ($i = $start; $i <= $stop; $i++) {
        if ($i % 3 == 0 && $i % 5 == 0) {
            $string .= 'FizzBuzz';
            continue;
	}
		
        if ($i % 3 == 0) {
            $string .= 'Fizz';
            continue;
        }
		
	if ($i % 5 == 0) {
	    $string .= 'Buzz';
	    continue;
	}
		
	$string .= $i;
    }
	
    return $string;
}
```

### Question 9

I've developed a class called Select to represent the SELECT statements I'd normally write for a database. I want to be able to use the Select objects as queries and automatically cast them to strings, but when I use them in PDOStatement::execute() I get the following error: Catchable fatal error: Object of class Select could not be converted to string. What should I change in my Select class so that this error goes away?

### Question 10

I have an array of file names:

```
$files = [
    '/usr/share/nginx/wordpress/wp-content/themes/index.php',
    '/usr/share/nginx/wordpress/wp-content/themes/mytheme.php',
    '/usr/share/nginx/wordpress/wp-content/plugins/myplugin.php',
    '/usr/share/nginx/wordpress/wp-content/plugins/akismet.php',
    '/usr/share/nginx/wordpress/wp-content/uploads/november.jpg',
];
```

Below is a mixed list of specific file names, as well as file paths, that should be excluded. For example, ALL files under a file path should be excluded, but if the value is an actual file name, only that specific file should be excluded.

```
$exclude = [
    '/usr/share/nginx/wordpress/wp-content/uploads',
    '/usr/share/nginx/wordpress/wp-content/plugins/myplugin.php',
];
```

For example, you'll want to exclude the uploads directory (and all files in it), but ONLY the myplugin.php file.

Devise a method for applying the exclusion list against the file list WITHOUT nested foreach() loops.
