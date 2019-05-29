<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Firestarter</h1>
    <br>
</p>

This is a somewhat modified version of the basic template with some pregonfigured features.
I've created this to save time upon creating a new project.

Please leave a star if you're considering to use this template in production.

Contains:

 - dotenv configuration
 - The dektrium/yii2-user and dektrium/yii2-rbac packages with basic config
 - An api identifier solution (Authorization header => Bearer token)
 - An api module
 - Predefined controllerMap to the console config (added migration commands)
 
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

## Sites or projects ignited by this
Send a PR if you have one :)