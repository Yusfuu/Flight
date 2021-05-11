# Fly

Creation of a flight reservation management application.

### Prerequisites

You need to have [composer](https://getcomposer.org/)

## Installation

Use the package manager [composer](https://getcomposer.org/) to install required files

```bash
composer install
```
## Configuration
```
remove .example from .env.example and modify file
or create new .env file
```

## Running SQL

```
Folder Database/fly.sql
```

## Usage

> `cd public/`  
>  `php -S localhost:8080`

## Admin Panel
 
* **email** : admin@gmail.com
* **password** : admin

## Routes 

>**Admin**   
`http://localhost:8080/a/account/signin`  
`http://localhost:8080/a/account/dashboard`  

>**User**  
`http://localhost:8080/account/signin`  
`http://localhost:8080/account/signup`  
`http://localhost:8080/account/dashboard`  
`http://localhost:8080/account/reservation`

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)