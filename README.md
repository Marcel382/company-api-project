**Company API Example**

Simple Laravel 12 application structured using Domain-Driven Design principles. It has a clear architecture for managing companies via a RESTful API.

**Architecture:**
The application is split into three layers:
 - Domain - Core business logic and value objects.
 - Application - Use cases / services
 - Infrastructure - Controllers, repositories and UUID implementation.

**Features:**
 - Create, update, fetch single or list, and delete companies.
 - In-memory repository for persistence
 - Example tests with PHPUnit

**Endpoints:**
 - POST '/api/companies', Create a new company
 - GET '/api/companies', List all companies
 - GET '/api/companies/{id}', Get company by ID
 - PATCH '/api/companies/{id}', Update company
 - DELETE '/api/companies/{id}', Delete company

Tests can be run by using 'php artisan test'
