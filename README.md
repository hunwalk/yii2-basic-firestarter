<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://i.imgur.com/yJC6ual.png" height="300px">
    </a>
    <h1 align="center">Yii 2 Basic Firestarter</h1>
    <br>
</p>

This is a somewhat modified version of the basic template with some pregonfigured features.
I've created this to save time upon creating a new project.

Please leave a star if you're considering to use this template in production.

Contains:

 - that overly useful symfony VarDumper. Use the dump() method
 - dotenv configuration ( idea by [@lostika86](https://github.com/lostika86) )
 - The dektrium/yii2-user and dektrium/yii2-rbac packages with basic config
 - An api identifier solution (Authorization header => Bearer token) / code by [bizley](https://github.com/bizley) 
 - An api module
 - Predefined controllerMap to the console config (added migration commands)
 - A conventional commits helper
 
 ## Check out the packages
 - https://symfony.com/doc/current/components/var_dumper.html / Symfony VarDumper Component
 - https://github.com/dektrium/yii2-user / User management
 - https://github.com/dektrium/yii2-rbac / Powerful RBAC manager
 - https://github.com/bizley/timeclock / The idea of the api key came from here. (and the code as well)
 - https://github.com/symfony/dotenv / The dotenv we're using
 - https://github.com/damianopetrungaro/php-commitizen / A tool for conventional commits
 
 ## Get started
 Use the latest release
```bash
$ composer create-project hunwalk/yii2-basic-firestarter <projectName> --prefer-dist
```
Or use the current master branch, if you're in a hurry for features if there is  any
 
```
$ git clone https://github.com/HunWalk/yii2-basic-firestarter <projectName>
$ cd <projectName>
$ composer install
$ composer run-script post-create-project-cmd
```

>post-create-project-cmd script sets up the permissions for some folders 
and generates the cookieValidationKey for you

## Instructions

### 1st step
Create a .env file from the .env.example

OSX / LINUX

```$ cp .env.example .env```

Windows

```$ copy .env.example .env```

### 2nd step
 - Fill in the .env file. Add or remove things, it's your choice entirely
 - Run the following commands 
    ```
    $ php yii migrate-user
    $ php yii migrate-rbac
    $ php yii migrate
    ```
### 3rd step

 - Run the server and be happy :)
    ```
    $ php yii serve
    ```
   
## About the API
You can reach the api at ```api/v1```
There is an example controller you can test.
That is purely for demonstration, and can be better.

### Update user profile using the api (This is purely for testing purposes)
Read this carefully, if you've never done something like this.

1. Start the server
2. Pop up your favourite api client
3. Set the url to ```api/v1/user/settings/profile```
4. Set up a header with the key ```Authorization```
5. The ```Authorization``` header value should be your token.
6. Keep in mind, that the token will expire within 60 seconds
7. Do a get request with these settings.
8. You should get back the users profile
9. Now do a post request. The body should be x-www-form-urlencoded
10. The key value pairs should be Profile[name] = {yourname}
11. Send. :smile:

If you did everything right, you should get back the updated profile.

### Some additional information

The token looks like this: 

```1:1574952622:d1da75dd83fc643384c728ed7ecfb266574d6533```

It has 3 parts. The user_id, the current timestamp, and the users api_key sha1 hashed together with 
the current timestamp.

You can find more information about generating that token inside the v1 modules DefaultController
Also, you should delete that before going to production.

You can obtain the users api_key from the user table in the api_key column.

## Use Conventional Commits

Thanks to the conventional commits project and this guy: https://github.com/damianopetrungaro/

It seems like, something broke after i released this update, and the fire/commit command does not really work.
Requires some tweaking, but definitely going to fix this sometime. However feel free to use the idea of
the conventional commits. It's really great :smile:

## Todo
- [x] Correct testing 
- [x] Mention every 3rd party package here (i hope i did, open an issue if something is missing)
- [x] Test the API key functionality (tested, now it should work)
- [x] Make a v1 api module with contentNegotiation HttpBearerAuth and verbFilter by default

## Sites or projects ignited by this
Send a PR if you have one :)