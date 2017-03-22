## Qualifier une image qui existe déjà

1) https://hub.docker.com/r/systemsector/tematres
2) This image is difficultly usable because it is not given with existing data, for example as fixtures. We have no information about the BDD or anything else so we have empty pages.

## Qualifier une image dont on dispose de la source

1) This image doesn't follow the Docker philosophy because everything is stored in the Dockerfile. This does not use for example docker-compose for the env variables or the exported ports. This installs way too much packages with apt-get, it could have been handled better because Docker have ways for it. Docker is used here just for Docker, but everything is done roughly without searching the easier ways to handle Docker configurations.
