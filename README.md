# authable-behavior
Small Propel Behaviour to add password hash checking to a table.

Internally it uses http://php.net/manual/en/function.password-hash.php





### Configuration ###

``` xml
<behavior name="authable">    
    <!-- Optional parameters, with default values -->
    <parameter name="hash_column" value="authhash" />
    <parameter name="algo" value="PASSWORD_DEFAULT" />
    <parameter name="hide_column" value="true" />
</behavior>
```

If it does not exist, the `hash_column` will be created in the next `propel diff`

Algo options are straight from the password hash function. `PASSWORD_DEFAULT`, `PASSWORD_BCRYPT`, etc. 


By default the behaviour will try and hide the hashed password from the get and toArray functions, replacing the hash with '*******'  
   *More work is required in this area.*   
But, this feature can be disabled by setting the parameter `hide_column` to `false`

## To do

* Tag git, and setup https://packagist.org/
* Paramter for masked hash 
* Examples
* hide_column feature
* Unit Testing


## Notes
This project started out just being a leaning tool for my self and wanting to know more about how Propel behaviors work.


*thankyou to https://github.com/donkeycode/propel-uuid-behavior for the for some of the inital project layout etc*


[![wakatime](https://wakatime.com/badge/user/76584d9d-5b41-46e5-8997-1dba7fa49c33/project/6aa0efd4-5c3b-49eb-ac6c-6e10ed2c1f7e.svg)](https://wakatime.com/badge/user/76584d9d-5b41-46e5-8997-1dba7fa49c33/project/6aa0efd4-5c3b-49eb-ac6c-6e10ed2c1f7e)