# Setup and build the client

FROM node:alpine as frontend

WORKDIR /usr/app/frontend/
COPY frontend/package*.json ./
RUN yarn install -qy
COPY frontend/ ./
RUN yarn build

# Setup the server

FROM node:alpine

WORKDIR /usr/app/
COPY --from=frontend /usr/app/frontend/build/ ./frontend/build/

WORKDIR /usr/app/backend/
COPY backend/package*.json ./
RUN yarn install -qy
COPY backend/ ./

ENV PORT 3000

EXPOSE 3000

CMD ["npm", "start"]
