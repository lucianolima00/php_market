FROM node:18-alpine
LABEL authors="luciano"

COPY . /var/www/html

WORKDIR /var/www/html/web

COPY package*.json .

RUN apk update && apk add --no-cache bash

RUN npm install

CMD ["npm", "run", "start"]