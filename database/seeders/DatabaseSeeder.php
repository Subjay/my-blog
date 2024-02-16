<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@example.com',
            'password' => '$2y$12$8MQloEPUdfR2M6se9HVaXerC4c7SqLD2rfg2Vsj1GWqyueRZDtIxe'
        ]);

        User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@example.com',
            'password' => '$2y$12$8MQloEPUdfR2M6se9HVaXerC4c7SqLD2rfg2Vsj1GWqyueRZDtIxe'
        ]);
        
        Article::create([
            'user_id' => 1,
            "title" => "Lorem ipsum dolor",
            "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Est quo odit perferendis similique, doloremque delectus nulla libero ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Technologie",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 2,
            "title" => "Est quo odit perferendis similique",
            "content" => "Est quo odit perferendis similique, doloremque delectus nulla libero, lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Autre",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 1,
            "title" => "Tempora sunt provident",
            "content" => "Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Bien-être",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 1,
            "title" => "Qui tempora sunt provident",
            "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Est quo odit perferendis similique, doloremque delectus nulla libero ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Technologie",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 2,
            "title" => "Nullam orci orci",
            "content" => "Est quo odit perferendis similique, doloremque delectus nulla libero, lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Autre",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 1,
            "title" => "Etiam at pharetra justo",
            "content" => "Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Bien-être",
            "cover" => "Template.jpg"
        ]);
        Article::create([
            'user_id' => 1,
            "title" => "Suspendisse potenti. Suspendisse eget",
            "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Est quo odit perferendis similique, doloremque delectus nulla libero ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Technologie",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 2,
            "title" => "Integer tempus leo eu nunc",
            "content" => "Est quo odit perferendis similique, doloremque delectus nulla libero, lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Autre",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 1,
            "title" => "Donec lacus massa, rutrum nec convallis",
            "content" => "Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Bien-être",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 1,
            "title" => "Vivamus iaculis, tellus eu condimentum tincidunt",
            "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Est quo odit perferendis similique, doloremque delectus nulla libero ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Technologie",
            "cover" => "Template.jpg"
        ]);

        Article::create([
            'user_id' => 2,
            "title" => "Duis nec nibh a urna aliquam",
            "content" => "Est quo odit perferendis similique, doloremque delectus nulla libero, lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum distinctio suscipit qui tempora sunt provident eaque impedit modi. Hic, corporis minus.",
            "category" => "Autre",
            "cover" => "Template.jpg"
        ]);
    }
}

