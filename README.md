# Restful api using Jwt Auth
## Setup
All seeded users will be created with the same password which is `secret`. A list of seeded user will be displayed in the terminal, 
the last one listed is an admin user `admin@user.com`.

run `cp .env.example .env`, then update `DB_*` variables to match your database.

```bash
composer install
php artisan migrate --seed
php artisan jwt:secret
```

## Add Admin (all) Permissions to a User
Giving the user admin permission will allow them to CURD products, as well as CRUD user - product relationships.
If the user do not have admin permissions the user can only manipulate their own user - product.

An admin user was seeded `admin@user.com`

```bash
php artisan acl:admin {id}
``` 

## Function Tests
 Functional Tests can be ran with the `phpunit` command.
 
## Authorization and example requests
This api is using jwt to authorize requests. Once a jwt is generated it lasts for 1 hour by default, add `JWT_TTL` 
to the .env to set a custom time in minutes.


### Interacting with the Api
I have included a postman collection called `TestRoutes.postman_collection.json` which contains a few of the end points.
Below is the curl copy from the collection for authorization.

#####
```
curl -X POST \
  http://localhost/api/authorize \
  -H 'cache-control: no-cache' \
  -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  -F email=admin@user.com \
  -F password=secret
```

#####Example Resonse

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aG9yaXplIiwiaWF0IjoxNTYzMDY4NTI4LCJleHAiOjE1NjMwNzIxMjgsIm5iZiI6MTU2MzA2ODUyOCwianRpIjoiT1R0YjlaakRTb3VUQjdEMyIsInN1YiI6NiwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.fcGOJLcUE9N07o_FvATp2QmaKkCYQdm9wchc73siMls",
    "first_name": "Lewis",
    "last_name": "Kub",
    "full_name": "Lewis Kub",
    "email": "admin@user.com"
}
```

Here is how you would use it to make subsequent requests. Use the token from authorize route response, in the header `Authorization` as seen below.

```
curl -X GET \
  http://localhost/api/products \
  -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aG9yaXplIiwiaWF0IjoxNTYzMDY4NTI4LCJleHAiOjE1NjMwNzIxMjgsIm5iZiI6MTU2MzA2ODUyOCwianRpIjoiT1R0YjlaakRTb3VUQjdEMyIsInN1YiI6NiwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.fcGOJLcUE9N07o_FvATp2QmaKkCYQdm9wchc73siMls' \
  -H 'Postman-Token: 56d9c137-6776-45ab-962f-75051ff49aa8' \
  -H 'cache-control: no-cache'
```
