## Small blog

Small blog is made with Vue.js CLI 3 and Laravel API. 


### To Run The Frontend

1. Download the repository or clone the repository
`git clone https://github.com/houdev/vuejsBlogWithLaravelAPI.git`
2. Open Terminal and type:

```
cd spa 
yarn 
yarn serve
```
### To Run The Backend (Laravel API)

1. Download the repository or clone the repository
```
git clone https://github.com/houdev/vuejsBlogWithLaravelAPI.git
```

2. Change the directory into api folder
```
cd api
```

3. Install the dependencies by running Composer's install command
```
composer install
```
4. Create an environment file
```
cp .env.example .env
```
5. Edit `.env` file with appropriate credential for your database server - these parameter(`DB_USERNAME`, `DB_PASSWORD`).
6. Create a database named `small_blog`
7. Migrate your database
```
php artisan migrate
```
8. Generate the application key.
```
php artisan key:generate
```
9. Run the server
```
php artisan serve
```
10. Now go to `http://localhost:8080` from your browser. 
