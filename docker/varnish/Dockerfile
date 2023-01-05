FROM varnish:latest

# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive

# Setting Configurations
ENV VARNISH_CONFIG  /etc/varnish/default.vcl
ENV CACHE_SIZE      512m
ENV VARNISHD_PARAMS -p default_ttl=3600 -p default_grace=3600
ENV VARNISH_PORT    6081
ENV BACKEND_HOST    nginx
ENV BACKEND_PORT    8080

COPY default.vcl /etc/varnish/default.vcl
COPY start.sh /etc/varnish/start.sh

USER root

RUN chmod a+x /etc/varnish/start.sh

CMD ["/etc/varnish/start.sh"]

EXPOSE 8080
