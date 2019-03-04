FROM alpine:3.9

WORKDIR /srv/html

RUN apk add git && chown -R 1000:1000 /srv/html && mkdir /srv/html/src && chown -R 1000:1000 /srv/html/src

USER 1000

CMD git clone https://github.com/survivorbat/Docker-Library-Application /srv/html/tempcode && \
    ls -la /srv/html && \
    cp -rf /srv/html/tempcode/* /srv/html && \
    rm -Rf /tempcode/*
