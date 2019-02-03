<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $User = factory(App\User::class, 10)->create();
        $Bank = factory(App\Bank::class, 10)->create();
        $State = factory(App\State::class, 10)->create();
        $Preparing = factory(App\Preparing::class, 10)->create();
        $Settings = factory(App\Settings::class, 10)->create();
        $City = factory(App\City::class, 10)->create();
        $Seller = factory(App\Seller::class, 10)->create();
        $Product = factory(App\Product::class, 10)->create();
        $PrivilegeAndComment = factory(App\PrivilegeAndComment::class, 10)->create();
        $ProductImage = factory(App\ProductImage::class, 10)->create();
        $Transaction = factory(App\Transaction::class, 10)->create();
        $PreparingProduct = factory(App\PreparingProduct::class, 10)->create();
        $Divice_Model = factory(App\Divice_Model::class, 10)->create();
    }
}
