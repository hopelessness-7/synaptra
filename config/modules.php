<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Configuration
    |--------------------------------------------------------------------------
    |
    | Here you specify the base API addresses for communication between
    | modules within the project. These values are used to send HTTP requests
    | to the corresponding REST API modules. This separation simplifies the transition
    | to a microservice architecture and supports modular isolation.
    |
    | The default values are read from the .env environment variables.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Project Module
    |--------------------------------------------------------------------------
    |
    | Handles everything related to project management such as:
    | - Creating and updating projects
    | - Fetching project details
    | - Managing project settings
    | - Team management
    |
    | Example endpoint: POST /projects/store, GET /projects/{id}
    |
    */

    'project' => env('APP_PROJECT_MODULE', 'http://localhost/api/v1/projects'),

    /*
    |--------------------------------------------------------------------------
    | Kanban Module
    |--------------------------------------------------------------------------
    |
    | Responsible for task and board management. Features include:
    | - Creating and updating tasks and statuses
    | - Managing boards, columns, and workflows
    | - Assigning tasks and setting priorities
    |
    | Example endpoint: GET /kanban, POST /kanban/store
    |
    */

    'kanban' => env('APP_KANBAN_MODULE', 'http://localhost/api/v1/kanban'),

];

