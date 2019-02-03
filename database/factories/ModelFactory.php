<?php

$factory->define(App\Bank::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        'state_id' =>factory(App\State::class)->create()->id,
        'name' => $faker->name,
    ];
});

$factory->define(App\Divice_Model::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'ime' => $faker->randomFloat(),
        'DiviceModel' => $faker->word,
    ];
});

$factory->define(App\Preparing::class, function (Faker\Generator $faker) {
    return [
        'amount' => $faker->randomFloat(),
        'for_time' => $faker->time(),
        'Paid' => $faker->boolean,
        'Posted' => $faker->boolean,
        'delivery_address' => $faker->text,
        'is_rezerv' => $faker->boolean,
        'status' => $faker->boolean,
        'withPake' => $faker->boolean,
        'price_pike' => $faker->randomFloat(),
        'user_id' => factory(App\User::class)->create()->id,

    ];
});

$factory->define(App\PreparingProduct::class, function (Faker\Generator $faker) {
    return [
        'product_id' => factory(App\Product::class)->create()->id,
        'preparing_id' => factory(App\Preparing::class)->create()->id,
    ];
});

$factory->define(App\PrivilegeAndComment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'product_id' => factory(App\Product::class)->create()->id,
        'comment' => $faker->text,
        'privilege' => $faker->randomNumber(),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'Seller_id' => factory(App\Seller::class)->create()->id,
        'icon' => $faker->word,
        'product_name' => $faker->word,
        'product_description' => $faker->text,
        'price' => $faker->randomFloat(),
        'discount' => $faker->randomFloat(),
        'privilege' => $faker->randomNumber(),
        'buying_count' => $faker->randomNumber(),
        'inventory' => $faker->randomNumber(),
        'pake_price' => $faker->randomFloat(),

    ];
});

$factory->define(App\ProductImage::class, function (Faker\Generator $faker) {
    return [
        'product_id' => factory(App\Product::class)->create()->id,
        'image_src' => $faker->word,
    ];
});

$factory->define(App\Seller::class, function (Faker\Generator $faker) {
    return [
        'certificate' => $faker->word,
        'meli_cart' => $faker->word,
        'meli_num' => $faker->randomFloat(),
        'bank_id' => factory(App\Bank::class)->create()->id,
        'bank_cart_num' => $faker->randomNumber(),
        'shaba_num' => $faker->randomNumber(),
        'shop_name' => $faker->word,
        'Income' => $faker->randomFloat(),
    ];
});

$factory->define(App\Settings::class, function (Faker\Generator $faker) {
    return [
        'key' => $faker->randomNumber(),
        'value' => $faker->randomNumber(),
        'value2' => $faker->randomNumber(),
    ];
});

$factory->define(App\State::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'user_id' => factory(App\User::class)->create()->id,
    ];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'preparing_id' => factory(App\Preparing::class)->create()->id,
        'amount' => $faker->randomFloat(),
        'type' => $faker->boolean,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->word,
        'lastname' => $faker->word,
        'mobile' => str_random(10),
        'latitude' => $faker->word,
        'longitude' => $faker->word,
        'credit' => $faker->randomFloat(),
        'is_seller' => $faker->boolean,
        'avatar' => $faker->word,
        'isBan' => $faker->boolean,
        'address' => $faker->text,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'api_token' => str_random(100),
        'remember_token' => str_random(10),
    ];
});

