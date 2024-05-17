# Cursed Bazaar
<i>Your <b>number 1</b> shop for weird items !</i>

## Quick start
### Prerequisites
Please make sure you have an empty mysql db named "e_commerce".
The rest is fully managed by our migrations, seeders and factories.

Also, <b>PHP 7.4</b> and above is required to run the project.

### Commands
Once the prerequisites are met, you can paste the following commands in the terminal of your choice:
```shell
echo "Installing composer deps...";
composer install --ignore-platform-reqs;
echo "Installing Node modules...";
npm install
echo "Seeding database !";
php artisan migrate --seed;
echo "Building the assets..."
npm run production;
echo "Serving Cursed Bazaar !"
php artisan serve;
```

Those commands will:
1) Install composer & node dependencies
2) Migrate all tables and columns into the db named "e_commerce"
3) Build the necessary js and scss files using mix
4) Serve the project locally to port 8000

<b>TADAM !</b> Cursed Bazaar is served !

## Notes
For all users (whether normal user or admin), their passwords are ``password``
