install:
	composer install
brain-games:
	bin/brain-games
brain-even:
	bin/brain-even
brain-calc:
	bin/brain-calc
brain-nod:
	bin/brain-nod
brain-progression:
	bin/brain-progression
validate:
	composer validate
lint:
	composer exec --verbose vendor/bin/phpcs -- --standard=PSR12 src bin
