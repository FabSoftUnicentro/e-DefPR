FROM node:9.4.0-alpine

RUN mkdir /usr/app
WORKDIR /usr/app

COPY package*.json ./
# RUN apk --no-cache add --virtual builds-deps build-base python && npm install && apk del builds-deps
# RUN apk --no-cache add --virtual builds-deps build-base python
# RUN apk --no-cache add --virtual native-deps \
#   g++ gcc libgcc libstdc++ linux-headers make python && \
#   yarn global add node-gyp -g &&\
#   yarn install && \
#   apk del native-deps
RUN yarn install

COPY . .

EXPOSE 3000

CMD ["yarn", "start"]