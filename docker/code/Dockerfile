FROM alpine
# TODO: Add version number

RUN apk add git

WORKDIR /srv/html

CMD rm -Rf /tempcode && git clone https://github.com/survivorbat/Docker-Library-Application /tempcode && cp -rf /tempcode/* /srv/html && rm -Rf /tempcode
