STATIC=/tmp/photon-web-static

all:

clean:
	find . -iname "*~" -delete
	rm -Rf $(STATIC)

start:
	m2sh load --db config.sqlite --config mongrel2/conf/myproject-mongrel2.conf
	m2sh start -host localhost
	./vendor/photon/photon/src/photon.php serve

stop:
	m2sh stop -host localhost

static:
	rm -Rf $(STATIC)
	mkdir -p $(STATIC)
	cd $(STATIC) && wget --recursive --no-clobber --page-requisites --html-extension --convert-links --no-parent http://127.0.0.1:6767/
	cd $(STATIC) && wget --recursive --no-clobber --page-requisites --html-extension --convert-links --no-parent http://127.0.0.1:6767/hello

update: static
	git clone --branch gh-pages $(PWD) $(STATIC)/gh-pages
	cd $(STATIC)/gh-pages && cp -r $(STATIC)/127.0.0.1:6767/* .
	cd $(STATIC)/gh-pages && git add .
	cd $(STATIC)/gh-pages && git commit -m "Website update, `date -u`"
	cd $(STATIC)/gh-pages && git push origin gh-pages:gh-pages
	# This line push to orign which is a local girt repo in $(PWD)

.PHONY: clean static start stop
