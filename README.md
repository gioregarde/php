# PHP Basic Syntax

### escaping
```php
<?php
    // php code
?>
```

### comments
```php
# comment
// comment
/*
multiline
comment
*/
/**
 * Class Description
 * @author
 * Function Description
 * @param
 * @return
 */
```

### variables
```php
$string = 'string';
$array = array(1, 2, 3, 4, 5);
$key_value = array("key_1" => 1, "key_2" => 2, "key_3" => 3);
```

### print variables
```php
$string = 'world';
echo "hello $string";
echo 'hello '.$string;
print_r($string);
echo print_r($string, true);
```

### functions
```php
function function_name() {
    # function code
    return 'return_value';
}
```

### variable scope
* GLOBAL
```php
$somevar = 15;
function function_name() {
    GLOBAL $somevar; // $somevar = 15 will be used
}
```
* static
```php
function function_name() {
   STATIC $count = 0; // this will be persistent
   $count++;
}
function_name();
function_name();
```
### constants
Only scalar data (boolean, integer, float and string) can be contained in constants.
```php
define("CONSTANT_NAME", 50);
echo CONSTANT_NAME;
```
### magic constants

Name | Description
-----|------------
\_\_LINE\_\_ | current line
\_\_FILE\_\_ | full path and file name of the file
\_\_DIR\_\_ | full directory path of the file. Equivalent to dirname(__file__)
\_\_FUNCTION\_\_ | function name
\_\_CLASS\_\_ | class name
\_\_TRAIT\_\_ | trait name (inside function)
\_\_METHOD\_\_ | class method
\_\_NAMESPACE\_\_ | current namespace

### additional constants

Name | Description
-----|------------
PHP_EOL | correct 'End Of Line' symbol for this platform

### arithmetic operators : assume a = 10 and b = 20.

Operator | Description | Example
---------|-------------|--------
\+ | Addition |a + b = 30
\- | Subtraction | a - b = -10
\* | Multiplication | a * b = 200
\/ | Dividision | b / a = 2
\% | Modulus Operator | b % a = 0
\++ | Increment by one | a++ = 11
\-- | Decrement by one | a-- = 9

### comparison operators : assume a = 10 and b = 20.

Operator | Description | Example
---------|-------------|--------
== | equal | A == B is false
!= |not equal | A != B is true
\> | greater than | A > B is false
\< | less than | A < B is true
\>= | greater than or equal | A >= B is false
\<= | less than or equal | A <= B is true

### logical operators : assume a = true and b = false.

Operator | Description | Example
---------|-------------|--------
and | AND operator | A and B is false
or | OR Operator | A or B is true
&& | AND operator (non zero) | A && B is false
\|\| | OR Operator (non zero) | A \|\| B is true
! | NOT Operator (reverses the logical state) | !(A && B) is true

### assignment operators : assume a = 10 and b = 20.

Operator | Description | Example
---------|-------------|--------
= | assigns values | C = A + B
+= | adds to the current value | C += A -> C = C + A
-= | substract to the current value | C -= -> C = C - A
*= | multiply to the current value  | C *= -> C = C * A
/= | divide to the current value  | C /= A -> C = C / A
%= | assigns the remainder | C %= A -> C = C % A

### conditional operator

Operator | Description | Example
---------|-------------|--------
?: | shorthand if statement | if condition ? then value : otherwise value;

### if-else statement
```php
if (condition) {
    // if true
} else {
    // then false
}
```

### elseif statement
```php
if (condition) {
    // if true
} elseif (condition) {
    // if true
} else{
    // then false
}
```

### switch statement
```php
switch (expression) {
    case case_1:
        // if case_1
        break;
    case case_2:
        // if case_2
        break;
    default:
        // default case
}
```

### for loop statement
```php
for (initialization; condition; increment) {
    // php code
}
```

### while loop statement
```php
while (condition) {
    // php code
}
```

### do-while loop statement
```php
do {
    // php code
} while (condition);
```

### The foreach loop statement
```php
foreach (array as key => value) {
    // php code
}
```

### Magic Methods
functions declared inside a class

Function | Description
---------|------------
__construct() | call this method on each newly-created object
__destruct() | will be called as soon as there are no other references to a particular object
__call() | triggered when invoking inaccessible methods in an object context
__callStatic() | triggered when invoking inaccessible methods in a static context
__get() | run when writing data to inaccessible properties
__set() | utilized for reading data from inaccessible properties
__isset() | triggered by calling isset() or empty() on inaccessible properties
__unset() | invoked when unset() is used on inaccessible properties
__sleep() | serialize() checks if your class has a function with the magic name __sleep()
__wakeup() | unserialize() checks for the presence of a function with the magic name __wakeup()
__toString() | allows a class to decide how it will react when it is treated like a string
__invoke() | called when a script tries to call an object as a function
__set_state() | called for classes exported by var_export()
__clone() | Once the cloning is complete $obj2 = clone $obj
__debugInfo() | called by var_dump()

### string manipulation
* concat strings 
```php
    echo $string1.' '.$string2;
```

* string length
```php
    echo strlen("Hello world!");
```

* search for string (return index)
```php
    echo strpos("Hello world!", "world");
```

* returns portion of string
```php
    echo substr('Hello world!',  0,  2);  // returns "He"
    echo substr('Hello world!',  0, -2);  // returns "Hello worl"
    echo substr('Hello world!',  2,  2);  // returns "ll"
    echo substr('Hello world!',  2, -2);  // returns "llo worl"
    echo substr('Hello world!', -2,  2);  // returns "d!"
    echo substr('Hello world!', -3, -1);  // returns "ld"
```

### Filters
The PHP filters is used to sanitize and validate and data coming from insecure sources, like user input.

* filter functions

Function | Description
---------|------------
filter_has_var() | checks if variable of specified type exists
filter_id() | returns the ID number of a specified filter
filter_input() | gets a specific external variable by name and optionally filters it
filter_input_array() | gets multiple external variables and optionally filters them
filter_list() | returns an array of all supported filters
filter_var_array() | gets multiple variables and optionally filters them
filter_var() | filters a variable with a specified filter

* sanitize filters

ID | Description
---|------------
FILTER_SANITIZE_EMAIL | remove all characters except letters, digits and !#$%&'*+-/=?^_`{|}~@.[]
FILTER_SANITIZE_ENCODED | URL-encode string, optionally strip or encode special characters.
FILTER_SANITIZE_MAGIC_QUOTES | apply addslashes().
FILTER_SANITIZE_NUMBER_FLOAT | remove all characters except digits, +- and optionally .,eE
FILTER_SANITIZE_NUMBER_INT | remove all characters except digits, plus (+) and minus (-) sign.
FILTER_SANITIZE_SPECIAL_CHARS | HTML-escape '"<>& and characters with ASCII value less than 32, optionally strip or encode other special characters.
FILTER_SANITIZE_STRING | strip tags, optionally strip or encode special characters.
FILTER_SANITIZE_STRIPPED | alias of "string" filter.
FILTER_SANITIZE_URL | remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=
FILTER_UNSAFE_RAW | do nothing, optionally strip or encode special characters.

* validate filters

ID | Description
---|------------
FILTER_VALIDATE_BOOLEAN | returns TRUE for "1", "true", "on" and "yes". Returns FALSE otherwise.
FILTER_VALIDATE_EMAIL | validates value as e-mail.
FILTER_VALIDATE_FLOAT | validates value as float.
FILTER_VALIDATE_INT | validates value as integer optionally from the specified range.
FILTER_VALIDATE_IP | validates value as IP address, optionally only IPv4 or IPv6 or not from private or reserved ranges.
FILTER_VALIDATE_REGEXP | validates value against regexp, a Perl-compatible regular expression.
FILTER_VALIDATE_URL | validates value as URL, optionally with required components.

### References
* http://php.net/manual/en/indexes.functions.php