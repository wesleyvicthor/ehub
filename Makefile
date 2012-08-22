HOST=localhost
PORT=8084

title:
	@echo "Event Hub"

assets: title
	@mkdir -p ./public/js
	@mkdir -p ./public/css
	@mkdir -p ./public/img
	curl -L http://code.jquery.com/jquery-latest.js -o public/js/jquery.js
	curl -LO http://twitter.github.com/bootstrap/assets/bootstrap.zip
	@unzip -q -o bootstrap.zip
	@echo " ./public/js/jquery.js"
	@find bootstrap/ -type f \
        | awk '{print $2}' \
		| grep -v '.min.' \
		| cut -d '/' -f 3-4 \
		| xargs -n 1 -I {} mv -v "./bootstrap/{}" "./public/{}" \
		| cut -d '>' -f 2
	@rm -rf bootstrap*

server: title
	php -S ${HOST}:$(PORT) -t public/ public/.route.php
