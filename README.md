# In this project Created two modules one is to create a custom entity and another one is for migration. 

This module provides the migration configuration,  listing the data of cities.

## Installation

1. Run ```ddev start``` command.

2. Execute ```ddev drush cim``` command. ( Imports the configuration required for our site )

3. Now For Executing migration run below command

   To check the status of migration

   ``` drush ms cities_data_migration  ```

   To import the data
    
   ``` drush mim cities_data_migration  ```

   To Roll back the migrated data

   ``` Drush mr cities_data_migration```


## Listing data

To view the content of cities.

Navigate to ```https://drupal-assignment.ddev.site/content_entity_cities/list``` url

And  we can create the custom entities using the url

```https://drupal-assignment.ddev.site/content_entity_cities/add``` 