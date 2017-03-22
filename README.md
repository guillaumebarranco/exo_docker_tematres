## Author : Guillaume Barranco DEV 2

#### How To Use
	git clone https://github.com/guillaumebarranco
	cd image
	docker-compose up -d

#### Run
	After the docker-compose, the db and the web services will launch. The docker-compose will mount the web service using the Dockerfile in the image folder. After that, it will mount the db service from mysql latest docker image. Then the web service will use the db service and connect to it using the env file test.env

#### Debug
	cd image/
	docker build . -q (the -q is used to obtain the container hash at the end)
	docker run -it ${HASH_CONTAINER}  /bin/bash
