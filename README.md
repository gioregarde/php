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
