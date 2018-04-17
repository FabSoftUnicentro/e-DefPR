FROM node:9.4.0-alpine

RUN mkdir /usr/app
WORKDIR /usr/app

COPY package*.json ./
RUN yarn install

COPY . .

EXPOSE 3000

CMD ["yarn", "start"]
