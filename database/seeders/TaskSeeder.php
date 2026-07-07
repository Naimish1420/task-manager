<?php

namespace Database\Seeders;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo@taskmanager.com'],
            [
                'name' => 'Demo User',
                'password' => 'password',
            ]
        );

        $tasks = [
            [
                'title' => 'Set up AWS EC2 instance',
                'description' => 'Launch an Ubuntu EC2 instance on AWS Free Tier.',
                'due_date' => now()->addDays(3)->format('Y-m-d'),
                'priority' => TaskPriority::High,
                'status' => TaskStatus::Pending,
            ],
            [
                'title' => 'Install LAMP stack',
                'description' => 'Install Apache, PHP 8.3, MySQL, and Composer on the server.',
                'due_date' => now()->addDays(5)->format('Y-m-d'),
                'priority' => TaskPriority::High,
                'status' => TaskStatus::Pending,
            ],
            [
                'title' => 'Deploy Laravel application',
                'description' => 'Clone the repo, configure .env, run migrations, and set permissions.',
                'due_date' => now()->addDays(7)->format('Y-m-d'),
                'priority' => TaskPriority::Medium,
                'status' => TaskStatus::Pending,
            ],
            [
                'title' => 'Write project documentation',
                'description' => 'Document the deployment steps and application features.',
                'due_date' => now()->subDays(2)->format('Y-m-d'),
                'priority' => TaskPriority::Low,
                'status' => TaskStatus::Completed,
            ],
            [
                'title' => 'Review Laravel best practices',
                'description' => 'Study MVC, Form Requests, Eloquent ORM, and resource controllers.',
                'due_date' => now()->subDay()->format('Y-m-d'),
                'priority' => TaskPriority::Medium,
                'status' => TaskStatus::Completed,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create(array_merge($task, ['user_id' => $user->id]));
        }

        Task::factory()->count(10)->create(['user_id' => $user->id]);
    }
}
