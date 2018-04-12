FROM node:9.4.0-alpine

WORKDIR /usr/app

COPY package*.json ./

RUN yarn install
RUN yarn global add serve

COPY . .

EXPOSE 5000

CMD ["yarn", "start"]