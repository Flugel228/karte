## About Project

This project is website shop that was created on the Laravel and Vue 3

<hr>

## Used in the project

### Backend
- Laravel 10 - this is a backend framework, you can learn more about it at this [link](https://laravel.com/)
- Redis - this is a resident NoSQL database management system, you can learn more about it at this [link](https://redis.io/)
- L5-Swagger - you can learn more about it at this [link](https://github.com/DarkaOnLine/L5-Swagger)
- JWT-Auth - you can learn more about it at this [link](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
### Frontend
- Vue 3 - this is a frontend framework, you can learn more about it at this [link](https://vuejs.org/)
- Vuex - this is a state management library, you can learn more about it at this [link](https://vuex.vuejs.org/)
- Vue Router - this is the official routing library for Vue.js, you can learn more about it at this [link](https://router.vuejs.org/)
- TypeScript - you can learn more about it at this [link](https://www.typescriptlang.org/)
- vue-slider-component - you can learn more about it at this [link](https://nightcatsama.github.io/vue-slider-component/#/)
- vue3-carousel - you can learn more about it at this [link](https://ismail9k.github.io/vue3-carousel/)
- axios - you can learn more about it at this [link](https://axios-http.com/ru/docs/intro)
- vue-i18n - you can learn more about it at this [link](https://vue-i18n.intlify.dev/)
- AdminLTE - you can learn more about it at this [link](https://github.com/jeroennoten/Laravel-AdminLTE)
<hr>

## Project architecture
- <b> MVC Pattern</b> - is a software design pattern commonly used for developing user interfaces that divides the related program logic into three interconnected elements. This is done to separate internal representations of information from the ways information is presented to and accepted from the user.<br>
- <b> A Service Layer</b> - is a design pattern that encapsulates the business logic of your application and defines the boundaries and set of acceptable operations from the perspective of clients interacting with it.<br>
- <b> A Repository</b> - is a design pattern that encapsulates everything related to a data storage method. Goal: Separating business logic from the implementation details of the data access layer.<br>
- <b> A Proxy</b> - is a structural design pattern that provides an object that controls access to another object by intercepting all calls (performs the function of a container).<br>
- <b> A Strategy</b> -  is a behavioral design pattern for modifying algorithms, encapsulating each one, and making them interchangeable. This allows you to choose how to define the appropriate class. The Strategy pattern allows you to change the selected algorithm regardless of the client objects that use it.<br>

<img src="./doc/images/diagram.svg" alt="Scheme of the Controller connect with design patterns">

<hr>

## Downloading the project

<hr>

## Launch of the project
First build the project using the command - ```make build```

Then run the project using the command - ```make start```

Then log into the docker container using the command - ```make exec```

If you need to stop the project, then use the command - ```make stop```
