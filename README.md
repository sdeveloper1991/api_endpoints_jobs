## Background
This project provides some API endpoints to create a job. The actual endpoint to save the job is POST /jobs, 
while the other endpoints are providing some additional functionality that clients may need.

A job represents a task or some job a consumer needs to be done by a tradesman/craftsman.
It is something like "Paint my 60m2 flat" or "Fix the bathroom sink".
Every job is categorized in a "Service". You can think of them like categories. eg: "Boat building & boat repair" or "Cleaning of gutters".
Also every job needs some additional data like a description and when the job should be done.


### Below an example show how to use API with the curl.

API for Get all services.
>  curl -X GET \
>   http://yourhost/service \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' 

API for Create a service
> curl -X POST \
>   http://yourhost/service \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -d '{
> 	"name": "My service",
> }'

API for Update a service

> curl -X PUT \
>   http://yourhost/service/idservice \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -H 'X-Accept-Version: v1' \
>   -d '{
> 	"name": "My new service",
> }'

API for delete a service

> curl -X DELETE \
>   http://yourhost/service/idservice \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -H 'X-Accept-Version: v1' \
>   -d '{
> 	"name": "My new service",
> }'

API for Get all zip code.

>  curl -X GET \
>   http://yourhost/zipcode \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' 

API for Create a zip code.

> curl -X POST \
>   http://yourhost/zipcode \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -d '{
> 	"code": 12345,
> 	"city": "My city for test":
> }'

API for Update a zip code.

> curl -X PUT \
>   http://yourhost/zipcode/idzipcode \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -H 'X-Accept-Version: v1' \
>   -d '{
> 	"code": 12345,
> 	"city": "My new city for test":
> }'

API for delete a zip code.

> curl -X DELETE \
>   http://yourhost/zipcode/idzipcode \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -H 'X-Accept-Version: v1' \
> }'

API for Get all job.

>  curl -X GET \
>   http://yourhost/job \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' 

API for Create a job.

> curl -X POST \
>   http://yourhost/job \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -d '{
>         null,  for id it will generate automatically or put your’
>         "serviceId": null,=> or your serviceid
>         "zipcodeId": null,=> or your zipcode
> 	"title": "my job title",
> 	"description": "My description job":
> }'

API for Update a zip code.

> curl -X PUT \
>   http://yourhost/job/idjob \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
>   -d '{
>         "serviceId": null,=> or your serviceid
>         "zipcodeId": null,=> or your zipcode
> 	"title": "my new job title",
> 	"description": "My new description job":
> }'

API for delete a zip code.

> curl -X DELETE \
>   http://yourhost/job/idjob \
>   -H 'Cache-Control: no-cache' \
>   -H 'Content-Type: application/json' \
> }'



## Run the project
### Setup
- `docker-compose up -d`

## Tests
- `docker-compose exec php bin/console doctrine:database:create --env=test`
- `docker-compose exec php vendor/bin/phpunit`

