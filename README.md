# Step 1: Navigate to the project directory
cd wnr

# Step 2: Install dependencies
composer install
npm install

# Step 3: Set up environment configuration
cp .env.example .env
php artisan key:generate

# Step 4: Run the project
php artisan serve

# To add admin in your database crete first a user account then typ ethis
php artisan tinker,
$user = App\Models\User::find(1); // Find user by ID,
$user->is_admin = true; // Make the user an admin,
$user->save();,





