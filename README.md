# Campus Ambassador Registration Portal | Wissenaire 20
[official site](ca.wissenaire.org)
This repo hosts the codebase for Campus Ambassador Registraion Portal of Wissenaire Campus Ambassador Program.  
This project uses Laravel framework for backend written in php and implements facebook auth for authentication of users.  

To test run this site clone this repo  
`git clone <repo url>`

Then install the dependencies  
`composer install`

Configure the local environment variables in .env file in the root of project directory  
`touch .env && cp .env.example .env`

Run the migrations  
`php artisan migrate`

Serve the files  
`php artisan serve`
