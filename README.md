# Global Response for PHP
This is to create easy API responses for my projects. Yes, I'm a little bit lazy to repeat the same code all the time. Thanks for Composer for make easy code in PHP. XD Yes, I will change this in the feature! : )


## Prerequisites 📋

You will need to have installed composer in your computer.

## Instalation 🔧

You need to require the package to your project.

``` bash
composer require agrandesr/response
```

Next, you can use in your code the two classes Response and GlobalResponse, but ignore the first. I recomend to you  (and me) use only GlobalResponse, it is more cool and you can use everywhere in your code... Without instantiation! Sorry for my english... : /

To use only have to use at the start of your thread. But I'm sure that you are doing! ;)
``` php
require './vendor/autoload.php';
```
Next, to use only need to use the GlobalResponse in the place that you want to use!
``` php
use AgrandesR\GlobalResponse;
//Or if you want an alias
use AgrandesR\GlobalResponse as Response;
//Or more funny..
use AgrandesR\GlobalResponse as CoolResponse; // ji ji ji 😝
```

## How to start 🚀

The idea of the Global Response is to make easy the response of code to client in APIs created in PHP. The first version is created to JSON APIs, but my idea is to improve this class with my other composer package [A.G.R ](https://packagist.org/packages/agrandesr/router) (api-generator-router).

The only that you need is to worry about the logic. GlobalResponse give to you and standard of response for each project that you use. You only have to worry about the logic of the code, not minor issues like how to return data.

At the same time, you can add warnings and errors to response in a easy way to have an easy response.

¡Whoop! But, how to start? 🤔

You only need to read quickly the below methods to have an idea of how to use. There are basicaly two type of functions. The functions that add information to your response and the render functions (show and showData).

Please, read is very easy. All are static methods and you can use in diferrent files without thing in how to share the Response object. When you want to finish your thread and send response, only use one of the methods created for that.

###  **Show functions**

First, start with the end. When you want to print the response is very easy. Only need to use one of the follow functions.

#### **Show**

``` php
GlobalResponse::show();
```

Example of response without data or meta:
``` json
{
    "success":true,
    "code":200
}
```



#### **Show Data**


The _showData_ function only show the content of the data. This means that all the warnings, the status code or the meta of the response is hidden for the client user.

``` php
GlobalResponse::addData('key','value');

GlobalResponse::showData();
```

Example of only data response:
``` json
{
    "key":"value"
}
```


-----
EXTRA
-----
-----

<!--
## Deployment 📦 
_Agrega additional notes on how to make deploy_ 


## Built with 🛠️ 
_Menciona the tools you used to create your proyecto_ 
* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used * [Maven](https://maven.apache.org/) - Dependency Manager 
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS ## 

Contributing 🖇️ 
Please read [CONTRIBUTING.md](https://gist.github.com/villanuevand/xxxxxx) for details of our code of conduct, and the process for sending us pull requests. 

## Wiki 📖 
You can find much more about how to use this project in our [Wiki](https://github.com/tu/proyecto/wiki)
-->
## Versioning: 📌

For all available versions, see the [tags in this repository](https://github.com/AGrandesR/global-response/tags).

## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **A.Grandes.R** - *Main worker* - [AGrandesR](https://github.com/AGrandesR)
<!--
You can also look at the list of all [contributors] (https://github.com/your/project/contributors) who have participated in this project.
-->

## License 📄

This project is under the License MIT - read the file [LICENSE](LICENSE) for more details.

## Thanks to: 🎁

* [Villanuevand](https://github.com/Villanuevand) for his incredible [template](https://gist.github.com/Villanuevand/6386899f70346d4580c723232524d35a) for documentation 😊