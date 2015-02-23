#OnTimeTools Api SDK

[![Build Status](https://travis-ci.org/ontimetools/api-sdk.svg)](https://travis-ci.org/ontimetools/api-sdk)

OTTAS is a simple PHP lib that allows you to request Axosoft's OnTime API in an easy way.

```json
"require": {
    "ontimetools/api-sdk": "v1.0.*"
}
```

To use it, you only have to follow those easy steps
####1- Create a 'ConnectionRequest' object
```php
use OTT\Api\Connection\ConnectionRequest;
$request = new ConnectionRequest();
$request->setOntimeUrl('https://mysubdomain.axosoft.com');
$request->setClientId('my-client_id');
$request->setClientSecret('my-client-secret');
$request->setUsername('username');
$request->setPassword('password');
```
An OnTime() object needs a Request object with all you account information. You can choose the connection type simply by setting the right parameters ([here is the official documentation](http://developer.axosoft.com/authentication.html)). In that example, I'm using the [Username/Password](http://developer.axosoft.com/authentication/username-password.html) way (it's a way easier to use).
####2- Instanciate an 'OnTime' object with you 'ConnectionRequest' object
```php
use OTT\Api\OnTime;
$ontime = new OnTime($request);
```
You also can give a valid token as a parameter to the object so it won't automatically request a new one to the API.
```php
$token = $request->setSavedToken($_SESSION['access_token']);
$ontime = new OnTime($request);
```
####3- Get some data from OnTime
If you want to get some data from OnTime (here projects datas) by giving arguments, you have 2 possible ways to do so :
```php
// No arguments
$projects = $ontime->projects();

// 1° - I want the project #42
$project = $ontime->projects(42);

// 2° - I still want the same project but with more info
use OTT\Api\Filter\Projects as ProjectsFilter;
$filter = new ProjectsFilter();
$filter->setId(42);
$filter->setExtend('all');
$filter->setAttachments(true);
$project = $ontime->projects($filter);
```
