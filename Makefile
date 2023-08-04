build:
	docker-compose up -d --build

start:
	docker-compose up -d

exec:
	docker exec -it karte_app bash

stop:
	docker-compose down
