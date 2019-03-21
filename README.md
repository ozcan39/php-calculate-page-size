# php-calculate-page-size
This PHP code calculates the size of any web page by checking the elements on the page. Calculations are made by detecting "javascript, css, ico and img" elements on the page. While detecting the elements, PHP DOMelement is used. After detection, it uses php curl for calculation.

# Usage
After including the class, "calculate" function is used. Web page url is the only parameter for "calculate" function.

```php
include('page_size.php');
$cal = new page_size();

$url='http://...';
echo $cal->calculate($url);
```

# Changes can be made
I used this class for one of my project which included just "http" adresses and "javascript, css, ico and img" element types. It sould be changed for "https" adresses. Also, if there are another element types which are going to be detected, the class needs to be changed.
