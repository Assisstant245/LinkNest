<?php

$u = App\Models\User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password123'),
]);

echo "Created user with ID: {$u->id}\n";