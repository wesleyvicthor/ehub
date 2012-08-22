HOST=localhost
PORT=8084

title:
	@echo "Event Hub"

assets: title
	curl -LO http://twitter.github.com/bootstrap/assets/bootstrap.zip
	@unzip -q -o bootstrap.zip
	@cp -rfv bootstrap/* public/
	@rm -rf bootstrap/ bootstrap.zip
	curl -L http://code.jquery.com/jquery-latest.js -o public/js/jquery.js

server: title
	php -S ${HOST}:$(PORT) -t public/ public/.route.php
