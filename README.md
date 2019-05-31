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

 - dotenv configuration ( idea by [@lostika86](https://github.com/lostika86) )
 - The dektrium/yii2-user and dektrium/yii2-rbac packages with basic config
 - An api identifier solution (Authorization header => Bearer token)
 - An api module
 - Predefined controllerMap to the console config (added migration commands)
 
 ## Check out the packages
 - https://github.com/dektrium/yii2-user / User management
 - https://github.com/dektrium/yii2-rbac / Powerful RBAC manager
 - https://github.com/bizley/timeclock / The idea of the api key came from here. (and the code as well)
 - https://github.com/symfony/dotenv / The dotenv we're using
 
 ## Get started
 
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
    $ php yii migrate-app
    ```
### 3rd step

 - Run the server and be happy :)
    ```
    $ php yii serve
    ```
    
## Todo
- [x] Correct testing 
- [ ] Mention every 3rd party package here
- [ ] Test the API key functionality

## Sites or projects ignited by this
Send a PR if you have one :)