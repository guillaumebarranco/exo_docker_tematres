launch
	cd image
	docker build . -q (le -q sert à obtenir l'id du container à la fin)
	docker run -it ${HASH_CONTAINER}  /bin/bash