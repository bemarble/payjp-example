FROM nginx:latest
COPY ./nginx/site.conf /etc/nginx/conf.d/default.conf
