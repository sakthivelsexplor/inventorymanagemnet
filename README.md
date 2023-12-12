## Inventory Management

Create a RESTful API for an inventory management system using Laravel and Mysql. The system should allow users to manage different
items with assigned categories. Users should be able to perform CRUD operations on both items and categories, as well as associate items
with categories and update these associations.

## Table Of Contents
    -> Dpendencies
    -> Installation
    -> Features
    -> Executing program
    
## Dpendencies
    1. php >=8.0
    2. Laravel >=9
    3. Mysql
    
## Installation
    1.Laravel installation.
    2.Install composer in your system.
    3.Clone the repository
    4.Navigate to the project directory
## Features
	> Item Managemnet
    > Category Management
    > Email Notification
    > API request validation
    > Php unit test cases wriiten
    > Authroized by predefined Token
    
## Executing program
   1. Create a .env file in project roor folder.
   
   2. Update all Credentials in .env
   
   3. Update INV_API_TOKEN value to authenticate.
   
   4. Update ADMIN_EMAIL and XPLOR_TEAM_EMAIL values to get email notification.
   
   5. Run Composer install
   
   6. Run php artisan config:cache
   
   7. Run php artisan migrate
   
   8. Run php artisan serve

   9. You can access the application for base url ex:http://127.0.0.1:8000

## Inventory Management APIs Refereence
## Authorization
  > Authorization Token add Bearer toekn(INV_API_TOKEN)  is required.
  > Request Header Type Accept and application/json is required.
  > Glist API returns a JSON response for [API REFERENCE (1).docx](https://github.com/sakthivelsexplor/inventorymanagemnet/files/13646407/API.REFERENCE.1.docx)
attached file kindly look at this.
   


## Releases
    No releases published
## Packages
   No packages published

   



